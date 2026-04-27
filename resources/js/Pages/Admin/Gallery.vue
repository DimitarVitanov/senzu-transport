<template>
    <Head title="Manage Gallery" />
    <AdminLayout>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-senzu/30 bg-senzu/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-senzu mb-3">
                    Media
                </div>
                <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Gallery</h1>
                <p class="text-slate-400 mt-2">Upload images — they are automatically converted to WebP for optimal performance.</p>
            </div>
            <label class="bg-senzu hover:bg-senzu-dark text-dark-bg font-bold text-sm px-6 py-2.5 rounded-xl shadow-lg shadow-senzu/20 transition-colors cursor-pointer inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Upload Images
                <input type="file" multiple accept=".jpg,.jpeg,.png,.webp" class="hidden" @change="handleUpload" ref="fileInput" />
            </label>
        </div>

        <!-- Upload progress -->
        <div v-if="uploading" class="mb-6 bg-white/[0.03] border border-white/10 rounded-2xl p-6 shadow-2xl shadow-black/20">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-senzu animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                </svg>
                <span class="text-white text-sm font-semibold">Uploading and converting to WebP...</span>
            </div>
        </div>

        <!-- Empty State -->
        <div v-if="!images.length && !uploading" class="text-center py-20">
            <svg class="w-16 h-16 text-white/10 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Z"/>
            </svg>
            <p class="text-gray-500 text-sm">No gallery images yet. Upload some to get started.</p>
        </div>

        <!-- Image Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            <div v-for="image in images" :key="image.id"
                 class="group relative bg-white/[0.03] border border-white/10 rounded-xl overflow-hidden shadow-lg shadow-black/20">
                <img :src="image.url" :alt="image.alt_text" class="w-full aspect-square object-cover" loading="lazy" />

                <!-- Overlay -->
                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-2 p-3">
                    <span class="text-xs text-white/70 truncate w-full text-center">{{ image.filename }}</span>

                    <!-- Toggle active -->
                    <button @click="toggleActive(image)"
                            class="text-xs font-semibold px-3 py-1 rounded-full transition-colors"
                            :class="image.is_active ? 'bg-senzu/20 text-senzu' : 'bg-red-500/20 text-red-400'">
                        {{ image.is_active ? 'Active' : 'Hidden' }}
                    </button>

                    <!-- Actions -->
                    <div class="flex gap-2 mt-1">
                        <button @click="openEdit(image)" class="text-white/70 hover:text-senzu transition-colors p-1.5 bg-white/10 rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <button @click="deleteImage(image)" class="text-white/70 hover:text-red-400 transition-colors p-1.5 bg-white/10 rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <teleport to="body">
            <div v-if="showModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4" @click.self="showModal = false">
                <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
                <div class="relative bg-dark-card border border-dark-border rounded-2xl w-full max-w-md p-6 shadow-2xl">
                    <h3 class="text-white font-bold text-lg mb-4">Edit Image</h3>
                    <div class="mb-4">
                        <img :src="editingImage?.url" :alt="editingImage?.alt_text" class="w-full rounded-lg aspect-video object-cover" />
                    </div>
                    <form @submit.prevent="submitEdit" class="space-y-4">
                        <div>
                            <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Alt Text</label>
                            <input v-model="editForm.alt_text" type="text" class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 transition-colors">
                        </div>
                        <div>
                            <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Sort Order</label>
                            <input v-model.number="editForm.sort_order" type="number" class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 transition-colors">
                        </div>
                        <div class="flex items-center gap-2">
                            <input v-model="editForm.is_active" type="checkbox" id="img-active" class="w-4 h-4 rounded border-dark-border bg-dark-bg text-senzu">
                            <label for="img-active" class="text-gray-400 text-sm">Active</label>
                        </div>
                        <div class="flex gap-3 pt-2">
                            <button type="submit" :disabled="editForm.processing" class="bg-senzu hover:bg-senzu-dark text-dark-bg font-bold text-sm px-6 py-2.5 rounded-lg transition-colors disabled:opacity-50">
                                {{ editForm.processing ? 'Saving...' : 'Update' }}
                            </button>
                            <button type="button" @click="showModal = false" class="text-gray-400 hover:text-white text-sm px-6 py-2.5 transition-colors">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </teleport>
    </AdminLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    images: { type: Array, required: true },
});

const uploading = ref(false);
const showModal = ref(false);
const editingImage = ref(null);
const fileInput = ref(null);

const editForm = useForm({
    alt_text: '',
    sort_order: 0,
    is_active: true,
});

function handleUpload(e) {
    const files = e.target.files;
    if (!files.length) return;

    uploading.value = true;

    const formData = new FormData();
    for (let i = 0; i < files.length; i++) {
        formData.append('images[]', files[i]);
    }

    router.post('/admin/gallery', formData, {
        forceFormData: true,
        preserveScroll: true,
        onFinish: () => {
            uploading.value = false;
            if (fileInput.value) fileInput.value.value = '';
        },
    });
}

function toggleActive(image) {
    router.put(`/admin/gallery/${image.id}`, {
        alt_text: image.alt_text,
        sort_order: image.sort_order,
        is_active: !image.is_active,
    }, { preserveScroll: true });
}

function openEdit(image) {
    editingImage.value = image;
    editForm.alt_text = image.alt_text || '';
    editForm.sort_order = image.sort_order;
    editForm.is_active = image.is_active;
    showModal.value = true;
}

function submitEdit() {
    editForm.put(`/admin/gallery/${editingImage.value.id}`, {
        preserveScroll: true,
        onSuccess: () => { showModal.value = false; },
    });
}

function deleteImage(image) {
    if (confirm('Delete this image?')) {
        router.delete(`/admin/gallery/${image.id}`, { preserveScroll: true });
    }
}
</script>

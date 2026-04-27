<template>
    <Head title="Manage Testimonials" />
    <AdminLayout>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-senzu/30 bg-senzu/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-senzu mb-3">
                    Social Proof
                </div>
                <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Testimonials</h1>
            </div>
            <button @click="openCreate" class="bg-senzu hover:bg-senzu-dark text-dark-bg font-bold text-sm px-6 py-2.5 rounded-xl shadow-lg shadow-senzu/20 transition-colors">
                + Add Testimonial
            </button>
        </div>

        <div class="space-y-4">
            <div v-for="t in testimonials" :key="t.id"
                 class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 shadow-2xl shadow-black/20">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-white font-bold text-sm">{{ t.name }}</h3>
                            <span v-if="t.location" class="text-gray-500 text-xs">{{ t.location }}</span>
                            <div class="flex gap-0.5">
                                <svg v-for="i in 5" :key="i" class="w-3 h-3" :class="i <= t.rating ? 'text-senzu' : 'text-gray-600'" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                        </div>
                        <p class="text-gray-400 text-sm">{{ t.content }}</p>
                    </div>
                    <div class="flex gap-2 shrink-0 self-end sm:self-auto">
                        <button @click="openEdit(t)" class="text-gray-400 hover:text-senzu transition-colors p-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <button @click="deleteItem(t)" class="text-gray-400 hover:text-red-400 transition-colors p-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <teleport to="body">
            <div v-if="showModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4" @click.self="showModal = false">
                <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
                <div class="relative bg-dark-card border border-dark-border rounded-2xl w-full max-w-lg p-6 shadow-2xl">
                    <h3 class="text-white font-bold text-lg mb-4">{{ editing ? 'Edit' : 'Add' }} Testimonial</h3>
                    <form @submit.prevent="submitForm" class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Name</label>
                                <input v-model="form.name" type="text" required class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 transition-colors">
                            </div>
                            <div>
                                <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Location</label>
                                <input v-model="form.location" type="text" class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 transition-colors">
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Content</label>
                            <textarea v-model="form.content" rows="4" required class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 transition-colors resize-none"></textarea>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Rating (1-5)</label>
                                <input v-model.number="form.rating" type="number" min="1" max="5" class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 transition-colors">
                            </div>
                            <div>
                                <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Sort Order</label>
                                <input v-model.number="form.sort_order" type="number" class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 transition-colors">
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <input v-model="form.is_active" type="checkbox" id="test-active" class="w-4 h-4 rounded border-dark-border bg-dark-bg text-senzu">
                            <label for="test-active" class="text-gray-400 text-sm">Active</label>
                        </div>
                        <div class="flex gap-3 pt-2">
                            <button type="submit" :disabled="form.processing" class="bg-senzu hover:bg-senzu-dark text-dark-bg font-bold text-sm px-6 py-2.5 rounded-lg transition-colors disabled:opacity-50">
                                {{ form.processing ? 'Saving...' : (editing ? 'Update' : 'Create') }}
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
    testimonials: { type: Array, required: true },
});

const showModal = ref(false);
const editing = ref(null);

const form = useForm({
    name: '', location: '', content: '', rating: 5, sort_order: 0, is_active: true,
});

function openCreate() {
    editing.value = null;
    form.reset();
    form.rating = 5;
    form.is_active = true;
    showModal.value = true;
}

function openEdit(t) {
    editing.value = t;
    Object.assign(form, { name: t.name, location: t.location || '', content: t.content, rating: t.rating, sort_order: t.sort_order, is_active: t.is_active });
    showModal.value = true;
}

function submitForm() {
    if (editing.value) {
        form.put(`/admin/testimonials/${editing.value.id}`, { preserveScroll: true, onSuccess: () => { showModal.value = false; } });
    } else {
        form.post('/admin/testimonials', { preserveScroll: true, onSuccess: () => { showModal.value = false; } });
    }
}

function deleteItem(t) {
    if (confirm('Delete this testimonial?')) {
        router.delete(`/admin/testimonials/${t.id}`, { preserveScroll: true });
    }
}
</script>

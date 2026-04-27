<template>
    <Head title="Manage Features" />
    <AdminLayout>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-senzu/30 bg-senzu/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-senzu mb-3">
                    Homepage Structure
                </div>
                <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Features</h1>
            </div>
            <button @click="openCreate" class="bg-senzu hover:bg-senzu-dark text-dark-bg font-bold text-sm px-6 py-2.5 rounded-xl shadow-lg shadow-senzu/20 transition-colors">
                + Add Feature
            </button>
        </div>

        <!-- Group by section -->
        <div v-for="section in sections" :key="section" class="mb-8">
            <h2 class="text-gray-400 text-sm font-semibold uppercase tracking-wider mb-3">{{ sectionLabel(section) }}</h2>
            <div class="space-y-3">
                <div v-for="feature in featuresBySection(section)" :key="feature.id"
                     class="bg-white/[0.03] border border-white/10 rounded-2xl p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 shadow-2xl shadow-black/20">
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <h3 class="text-white font-bold text-sm">{{ feature.title }}</h3>
                            <span class="text-xs px-2 py-0.5 rounded-full"
                                  :class="feature.is_active ? 'bg-senzu/10 text-senzu' : 'bg-red-500/10 text-red-400'">
                                {{ feature.is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                        <p class="text-gray-500 text-xs">{{ feature.description }}</p>
                    </div>
                    <div class="flex gap-2 shrink-0 self-end sm:self-auto">
                        <button @click="openEdit(feature)" class="text-gray-400 hover:text-senzu transition-colors p-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </button>
                        <button @click="deleteFeature(feature)" class="text-gray-400 hover:text-red-400 transition-colors p-2">
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
                    <h3 class="text-white font-bold text-lg mb-4">{{ editing ? 'Edit' : 'Add' }} Feature</h3>
                    <form @submit.prevent="submitForm" class="space-y-4">
                        <div>
                            <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Title</label>
                            <input v-model="form.title" type="text" required class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 transition-colors">
                        </div>
                        <div>
                            <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Description</label>
                            <textarea v-model="form.description" rows="2" required class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 transition-colors resize-none"></textarea>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Icon</label>
                                <input v-model="form.icon" type="text" class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 transition-colors">
                            </div>
                            <div>
                                <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Section</label>
                                <select v-model="form.section" class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 transition-colors">
                                    <option value="hero_features">Hero Features</option>
                                    <option value="how_it_works">How It Works</option>
                                    <option value="why_choose">Why Choose Us</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Order</label>
                                <input v-model.number="form.sort_order" type="number" class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 transition-colors">
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <input v-model="form.is_active" type="checkbox" id="feat-active" class="w-4 h-4 rounded border-dark-border bg-dark-bg text-senzu">
                            <label for="feat-active" class="text-gray-400 text-sm">Active</label>
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

const props = defineProps({
    features: { type: Array, required: true },
});

const sections = ['hero_features', 'how_it_works', 'why_choose'];
const showModal = ref(false);
const editing = ref(null);

const form = useForm({
    title: '', description: '', icon: 'star', section: 'hero_features', sort_order: 0, is_active: true,
});

function sectionLabel(s) {
    return s.replace(/_/g, ' ');
}

function featuresBySection(section) {
    return props.features.filter(f => f.section === section);
}

function openCreate() {
    editing.value = null;
    form.reset();
    form.is_active = true;
    showModal.value = true;
}

function openEdit(feature) {
    editing.value = feature;
    Object.assign(form, { title: feature.title, description: feature.description, icon: feature.icon, section: feature.section, sort_order: feature.sort_order, is_active: feature.is_active });
    showModal.value = true;
}

function submitForm() {
    if (editing.value) {
        form.put(`/admin/features/${editing.value.id}`, { preserveScroll: true, onSuccess: () => { showModal.value = false; } });
    } else {
        form.post('/admin/features', { preserveScroll: true, onSuccess: () => { showModal.value = false; } });
    }
}

function deleteFeature(feature) {
    if (confirm('Delete this feature?')) {
        router.delete(`/admin/features/${feature.id}`, { preserveScroll: true });
    }
}
</script>

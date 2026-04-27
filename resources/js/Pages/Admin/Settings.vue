<template>
    <Head title="Site Settings" />
    <AdminLayout>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-senzu/30 bg-senzu/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-senzu mb-3">
                    Admin Settings
                </div>
                <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Site Settings</h1>
                <p class="text-slate-400 mt-2">Update headings, labels, and global content used across the website.</p>
            </div>
            <button @click="saveAll" :disabled="saving"
                    class="bg-senzu hover:bg-senzu-dark text-dark-bg font-bold text-sm px-6 py-2.5 rounded-xl shadow-lg shadow-senzu/20 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                {{ saving ? 'Saving...' : 'Save All' }}
            </button>
        </div>

        <div v-for="(items, group) in groupedSettings" :key="group" class="mb-8">
            <h2 class="text-white font-bold text-lg mb-4 capitalize tracking-tight">{{ group }} Settings</h2>
            <div class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 sm:p-7 space-y-4 shadow-2xl shadow-black/20">
                <div v-for="setting in items" :key="setting.key" class="grid grid-cols-1 lg:grid-cols-3 gap-4 items-start">
                    <label class="text-slate-300 text-sm font-semibold capitalize lg:pt-2.5">
                        {{ setting.key.replace(/_/g, ' ') }}
                    </label>
                    <div class="lg:col-span-2">
                        <textarea v-if="setting.type === 'textarea'"
                                  v-model="localSettings[setting.key]"
                                  rows="3"
                                  class="w-full bg-[#0b111a] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 focus:ring-2 focus:ring-senzu/20 transition-colors resize-none"></textarea>
                        <input v-else
                               v-model="localSettings[setting.key]"
                               type="text"
                               class="w-full bg-[#0b111a] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 focus:ring-2 focus:ring-senzu/20 transition-colors">
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const props = defineProps({
    settings: { type: Object, required: true },
});

const saving = ref(false);

const localSettings = ref({});

const allSettings = ref([]);

// Flatten settings from grouped object
const groupedSettings = computed(() => {
    const result = {};
    for (const [group, items] of Object.entries(props.settings)) {
        result[group] = items;
        items.forEach(item => {
            if (!(item.key in localSettings.value)) {
                localSettings.value[item.key] = item.value || '';
            }
        });
    }
    return result;
});

function saveAll() {
    saving.value = true;
    const payload = Object.entries(localSettings.value).map(([key, value]) => ({ key, value }));
    router.put('/admin/settings', { settings: payload }, {
        preserveScroll: true,
        onFinish: () => { saving.value = false; },
    });
}
</script>

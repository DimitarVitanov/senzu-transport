<template>
    <Head title="Change Password" />
    <AdminLayout>
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 rounded-full border border-senzu/30 bg-senzu/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-senzu mb-3">
                Security
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Change Password</h1>
            <p class="text-slate-400 mt-2">Update your admin account password.</p>
        </div>

        <div class="max-w-lg">
            <div class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 sm:p-7 shadow-2xl shadow-black/20">
                <form @submit.prevent="submit" class="space-y-5">
                    <div>
                        <label class="block text-slate-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Current Password</label>
                        <input v-model="form.current_password" type="password" autocomplete="current-password"
                               class="w-full bg-[#0b111a] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 focus:ring-2 focus:ring-senzu/20 transition-colors"
                               :class="{ 'border-red-500/50': form.errors.current_password }" />
                        <p v-if="form.errors.current_password" class="text-red-400 text-xs mt-1.5">{{ form.errors.current_password }}</p>
                    </div>

                    <div>
                        <label class="block text-slate-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">New Password</label>
                        <input v-model="form.password" type="password" autocomplete="new-password"
                               class="w-full bg-[#0b111a] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 focus:ring-2 focus:ring-senzu/20 transition-colors"
                               :class="{ 'border-red-500/50': form.errors.password }" />
                        <p v-if="form.errors.password" class="text-red-400 text-xs mt-1.5">{{ form.errors.password }}</p>
                    </div>

                    <div>
                        <label class="block text-slate-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Confirm New Password</label>
                        <input v-model="form.password_confirmation" type="password" autocomplete="new-password"
                               class="w-full bg-[#0b111a] border border-white/10 rounded-xl px-4 py-2.5 text-white text-sm focus:outline-none focus:border-senzu/50 focus:ring-2 focus:ring-senzu/20 transition-colors" />
                    </div>

                    <div class="pt-2">
                        <button type="submit" :disabled="form.processing"
                                class="bg-senzu hover:bg-senzu-dark text-dark-bg font-bold text-sm px-6 py-2.5 rounded-xl shadow-lg shadow-senzu/20 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                            {{ form.processing ? 'Updating...' : 'Update Password' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

function submit() {
    form.put('/admin/password', {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
}
</script>

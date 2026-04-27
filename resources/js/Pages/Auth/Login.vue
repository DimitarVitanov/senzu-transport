<template>
    <Head title="Admin Login" />
    <div class="min-h-screen bg-dark-bg flex items-center justify-center px-4">
        <div class="w-full max-w-sm">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="w-14 h-14 bg-senzu rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-dark-bg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4z"/>
                    </svg>
                </div>
                <h1 class="text-white font-bold text-xl">Admin Panel</h1>
                <p class="text-gray-500 text-sm mt-1">Sign in to manage your site</p>
            </div>

            <!-- Form -->
            <form @submit.prevent="submit" class="bg-dark-card border border-dark-border rounded-2xl p-6 space-y-4">
                <div>
                    <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Email</label>
                    <input v-model="form.email" type="email" required autofocus
                           class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white text-sm placeholder-gray-600 focus:outline-none focus:border-senzu/50 focus:ring-1 focus:ring-senzu/30 transition-colors"
                           placeholder="admin@senzutransport.com.au">
                    <p v-if="form.errors.email" class="text-red-400 text-xs mt-1">{{ form.errors.email }}</p>
                </div>

                <div>
                    <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Password</label>
                    <input v-model="form.password" type="password" required
                           class="w-full bg-dark-bg border border-dark-border rounded-lg px-4 py-3 text-white text-sm placeholder-gray-600 focus:outline-none focus:border-senzu/50 focus:ring-1 focus:ring-senzu/30 transition-colors"
                           placeholder="••••••••">
                    <p v-if="form.errors.password" class="text-red-400 text-xs mt-1">{{ form.errors.password }}</p>
                </div>

                <div class="flex items-center gap-2">
                    <input v-model="form.remember" type="checkbox" id="remember"
                           class="w-4 h-4 rounded border-dark-border bg-dark-bg text-senzu focus:ring-senzu/30">
                    <label for="remember" class="text-gray-400 text-sm">Remember me</label>
                </div>

                <button type="submit" :disabled="form.processing"
                        class="w-full bg-senzu hover:bg-senzu-dark text-dark-bg font-bold text-sm py-3 rounded-lg transition-colors disabled:opacity-50">
                    {{ form.processing ? 'Signing in...' : 'Sign In' }}
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="/" class="text-gray-500 hover:text-senzu text-sm transition-colors">&larr; Back to website</a>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

function submit() {
    form.post('/login', {
        onFinish: () => form.reset('password'),
    });
}
</script>

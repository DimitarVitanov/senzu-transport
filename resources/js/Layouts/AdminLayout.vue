<template>
    <div class="relative min-h-screen bg-[#070b11] text-slate-100 flex">
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div class="absolute -top-28 -left-16 h-72 w-72 rounded-full bg-senzu/10 blur-3xl"></div>
            <div class="absolute bottom-0 right-0 h-96 w-96 rounded-full bg-cyan-500/10 blur-3xl"></div>
        </div>
        <!-- Sidebar -->
        <aside class="hidden lg:flex flex-col w-72 bg-white/[0.03] border-r border-white/10 backdrop-blur-xl shrink-0 relative z-10">
            <!-- Logo -->
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 bg-gradient-to-br from-senzu to-lime-400 rounded-xl flex items-center justify-center shadow-lg shadow-senzu/20">
                        <svg class="w-6 h-6 text-dark-bg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-white font-bold text-base tracking-tight">Senzu Admin</div>
                        <div class="text-slate-400 text-xs">Content Manager</div>
                    </div>
                </div>
            </div>

            <!-- Nav Links -->
            <nav class="flex-1 p-4 space-y-2">
                <a v-for="item in navItems" :key="item.href"
                   :href="item.href"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm border transition-all duration-200"
                   :class="isActive(item.href) ? 'bg-senzu/15 border-senzu/40 text-white shadow-lg shadow-senzu/10 font-semibold' : 'border-transparent text-slate-400 hover:text-white hover:bg-white/5 hover:border-white/10'">
                    <component :is="item.icon" class="w-5 h-5" />
                    {{ item.label }}
                </a>
            </nav>

            <!-- Footer -->
            <div class="p-4 border-t border-white/10">
                <a href="/" target="_blank" class="flex items-center gap-2 text-slate-400 hover:text-senzu text-sm transition-colors mb-3 px-4 py-2 rounded-lg hover:bg-white/5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    View Website
                </a>
                <form @submit.prevent="logout">
                    <button type="submit" class="flex items-center gap-2 text-slate-400 hover:text-red-400 text-sm transition-colors w-full px-4 py-2 rounded-lg hover:bg-white/5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </aside>

        <!-- Mobile Header -->
        <div class="lg:hidden fixed top-0 left-0 right-0 z-50 bg-[#070b11]/95 backdrop-blur-xl border-b border-white/10">
            <div class="flex items-center justify-between px-4 h-14">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-senzu to-lime-400 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-dark-bg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4z"/>
                        </svg>
                    </div>
                    <span class="text-white font-bold text-sm">Admin</span>
                </div>
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
            <!-- Mobile Nav -->
            <div v-if="mobileMenuOpen" class="border-t border-white/10 p-3 space-y-1 bg-[#0b1018]/95">
                <a v-for="item in navItems" :key="item.href"
                   :href="item.href"
                   @click="mobileMenuOpen = false"
                   class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm border"
                   :class="isActive(item.href) ? 'bg-senzu/15 border-senzu/30 text-white font-semibold' : 'border-transparent text-slate-300'">
                    <component :is="item.icon" class="w-5 h-5" />
                    {{ item.label }}
                </a>
                <form @submit.prevent="logout" class="pt-2 border-t border-white/10 mt-2">
                    <button type="submit" class="flex items-center gap-2 text-red-400 text-sm w-full px-4 py-2">
                        Sign Out
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <main class="flex-1 lg:overflow-y-auto pt-14 lg:pt-0 relative z-10">
            <div class="p-4 sm:p-6 lg:p-8">
                <!-- Flash Messages -->
                <div v-if="$page.props.flash?.success" class="mb-6 bg-senzu/10 border border-senzu/30 rounded-xl px-4 py-3 text-senzu text-sm shadow-lg shadow-senzu/10">
                    {{ $page.props.flash.success }}
                </div>
                <div v-if="$page.props.flash?.error" class="mb-6 bg-red-500/10 border border-red-500/30 rounded-xl px-4 py-3 text-red-400 text-sm shadow-lg shadow-red-500/10">
                    {{ $page.props.flash.error }}
                </div>
                <div v-if="Object.keys($page.props.errors || {}).length" class="mb-6 bg-red-500/10 border border-red-500/30 rounded-xl px-4 py-3 text-red-400 text-sm shadow-lg shadow-red-500/10">
                    <ul class="list-disc list-inside space-y-1">
                        <li v-for="(msg, key) in $page.props.errors" :key="key">{{ msg }}</li>
                    </ul>
                </div>
                <div class="max-w-7xl mx-auto">
                    <slot />
                </div>
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref, h } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const mobileMenuOpen = ref(false);

const iconDashboard = () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', 'stroke-width': '1.5', class: 'w-5 h-5' }, [
    h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', d: 'M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z' })
]);
const iconSettings = () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', 'stroke-width': '1.5', class: 'w-5 h-5' }, [
    h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', d: 'M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z' }),
    h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', d: 'M15 12a3 3 0 11-6 0 3 3 0 016 0z' })
]);
const iconServices = () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', 'stroke-width': '1.5', class: 'w-5 h-5' }, [
    h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', d: 'M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12' })
]);
const iconFeatures = () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', 'stroke-width': '1.5', class: 'w-5 h-5' }, [
    h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', d: 'M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z' })
]);
const iconTestimonials = () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', 'stroke-width': '1.5', class: 'w-5 h-5' }, [
    h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', d: 'M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z' })
]);
const iconQuotes = () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', 'stroke-width': '1.5', class: 'w-5 h-5' }, [
    h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', d: 'M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z' })
]);
const iconGallery = () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', 'stroke-width': '1.5', class: 'w-5 h-5' }, [
    h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', d: 'm2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z' })
]);

const navItems = [
    { href: '/admin', label: 'Dashboard', icon: iconDashboard },
    { href: '/admin/settings', label: 'Site Settings', icon: iconSettings },
    { href: '/admin/services', label: 'Services', icon: iconServices },
    { href: '/admin/features', label: 'Features', icon: iconFeatures },
    { href: '/admin/testimonials', label: 'Testimonials', icon: iconTestimonials },
    { href: '/admin/quotes', label: 'Quote Requests', icon: iconQuotes },
    { href: '/admin/gallery', label: 'Gallery', icon: iconGallery },
];

function isActive(href) {
    return window.location.pathname === href;
}

function logout() {
    router.post('/logout');
}
</script>

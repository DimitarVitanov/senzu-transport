<template>
    <Head title="Admin Dashboard" />
    <AdminLayout>
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 rounded-full border border-senzu/30 bg-senzu/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-senzu mb-3">
                Admin Overview
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Dashboard</h1>
            <p class="text-slate-400 mt-2 max-w-2xl">Track incoming quote activity and keep your content sections in sync from one place.</p>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-gradient-to-b from-white/[0.07] to-white/[0.03] border border-white/10 rounded-2xl p-5 shadow-lg shadow-black/20">
                <div class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Total Quotes</div>
                <div class="text-white text-3xl font-bold">{{ stats.total_quotes }}</div>
            </div>
            <div class="bg-gradient-to-b from-senzu/15 to-senzu/5 border border-senzu/30 rounded-2xl p-5 shadow-lg shadow-senzu/10">
                <div class="text-slate-300 text-xs font-semibold uppercase tracking-wider mb-1">New Quotes</div>
                <div class="text-senzu text-3xl font-bold">{{ stats.new_quotes }}</div>
            </div>
            <div class="bg-gradient-to-b from-white/[0.07] to-white/[0.03] border border-white/10 rounded-2xl p-5 shadow-lg shadow-black/20">
                <div class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Services</div>
                <div class="text-white text-3xl font-bold">{{ stats.services }}</div>
            </div>
            <div class="bg-gradient-to-b from-white/[0.07] to-white/[0.03] border border-white/10 rounded-2xl p-5 shadow-lg shadow-black/20">
                <div class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Testimonials</div>
                <div class="text-white text-3xl font-bold">{{ stats.testimonials }}</div>
            </div>
        </div>

        <!-- Recent Quotes -->
        <div class="bg-white/[0.03] border border-white/10 rounded-2xl overflow-hidden shadow-2xl shadow-black/30">
            <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
                <h2 class="text-white font-bold">Recent Quote Requests</h2>
                <a href="/admin/quotes" class="inline-flex items-center rounded-lg border border-senzu/30 bg-senzu/10 px-3 py-1.5 text-senzu text-sm font-semibold hover:bg-senzu/20 transition-colors">View All &rarr;</a>
            </div>
            <div v-if="recentQuotes.length === 0" class="p-10 text-slate-400 text-center text-sm">
                No quote requests yet.
            </div>
            <div v-else>
                <div class="overflow-x-auto hidden md:block">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-slate-400 text-xs uppercase tracking-wider border-b border-white/10 bg-white/[0.02]">
                                <th class="text-left px-6 py-3">Name</th>
                                <th class="text-left px-6 py-3">Phone</th>
                                <th class="text-left px-6 py-3">Suburb</th>
                                <th class="text-left px-6 py-3">Status</th>
                                <th class="text-left px-6 py-3">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="quote in recentQuotes" :key="quote.id" class="border-b border-white/5 hover:bg-white/[0.03] transition-colors">
                                <td class="px-6 py-3 text-white font-medium">{{ quote.name }}</td>
                                <td class="px-6 py-3 text-slate-300">{{ quote.phone }}</td>
                                <td class="px-6 py-3 text-slate-300">{{ quote.suburb }}</td>
                                <td class="px-6 py-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                          :class="statusClass(quote.status)">
                                        {{ quote.status }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-slate-500 text-xs">{{ formatDate(quote.created_at) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="md:hidden p-4 space-y-3">
                    <div v-for="quote in recentQuotes" :key="quote.id" class="rounded-xl border border-white/10 bg-white/[0.02] p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-white font-semibold">{{ quote.name }}</p>
                                <p class="text-slate-300 text-sm">{{ quote.phone }}</p>
                                <p class="text-slate-400 text-xs mt-1">{{ quote.suburb }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize"
                                  :class="statusClass(quote.status)">
                                {{ quote.status }}
                            </span>
                        </div>
                        <p class="text-slate-500 text-xs mt-3">{{ formatDate(quote.created_at) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    stats: { type: Object, required: true },
    recentQuotes: { type: Array, default: () => [] },
});

function statusClass(status) {
    const map = {
        new: 'bg-senzu/10 text-senzu',
        contacted: 'bg-blue-500/10 text-blue-400',
        quoted: 'bg-yellow-500/10 text-yellow-400',
        completed: 'bg-green-500/10 text-green-400',
        cancelled: 'bg-red-500/10 text-red-400',
    };
    return map[status] || map.new;
}

function formatDate(date) {
    return new Date(date).toLocaleDateString('en-AU', { day: 'numeric', month: 'short', year: 'numeric' });
}
</script>

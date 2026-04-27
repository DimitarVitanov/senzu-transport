<template>
    <Head title="Quote Requests" />
    <AdminLayout>
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 rounded-full border border-senzu/30 bg-senzu/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-senzu mb-3">
                Leads Inbox
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">Quote Requests</h1>
        </div>

        <div v-if="quotes.data.length === 0" class="bg-white/[0.03] border border-white/10 rounded-2xl p-10 text-center shadow-2xl shadow-black/20">
            <p class="text-slate-400">No quote requests yet.</p>
        </div>

        <div v-else class="bg-white/[0.03] border border-white/10 rounded-2xl overflow-hidden shadow-2xl shadow-black/20">
            <div class="overflow-x-auto hidden lg:block">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-slate-400 text-xs uppercase tracking-wider border-b border-white/10 bg-white/[0.02]">
                            <th class="text-left px-6 py-3">Name</th>
                            <th class="text-left px-6 py-3">Phone</th>
                            <th class="text-left px-6 py-3">Suburb</th>
                            <th class="text-left px-6 py-3">Details</th>
                            <th class="text-left px-6 py-3">Status</th>
                            <th class="text-left px-6 py-3">Date</th>
                            <th class="text-right px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="q in quotes.data" :key="q.id" class="border-b border-white/5 hover:bg-white/[0.03] transition-colors">
                            <td class="px-6 py-3 text-white font-medium">{{ q.name }}</td>
                            <td class="px-6 py-3">
                                <a :href="'tel:' + q.phone" class="text-senzu hover:underline">{{ q.phone }}</a>
                            </td>
                            <td class="px-6 py-3 text-slate-300">{{ q.suburb }}</td>
                            <td class="px-6 py-3 text-slate-300 max-w-xs truncate">{{ q.job_details }}</td>
                            <td class="px-6 py-3">
                                <select :value="q.status" @change="updateStatus(q, $event.target.value)"
                                        class="bg-[#0b111a] border border-white/10 rounded-lg px-2 py-1 text-xs focus:outline-none focus:border-senzu/50"
                                        :class="statusClass(q.status)">
                                    <option value="new">New</option>
                                    <option value="contacted">Contacted</option>
                                    <option value="quoted">Quoted</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </td>
                            <td class="px-6 py-3 text-slate-500 text-xs whitespace-nowrap">{{ formatDate(q.created_at) }}</td>
                            <td class="px-6 py-3 text-right">
                                <button @click="deleteQuote(q)" class="text-gray-400 hover:text-red-400 transition-colors p-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="lg:hidden p-4 space-y-3">
                <div v-for="q in quotes.data" :key="q.id" class="rounded-xl border border-white/10 bg-white/[0.02] p-4">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-white font-semibold">{{ q.name }}</p>
                            <a :href="'tel:' + q.phone" class="text-senzu text-sm hover:underline">{{ q.phone }}</a>
                            <p class="text-slate-400 text-xs mt-1">{{ q.suburb }}</p>
                        </div>
                        <button @click="deleteQuote(q)" class="text-gray-400 hover:text-red-400 transition-colors p-1 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                    <p class="text-slate-300 text-sm mt-3">{{ q.job_details }}</p>
                    <div class="mt-3">
                        <label class="block text-[11px] uppercase tracking-wider text-slate-500 mb-1">Status</label>
                        <select :value="q.status" @change="updateStatus(q, $event.target.value)"
                                class="w-full bg-[#0b111a] border border-white/10 rounded-lg px-2 py-2 text-xs focus:outline-none focus:border-senzu/50"
                                :class="statusClass(q.status)">
                            <option value="new">New</option>
                            <option value="contacted">Contacted</option>
                            <option value="quoted">Quoted</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <p class="text-slate-500 text-xs mt-3">{{ formatDate(q.created_at) }}</p>
                </div>
            </div>

            <!-- Pagination -->
            <div v-if="quotes.last_page > 1" class="px-4 sm:px-6 py-4 border-t border-white/10 flex items-center justify-between gap-3">
                <span class="text-slate-400 text-xs">Page {{ quotes.current_page }} of {{ quotes.last_page }}</span>
                <div class="flex gap-2">
                    <a v-if="quotes.prev_page_url" :href="quotes.prev_page_url"
                       class="text-slate-300 hover:text-senzu text-sm px-3 py-1 border border-white/10 rounded-lg transition-colors">&larr; Prev</a>
                    <a v-if="quotes.next_page_url" :href="quotes.next_page_url"
                       class="text-slate-300 hover:text-senzu text-sm px-3 py-1 border border-white/10 rounded-lg transition-colors">Next &rarr;</a>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    quotes: { type: Object, required: true },
});

function statusClass(status) {
    const map = {
        new: 'text-senzu', contacted: 'text-blue-400', quoted: 'text-yellow-400',
        completed: 'text-green-400', cancelled: 'text-red-400',
    };
    return map[status] || '';
}

function formatDate(date) {
    return new Date(date).toLocaleDateString('en-AU', { day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' });
}

function updateStatus(quote, status) {
    router.put(`/admin/quotes/${quote.id}`, { status, admin_notes: quote.admin_notes }, { preserveScroll: true });
}

function deleteQuote(q) {
    if (confirm('Delete this quote request?')) {
        router.delete(`/admin/quotes/${q.id}`, { preserveScroll: true });
    }
}
</script>

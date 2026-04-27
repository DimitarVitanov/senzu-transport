<template>
    <teleport to="body">
        <transition
            enter-active-class="transition duration-180 ease-out"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition duration-180 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-if="show" class="fixed inset-0 z-[100] flex items-center justify-center p-4" @click.self="$emit('close')">
                <!-- Backdrop -->
                <div class="absolute inset-0 bg-black/75 backdrop-blur-sm"></div>

                <!-- Modal -->
                <transition
                    appear
                    enter-active-class="transition duration-260 ease-out"
                    enter-from-class="opacity-0 scale-95 -translate-y-2"
                    enter-to-class="opacity-100 scale-100 translate-y-0"
                    leave-active-class="transition duration-180 ease-in"
                    leave-from-class="opacity-100 scale-100 translate-y-0"
                    leave-to-class="opacity-0 scale-95 -translate-y-2"
                >
                    <div class="relative overflow-hidden bg-[#070a10] border border-white/10 rounded-2xl w-full max-w-md p-6 sm:p-8 shadow-2xl">
                        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_8%_10%,rgba(138,197,7,0.18),transparent_40%),radial-gradient(circle_at_95%_92%,rgba(56,189,248,0.14),transparent_42%)]"></div>
                        <!-- Close button -->
                        <button
                            @click="$emit('close')"
                            aria-label="Close quote modal"
                            class="absolute top-4 right-4 text-gray-500 hover:text-white transition-colors cursor-pointer z-10"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>

                        <!-- Success State -->
                        <div v-if="submitted" class="relative text-center py-6">
                            <div class="w-16 h-16 mx-auto rounded-full bg-senzu/20 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-senzu" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <h3 class="text-white font-bold text-xl mb-2">Quote Request Sent!</h3>
                            <p class="text-gray-400 text-sm">We'll get back to you shortly.</p>
                            <button @click="$emit('close')" class="mt-6 bg-senzu hover:bg-senzu-dark text-dark-bg font-bold text-sm px-6 py-3 rounded-lg transition-colors">
                                Close
                            </button>
                        </div>

                        <!-- Form State -->
                        <div v-else class="relative">
                            <h3 class="text-white font-bold text-xl mb-1">Get a Free Quote</h3>
                            <p class="text-gray-400 text-sm mb-6">Fill in the details and we'll get back to you ASAP.</p>

                            <div class="grid grid-cols-3 gap-2 mb-6">
                                <a
                                    :href="'tel:' + phoneRaw"
                                    class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-senzu/40 bg-senzu/10 px-2 py-2 text-[11px] font-semibold uppercase tracking-wide text-senzu hover:bg-senzu/20 transition-colors"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" stroke-width="1.8"/>
                                    </svg>
                                    Call
                                </a>
                                <a
                                    :href="facebookUrl"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-white/15 bg-white/5 px-2 py-2 text-[11px] font-semibold uppercase tracking-wide text-white/85 hover:bg-white/10 transition-colors"
                                >
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M24 12.073c0-6.627-5.373-12-12-12S0 5.446 0 12.073c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                    </svg>
                                    Facebook
                                </a>
                                <a
                                    :href="instagramUrl"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center gap-1.5 rounded-lg border border-white/15 bg-white/5 px-2 py-2 text-[11px] font-semibold uppercase tracking-wide text-white/85 hover:bg-white/10 transition-colors"
                                >
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 0C8.74 0 8.333.014 7.053.072 2.695.273.273 2.695.072 7.053.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.947.201 4.359 2.623 6.782 6.981 6.981C8.333 23.986 8.741 24 12 24c3.259 0 3.667-.014 4.947-.072 4.358-.199 6.78-2.622 6.981-6.981.058-1.279.072-1.688.072-4.947 0-3.259-.014-3.667-.072-4.947-.201-4.358-2.623-6.78-6.981-6.981C15.667.014 15.259 0 12 0zm0 2.162c3.204 0 3.584.012 4.85.07 3.252.148 4.77 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.011 3.584-.069 4.849-.149 3.225-1.664 4.77-4.919 4.919-1.266.058-1.646.069-4.85.069-3.205 0-3.584-.011-4.85-.069-3.26-.149-4.77-1.696-4.919-4.919-.058-1.265-.069-1.644-.069-4.849 0-3.204.011-3.584.069-4.849.149-3.227 1.664-4.77 4.919-4.919 1.266-.058 1.645-.07 4.85-.07zm0 3.676a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.88 1.44 1.44 0 000-2.88z"/>
                                    </svg>
                                    Instagram
                                </a>
                            </div>

                            <form @submit.prevent="submitForm" class="space-y-4">
                                <div>
                                    <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Name</label>
                                    <input v-model="form.name" type="text" required
                                           class="w-full bg-black border border-white/10 rounded-lg px-4 py-3 text-white text-sm placeholder-gray-600 focus:outline-none focus:border-senzu/50 focus:ring-1 focus:ring-senzu/30 transition-colors"
                                           placeholder="Your name">
                                    <p v-if="form.errors.name" class="text-red-400 text-xs mt-1">{{ form.errors.name }}</p>
                                </div>

                                <div>
                                    <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Phone</label>
                                    <input v-model="form.phone" type="tel" required
                                           class="w-full bg-black border border-white/10 rounded-lg px-4 py-3 text-white text-sm placeholder-gray-600 focus:outline-none focus:border-senzu/50 focus:ring-1 focus:ring-senzu/30 transition-colors"
                                           placeholder="Your phone number">
                                    <p v-if="form.errors.phone" class="text-red-400 text-xs mt-1">{{ form.errors.phone }}</p>
                                </div>

                                <div>
                                    <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Suburb</label>
                                    <input v-model="form.suburb" type="text" required
                                           class="w-full bg-black border border-white/10 rounded-lg px-4 py-3 text-white text-sm placeholder-gray-600 focus:outline-none focus:border-senzu/50 focus:ring-1 focus:ring-senzu/30 transition-colors"
                                           placeholder="Your suburb">
                                    <p v-if="form.errors.suburb" class="text-red-400 text-xs mt-1">{{ form.errors.suburb }}</p>
                                </div>

                                <div>
                                    <label class="block text-gray-300 text-xs font-semibold mb-1.5 uppercase tracking-wider">Job Details</label>
                                    <textarea v-model="form.job_details" required rows="3"
                                              class="w-full bg-black border border-white/10 rounded-lg px-4 py-3 text-white text-sm placeholder-gray-600 focus:outline-none focus:border-senzu/50 focus:ring-1 focus:ring-senzu/30 transition-colors resize-none"
                                              placeholder="Describe what you need delivered/installed..."></textarea>
                                    <p v-if="form.errors.job_details" class="text-red-400 text-xs mt-1">{{ form.errors.job_details }}</p>
                                </div>

                                <button type="submit" :disabled="form.processing"
                                        class="w-full bg-senzu hover:bg-senzu-dark text-dark-bg font-bold text-sm py-4 rounded-lg transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed hover:shadow-lg hover:shadow-senzu/20">
                                    <span v-if="form.processing">Sending...</span>
                                    <span v-else>Submit Quote Request</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </transition>
            </div>
        </transition>
    </teleport>
</template>

<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    show: { type: Boolean, default: false },
    phoneRaw: { type: String, default: '+61456155078' },
    facebookUrl: { type: String, default: 'https://facebook.com' },
    instagramUrl: { type: String, default: 'https://instagram.com' },
});

defineEmits(['close']);

const submitted = ref(false);

const form = useForm({
    name: '',
    phone: '',
    job_details: '',
    suburb: '',
});

function submitForm() {
    form.post('/quote', {
        preserveScroll: true,
        onSuccess: () => {
            submitted.value = true;
            form.reset();
        },
    });
}

watch(() => props.show, (val) => {
    if (val) {
        submitted.value = false;
        form.reset();
        form.clearErrors();
    }
});
</script>

<template>
    <section id="contact-cta" class="bg-[#050608] pt-10 pb-14 lg:pt-14 lg:pb-16">
        <div class="max-w-[78rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-[1.35rem] border border-white/10 bg-[#070a10] reveal reveal-delay-1">
                <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_12%_25%,rgba(138,197,7,0.16),transparent_35%),radial-gradient(circle_at_88%_80%,rgba(56,189,248,0.14),transparent_40%)]"></div>
                <div class="relative grid gap-5 px-5 py-5 sm:gap-6 sm:px-6 sm:py-6 md:grid-cols-[auto_1fr_auto] md:items-center md:px-8 md:py-6 lg:px-10 lg:py-8">
                    <!-- Left -->
                    <div class="flex items-center gap-3 sm:gap-4 reveal reveal-delay-2 ">
                        <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full border-2 border-senzu/80 text-senzu sm:h-12 sm:w-12">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" stroke="currentColor" stroke-width="1.8"/>
                            </svg>
                        </span>
                        <div class="text-left">
                            <div class="text-[10px] font-semibold uppercase tracking-[0.17em] text-white/70 sm:text-[11px]">
                                {{ ctaTitle }} <span v-if="ctaTitleAccent" class="text-senzu">{{ ctaTitleAccent }}</span>
                            </div>
                            <a :href="'tel:' + phoneRaw" class="block text-[2.15rem] font-black leading-[0.95] text-white hover:underline sm:text-4xl md:text-3xl lg:text-5xl">
                                CALL {{ phone }}
                            </a>
                            <div class="mt-1 text-xs leading-relaxed text-white/60 lg:text-sm">{{ ctaDescription }}</div>
                        </div>
                    </div>

                    <!-- Middle tagline -->
                    <div class="text-left md:text-center reveal reveal-delay-3">
                        <div class="text-[2rem] font-bold italic leading-tight text-senzu sm:text-[2.1rem] md:text-[1.6rem] lg:text-4xl">{{ ctaTagline }}</div>
                    </div>

                    <!-- Right action -->
                    <div class="flex w-full items-center gap-3 sm:w-auto reveal reveal-delay-4">
                        <button
                            @click="$emit('openQuote')"
                            class="cursor-pointer inline-flex w-full items-center justify-center rounded-lg bg-senzu px-7 py-3 text-sm font-extrabold uppercase tracking-wider text-dark-bg transition-colors hover:bg-senzu-dark sm:w-auto"
                        >
                            Get a Quote
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { useScrollReveal } from '@/composables/useScrollReveal';

defineProps({
    ctaTitle: { type: String, default: 'NEED IT DELIVERED TODAY?' },
    ctaTitleAccent: { type: String, default: '' },
    ctaDescription: { type: String, default: 'Same-day availability • Fast response' },
    ctaTagline: { type: String, default: 'We get it done right.' },
    phone: { type: String, default: '0456 155 078' },
    phoneRaw: { type: String, default: '+61456155078' },
});

defineEmits(['openQuote']);

useScrollReveal();
</script>

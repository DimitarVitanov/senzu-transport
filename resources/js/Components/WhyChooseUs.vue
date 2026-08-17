<template>
    <section class="relative py-16 lg:py-20 bg-[#050608]">
        <div class="max-w-[78rem] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-14 lg:mb-20 reveal reveal-delay-1">
                <h2 class="text-3xl sm:text-4xl lg:text-4xl font-black">
                    <span class="text-white">{{ title }} </span>
                    <span class="text-senzu italic ms-4">{{ titleAccent }}</span>
                </h2>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                <div v-for="(feature, idx) in features" :key="feature.id"
                     :class="'reveal-delay-' + ((idx % 4) + 1)"
                     class="why-item reveal group text-center rounded-2xl p-5 lg:p-8">
                    <span class="why-item-accent why-item-accent-tl" aria-hidden="true"></span>
                    <span class="why-item-accent why-item-accent-br" aria-hidden="true"></span>
                    <!-- Icon -->
                    <div class="w-16 h-16 mx-auto rounded-xl border border-white/10 flex items-center justify-center mb-4 group-hover:border-senzu/35 transition-colors">
                        <component :is="getIcon(feature.icon)" class="w-8 h-8 text-senzu" />
                    </div>
                    <h4 class="text-white font-bold text-xs sm:text-sm mb-2 leading-tight">{{ feature.title }}</h4>
                    <p class="text-gray-300 text-xs leading-relaxed">{{ feature.description }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { h } from 'vue';
import { useScrollReveal } from '@/composables/useScrollReveal';

defineProps({
    features: { type: Array, required: true },
    title: { type: String, default: 'WHY CHOOSE' },
    titleAccent: { type: String, default: 'SENZU TRANSPORT?' },
});

const icons = {
    trophy: () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', 'stroke-width': '1.5' }, [
        h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', d: 'M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M18.75 4.236c.982.143 1.954.317 2.916.52A6.003 6.003 0 0016.27 9.728M18.75 4.236V4.5c0 2.108-.966 3.99-2.48 5.228m0 0a6.003 6.003 0 01-3.77 1.522m0 0a6.003 6.003 0 01-3.77-1.522' })
    ]),
    zap: () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', 'stroke-width': '1.5' }, [
        h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', d: 'M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z' })
    ]),
    wrench: () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', 'stroke-width': '1.5' }, [
        h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', d: 'M11.42 15.17l-5.3 5.3a2.1 2.1 0 01-2.96-2.97l5.3-5.3m2.96 2.97a2.1 2.1 0 002.97-2.97L9.1 6.9a8.003 8.003 0 018.44-1.37 1 1 0 01.26 1.63l-2.55 2.56a1 1 0 00-.29.7v1.18a1 1 0 001 1h1.17a1 1 0 00.71-.3l2.55-2.54a1 1 0 011.63.26 8 8 0 01-1.37 8.44l-5.27 5.27' })
    ]),
    'hand-heart': () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24', 'stroke-width': '1.5' }, [
        h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', d: 'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z' })
    ]),
};

function getIcon(name) {
    return icons[name] || icons.trophy;
}

useScrollReveal();
</script>

<style scoped>
.why-item {
    position: relative;
    background: transparent;
    overflow: hidden;
    transform: translateY(0);
    transition: transform 280ms cubic-bezier(0.22, 1, 0.36, 1), box-shadow 280ms ease;
    will-change: transform;
}

.why-item:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 28px rgba(0, 0, 0, 0.28);
}

.why-item-accent {
    position: absolute;
    pointer-events: none;
}

.why-item-accent-tl {
    top: 12px;
    left: 12px;
    width: 58px;
    height: 58px;
}

.why-item-accent-tl::before,
.why-item-accent-tl::after {
    content: '';
    position: absolute;
    display: block;
}

/* Top horizontal gradient line */
.why-item-accent-tl::before {
    top: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, #8ac507 0%, rgba(138, 197, 7, 0.15) 100%);
}

/* Left vertical gradient line */
.why-item-accent-tl::after {
    top: 0;
    left: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(180deg, #8ac507 0%, rgba(138, 197, 7, 0.15) 100%);
}

.why-item-accent-br {
    right: 12px;
    bottom: 12px;
    width: 58px;
    height: 58px;
}

.why-item-accent-br::before,
.why-item-accent-br::after {
    content: '';
    position: absolute;
    display: block;
}

/* Bottom horizontal gradient line */
.why-item-accent-br::before {
    right: 0;
    bottom: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(270deg, #8ac507 0%, rgba(138, 197, 7, 0.15) 100%);
}

/* Right vertical gradient line */
.why-item-accent-br::after {
    right: 0;
    bottom: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(0deg, #8ac507 0%, rgba(138, 197, 7, 0.15) 100%);
}
</style>

<template>
    <section id="about" class="relative py-10 sm:py-14 lg:py-28 overflow-hidden bg-white">

        <div class="relative max-w-[78rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-[minmax(0,1fr)_minmax(0,1fr)] gap-10 md:gap-10 lg:gap-12 items-start md:items-stretch">
                <!-- Left - Image/Visual -->
                <div class="how-image-wrap w-full relative group md:h-full reveal reveal-delay-1">
                    <img src="/images/small-van-2.webp"
                         alt="Senzu Transport Truck"
                         class="w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-[1.02]"
                         loading="lazy" />
                </div>

                <!-- Right - Content -->
                <div class="w-full md:h-full flex flex-col justify-center text-center sm:text-left reveal reveal-delay-2">
                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 mb-4 mx-auto sm:mx-0">
                        <div class="h-px w-6 bg-senzu"></div>
                        <span class="text-senzu text-xs font-semibold tracking-widest">{{ badge }}</span>
                    </div>

                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-[#111827] leading-[1.1] mb-2">{{ title }}</h2>
                    <h3 class="text-3xl sm:text-4xl lg:text-5xl font-black text-senzu italic leading-[1.1] mb-6">{{ titleAccent }}</h3>

                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-10">{{ description }}</p>

                    <!-- Feature cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-y-5 sm:gap-y-0">
                        <div v-for="(feature, idx) in features" :key="feature.id"
                             class="how-feature-item reveal flex flex-col items-center text-center sm:items-start sm:text-left py-2 sm:py-1 sm:pr-7 lg:pr-8"
                             :class="['reveal-delay-' + ((idx % 4) + 1), idx > 0 ? 'sm:pl-6 lg:pl-7' : '']"
                        >
                            <img
                                :src="featureIconByIndex(idx)"
                                :alt="feature.title + ' icon'"
                                class="w-12 h-12 object-contain mb-3"
                            />
                            <h4 class="text-[#111827] font-bold text-xs sm:text-sm mb-2 leading-tight">{{ feature.title }}</h4>
                            <p class="text-gray-600 text-xs leading-relaxed">{{ feature.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { useScrollReveal } from '@/composables/useScrollReveal';

defineProps({
    features: { type: Array, required: true },
    badge: { type: String, default: 'BUILT FOR THE TOUGH JOBS' },
    title: { type: String, default: 'WE HANDLE WHAT' },
    titleAccent: { type: String, default: "OTHERS CAN'T" },
    description: { type: String, default: '' },
});

function featureIconByIndex(idx) {
    const icons = ['/icons/access.webp', '/icons/delivery.webp', '/icons/leaf.webp'];
    return icons[idx] || icons[icons.length - 1];
}

useScrollReveal();
</script>

<style scoped>
.how-image-wrap {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 20px 50px -12px rgba(15, 23, 42, 0.18);
    transition: box-shadow 0.4s ease, transform 0.4s ease;
}

.how-image-wrap:hover {
    transform: translateY(-3px);
    box-shadow: 0 28px 60px -12px rgba(15, 23, 42, 0.22);
}

@media (min-width: 768px) {
    .how-image-wrap {
        border-radius: 18px;
        min-height: 320px;
    }
}

@media (min-width: 1024px) {
    .how-image-wrap {
        border-radius: 20px;
        min-height: 390px;
    }
}

@media (min-width: 640px) {
    .how-feature-item {
        position: relative;
    }

    .how-feature-item:not(:last-child)::after {
        content: '';
        position: absolute;
        right: 0;
        top: 5%;
        bottom: 5%;
        width: 2.2px;
        background: #eef2f6;
    }
}
</style>

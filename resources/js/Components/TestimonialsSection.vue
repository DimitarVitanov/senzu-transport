<template>
    <section id="testimonials" class="relative py-20 lg:py-28 bg-dark-card">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-14 lg:mb-20">
                <div class="inline-flex items-center gap-3 mb-4">
                    <div class="h-px w-8 bg-senzu/50"></div>
                    <span class="text-senzu text-xs sm:text-sm font-semibold tracking-widest">TESTIMONIALS</span>
                    <div class="h-px w-8 bg-senzu/50"></div>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white">WHAT OUR <span class="text-senzu italic">CLIENTS SAY</span></h2>
            </div>

            <!-- Testimonial Cards -->
            <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
                <div v-for="testimonial in testimonials" :key="testimonial.id"
                     class="group relative bg-dark-bg border border-dark-border rounded-2xl p-6 lg:p-8 hover:border-senzu/20 transition-all duration-300">
                    <!-- Quote icon -->
                    <svg class="w-8 h-8 text-senzu/30 mb-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10H14.017zM0 21v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151C7.563 6.068 6 8.789 6 11h4v10H0z"/>
                    </svg>

                    <!-- Content -->
                    <p class="text-gray-300 text-sm leading-relaxed mb-6">{{ testimonial.content }}</p>

                    <!-- Rating Stars -->
                    <div class="flex gap-1 mb-4">
                        <svg v-for="i in 5" :key="i" class="w-4 h-4" :class="i <= testimonial.rating ? 'text-senzu' : 'text-gray-600'" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>

                    <!-- Author -->
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-senzu/20 flex items-center justify-center">
                            <span class="text-senzu font-bold text-sm">{{ testimonial.name.charAt(0) }}</span>
                        </div>
                        <div>
                            <div class="text-white font-semibold text-sm">{{ testimonial.name }}</div>
                            <div v-if="testimonial.location" class="text-gray-500 text-xs">{{ testimonial.location }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
defineProps({
    testimonials: { type: Array, required: true },
});
</script>

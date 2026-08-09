<script setup>
defineProps({
    phone: { type: String, default: '0424 033 572' },
    phoneRaw: { type: String, default: '+61424033572' },
    email: { type: String, default: 'info@senzutransport.com.au' },
    tagline: { type: String, default: "Brisbane's trusted furniture removalists. We take the stress out of moving." },
    facebookUrl: { type: String, default: 'https://facebook.com' },
    instagramUrl: { type: String, default: 'https://instagram.com' },
});

const emit = defineEmits(['open-quote']);

const companyLinks = [
    { label: 'About Us', id: 'about' },
    { label: 'Service Areas', id: 'service-areas' },
    { label: 'Reviews', id: 'reviews' },
    { label: 'Contact Us', id: 'contact' },
];

const serviceLinks = [
    { label: 'House Moves', id: 'services' },
    { label: 'Office Relocations', id: 'services' },
    { label: 'Packing Services', id: 'services' },
    { label: 'Interstate Moves', id: 'services' },
];

function scrollTo(id, e) {
    e?.preventDefault();

    if (id === 'contact') {
        emit('open-quote');
        return;
    }

    const el = document.getElementById(id);
    if (el) {
        if (window.lenis) {
            window.lenis.scrollTo(el, { offset: -80 });
        } else {
            el.scrollIntoView({ behavior: 'smooth' });
        }
    }
}
</script>

<template>
    <footer class="border-t border-[#8dc63f] bg-black font-display">
        <div class="mx-auto max-w-[1600px] px-6 py-14 lg:px-14 xl:px-20">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-6 lg:gap-12">
                <!-- Logo -->
                <div>
                    <a href="#home" @click="scrollTo('home', $event)" class="inline-block">
                        <img
                            src="/images/logo-light.webp"
                            alt="Senzu Transport and Logistics"
                            class="h-12 w-auto"
                        />
                    </a>
                </div>

                <!-- Tagline -->
                <div>
                    <p class="text-sm leading-relaxed text-gray-400">
                        {{ tagline }}
                    </p>
                </div>

                <!-- Contact info -->
                <div class="space-y-4">
                    <a
                        :href="`tel:${phoneRaw}`"
                        class="group flex items-center gap-3 text-sm text-gray-300 transition-colors hover:text-senzu"
                    >
                        <span class="text-senzu">
                            <svg
                                class="h-4 w-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"
                                />
                            </svg>
                        </span>
                        {{ phone }}
                    </a>
                    <a
                        :href="`mailto:${email}`"
                        class="group flex items-center gap-3 text-sm text-gray-300 transition-colors hover:text-senzu"
                    >
                        <span class="text-senzu">
                            <svg
                                class="h-4 w-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <rect x="2" y="4" width="20" height="16" rx="2" />
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                            </svg>
                        </span>
                        {{ email }}
                    </a>
                    <a
                        href="https://senzutransport.com.au"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="group flex items-center gap-3 text-sm text-gray-300 transition-colors hover:text-senzu"
                    >
                        <span class="text-senzu">
                            <svg
                                class="h-4 w-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <circle cx="12" cy="12" r="10" />
                                <path d="M2 12h20" />
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                            </svg>
                        </span>
                        senzutransport.com.au
                    </a>
                </div>

                <!-- Company links -->
                <div>
                    <h4 class="mb-4 text-xs font-bold uppercase tracking-wider text-senzu">
                        Company
                    </h4>
                    <ul class="space-y-2.5">
                        <li v-for="link in companyLinks" :key="link.label">
                            <a
                                :href="`#${link.id}`"
                                @click="scrollTo(link.id, $event)"
                                class="text-sm text-gray-400 transition-colors hover:text-senzu"
                            >
                                {{ link.label }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Services links -->
                <div>
                    <h4 class="mb-4 text-xs font-bold uppercase tracking-wider text-senzu">
                        Services
                    </h4>
                    <ul class="space-y-2.5">
                        <li v-for="link in serviceLinks" :key="link.label">
                            <a
                                :href="`#${link.id}`"
                                @click="scrollTo(link.id, $event)"
                                class="text-sm text-gray-400 transition-colors hover:text-senzu"
                            >
                                {{ link.label }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Follow Us -->
                <div>
                    <h4 class="mb-4 text-xs font-bold uppercase tracking-wider text-senzu">
                        Follow Us
                    </h4>
                    <div class="flex items-center gap-3">
                        <a
                            :href="facebookUrl"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="Facebook"
                            class="flex h-9 w-9 items-center justify-center rounded-md bg-white text-ink transition-all hover:scale-105 hover:bg-senzu"
                        >
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"
                                />
                            </svg>
                        </a>
                        <a
                            :href="instagramUrl"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="Instagram"
                            class="flex h-9 w-9 items-center justify-center rounded-md bg-white text-ink transition-all hover:scale-105 hover:bg-senzu"
                        >
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"
                                />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-12 border-t border-white/10 pt-6 text-center text-xs text-gray-500">
                &copy; {{ new Date().getFullYear() }} Senzu Transport and Logistics. All rights reserved.
            </div>
        </div>
    </footer>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
    phone: { type: String, default: '0424 033 572' },
    phoneRaw: { type: String, default: '+61424033572' },
});

const emit = defineEmits(['open-quote']);

const links = [
    { label: 'Home', id: 'home' },
    { label: 'About Us', id: 'about' },
    {
        label: 'Services',
        id: 'services',
        children: [
            { label: 'House Moves', id: 'services' },
            { label: 'Office Relocations', id: 'services' },
            { label: 'Packing Services', id: 'services' },
            { label: 'Interstate Moves', id: 'services' },
        ],
    },
    { label: 'Service Areas', id: 'service-areas' },
    { label: 'Reviews', id: 'reviews' },
    { label: 'Contact', id: 'contact' },
];

const active = ref('home');
const scrolled = ref(false);
const mobileOpen = ref(false);
const servicesOpen = ref(false);
const mobileServicesOpen = ref(false);

let observer = null;

function onScroll() {
    scrolled.value = window.scrollY > 20;
}

function closeMenus() {
    mobileOpen.value = false;
    servicesOpen.value = false;
}

function scrollTo(id, e) {
    e?.preventDefault();

    // "Contact" has no section on the single page — open the quote modal instead
    if (id === 'contact') {
        emit('open-quote');
        closeMenus();
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
    closeMenus();
}

onMounted(() => {
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    const ids = ['home', 'about', 'services', 'service-areas', 'reviews'];
    const sections = ids
        .map((id) => document.getElementById(id))
        .filter(Boolean);

    if (sections.length) {
        observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) active.value = entry.target.id;
                });
            },
            { rootMargin: '-45% 0px -50% 0px', threshold: 0 },
        );
        sections.forEach((s) => observer.observe(s));
    }
});

onBeforeUnmount(() => {
    window.removeEventListener('scroll', onScroll);
    observer?.disconnect();
});
</script>

<template>
    <header
        class="fixed inset-x-0 top-0 z-50 font-display transition-colors duration-300"
        :class="
            scrolled
                ? 'bg-ink/95 shadow-lg shadow-black/30 backdrop-blur'
                : 'bg-gradient-to-b from-black/95 via-ink to-ink/90'
        "
    >
        <nav
            class="mx-auto flex h-20 max-w-[1600px] items-center justify-between gap-6 px-6 lg:px-14 xl:px-20"
        >
            <!-- Logo -->
            <a
                href="#home"
                @click="scrollTo('home', $event)"
                class="flex shrink-0 items-center"
            >
                <img
                    src="/images/logo-light.webp"
                    alt="Senzu Transport and Logistics"
                    class="h-11 w-auto md:h-12"
                />
            </a>

            <!-- Desktop nav -->
            <ul class="hidden items-center gap-7 lg:flex xl:gap-9">
                <li
                    v-for="link in links"
                    :key="link.label"
                    class="relative"
                    @mouseenter="link.children && (servicesOpen = true)"
                    @mouseleave="link.children && (servicesOpen = false)"
                >
                    <a
                        :href="`#${link.id}`"
                        @click="scrollTo(link.id, $event)"
                        class="group relative flex items-center gap-1 py-2 text-[13px] font-medium uppercase tracking-[0.12em] transition-colors duration-200"
                        :class="
                            active === link.id
                                ? 'text-senzu'
                                : 'text-gray-200 hover:text-senzu'
                        "
                    >
                        {{ link.label }}
                        <svg
                            v-if="link.children"
                            class="h-3.5 w-3.5 transition-transform duration-200"
                            :class="servicesOpen ? 'rotate-180' : ''"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <!-- active underline -->
                        <span
                            class="absolute -bottom-0.5 left-0 h-0.5 rounded-full bg-senzu transition-all duration-300"
                            :class="
                                active === link.id
                                    ? 'w-full opacity-100'
                                    : 'w-0 opacity-0 group-hover:w-full group-hover:opacity-60'
                            "
                        />
                    </a>

                    <!-- Services dropdown -->
                    <transition
                        enter-active-class="transition duration-200 ease-out"
                        enter-from-class="opacity-0 translate-y-1"
                        enter-to-class="opacity-100 translate-y-0"
                        leave-active-class="transition duration-150 ease-in"
                        leave-from-class="opacity-100 translate-y-0"
                        leave-to-class="opacity-0 translate-y-1"
                    >
                        <div
                            v-if="link.children && servicesOpen"
                            class="absolute left-0 top-full w-56 overflow-hidden rounded-lg border border-white/10 bg-ink-soft py-2 shadow-xl shadow-black/40"
                        >
                            <a
                                v-for="child in link.children"
                                :key="child.label"
                                :href="`#${child.id}`"
                                @click="scrollTo(child.id, $event)"
                                class="block px-4 py-2.5 text-sm text-gray-200 transition-colors hover:bg-white/5 hover:text-senzu"
                            >
                                {{ child.label }}
                            </a>
                        </div>
                    </transition>
                </li>
            </ul>

            <!-- Phone button (desktop) -->
            <a
                :href="`tel:${phoneRaw}`"
                class="group hidden items-center gap-2.5 rounded-md border border-senzu px-5 py-2.5 text-sm font-semibold tracking-wide text-white transition-all duration-200 hover:bg-senzu hover:text-ink lg:inline-flex"
            >
                <span
                    class="flex h-7 w-7 items-center justify-center rounded-full bg-senzu/15 text-senzu transition-colors group-hover:bg-ink/10 group-hover:text-ink"
                >
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

            <!-- Mobile toggle -->
            <button
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-md text-gray-100 transition hover:text-senzu lg:hidden"
                aria-label="Toggle menu"
                @click="mobileOpen = !mobileOpen"
            >
                <svg
                    v-if="!mobileOpen"
                    class="h-7 w-7"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                >
                    <path d="M4 7h16M4 12h16M4 17h16" />
                </svg>
                <svg
                    v-else
                    class="h-7 w-7"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                >
                    <path d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>
        </nav>

        <!-- Mobile menu -->
        <transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="opacity-0 -translate-y-2"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="opacity-100 translate-y-0"
            leave-to-class="opacity-0 -translate-y-2"
        >
            <div
                v-if="mobileOpen"
                class="border-t border-white/10 bg-ink lg:hidden"
            >
                <ul class="space-y-1 px-5 py-4">
                    <li v-for="link in links" :key="link.label">
                        <template v-if="link.children">
                            <button
                                type="button"
                                class="flex w-full items-center justify-between py-2.5 text-sm font-medium uppercase tracking-wider text-gray-200"
                                @click="mobileServicesOpen = !mobileServicesOpen"
                            >
                                {{ link.label }}
                                <svg
                                    class="h-4 w-4 transition-transform"
                                    :class="mobileServicesOpen ? 'rotate-180' : ''"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                            <div v-show="mobileServicesOpen" class="pb-2 pl-4">
                                <a
                                    v-for="child in link.children"
                                    :key="child.label"
                                    :href="`#${child.id}`"
                                    @click="scrollTo(child.id, $event)"
                                    class="block py-2 text-sm text-gray-400 hover:text-senzu"
                                >
                                    {{ child.label }}
                                </a>
                            </div>
                        </template>
                        <a
                            v-else
                            :href="`#${link.id}`"
                            @click="scrollTo(link.id, $event)"
                            class="block py-2.5 text-sm font-medium uppercase tracking-wider transition-colors"
                            :class="
                                active === link.id
                                    ? 'text-senzu'
                                    : 'text-gray-200 hover:text-senzu'
                            "
                        >
                            {{ link.label }}
                        </a>
                    </li>
                </ul>
                <div class="px-5 pb-5 space-y-3">
                    <button
                        type="button"
                        @click="emit('open-quote'); closeMenus()"
                        class="flex w-full items-center justify-center gap-2 rounded-md bg-senzu px-5 py-3 text-sm font-bold uppercase tracking-wide text-ink"
                    >
                        Get a Free Quote
                    </button>
                    <a
                        :href="`tel:${phoneRaw}`"
                        class="flex items-center justify-center gap-2 rounded-md border border-senzu px-5 py-3 text-sm font-semibold text-white"
                    >
                        <svg
                            class="h-4 w-4 text-senzu"
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
                        {{ phone }}
                    </a>
                </div>
            </div>
        </transition>
    </header>
</template>

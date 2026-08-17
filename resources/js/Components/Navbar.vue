<template>
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
         :class="scrolled ? 'bg-dark-bg/95 backdrop-blur-md shadow-lg shadow-black/20' : 'bg-transparent'">
        <div class="max-w-[115rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-18 lg:h-22">
                <!-- Logo -->
                <a href="/" @click.prevent="navigate('home')" class="flex items-center gap-3 shrink-0 lg:z-10">
                    <span class="nav-logo-frame">
                        <img src="/images/logo.png" alt="Senzu Transport logo" class="nav-logo-image" />
                    </span>
                </a>

                <!-- Desktop Nav (centered) -->
                <div class="hidden lg:flex items-center justify-center gap-5 xl:gap-10 uppercase absolute left-1/2 -translate-x-1/2">
                    <a v-for="link in navLinks" :key="link.id"
                       :href="'#' + link.id"
                       @click.prevent="navigate(link.id)"
                       class="text-[12px] xl:text-[13px] font-bold hover:text-white transition-colors duration-200 tracking-wider underline decoration-2 underline-offset-[9px]"
                       :class="activeSection === link.id ? 'text-senzu decoration-senzu' : 'text-white/80 decoration-transparent'">
                        {{ link.label }}
                    </a>
                </div>

                <!-- Right side: phone + same-day badge -->
                <div class="hidden lg:flex flex-col items-start gap-1 xl:gap-1.5 lg:z-10">
                    <a :href="'tel:' + phoneRaw"
                       class="flex items-center gap-2 xl:gap-2.5 border border-senzu text-senzu hover:bg-senzu hover:text-dark-bg font-bold text-xs xl:text-sm px-4 xl:px-6 py-2 xl:py-2.5 rounded-lg transition-all duration-220 ease-out hover:-translate-y-0.5 hover:shadow-lg hover:shadow-senzu/20">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                        {{ phone }}
                    </a>
                    <div class="flex items-center gap-1.5 text-white/80 text-[9px] xl:text-[10px] font-bold tracking-wider uppercase">
                        <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13 2L4 14h6l-1 8 9-12h-6l1-8z"/>
                        </svg>
                        SAME-DAY AVAILABILITY
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden text-white p-2">
                    <svg v-if="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <transition enter-active-class="transition duration-200 ease-out"
                    enter-from-class="opacity-0 -translate-y-2"
                    enter-to-class="opacity-100 translate-y-0"
                    leave-active-class="transition duration-150 ease-in"
                    leave-from-class="opacity-100 translate-y-0"
                    leave-to-class="opacity-0 -translate-y-2">
            <div v-if="mobileOpen" class="lg:hidden bg-dark-bg/98 backdrop-blur-md border-t border-dark-border">
                <div class="px-4 py-4 space-y-1">
                    <a v-for="link in navLinks" :key="link.id"
                       :href="'#' + link.id"
                       @click.prevent="navigate(link.id); mobileOpen = false"
                       class="block px-4 py-3 text-sm font-bold hover:text-white hover:bg-white/5 rounded-lg transition-colors underline decoration-2 underline-offset-8"
                       :class="activeSection === link.id ? 'text-senzu bg-white/5 decoration-senzu' : 'text-white/80 decoration-transparent'">
                        {{ link.label }}
                    </a>
                    <a :href="'tel:' + phoneRaw"
                       class="cursor-pointer flex items-center justify-center gap-2 mt-4 border border-senzu text-senzu font-semibold text-sm px-5 py-3 rounded-lg transition-all duration-220 ease-out hover:-translate-y-0.5 hover:bg-senzu hover:text-dark-bg hover:shadow-lg hover:shadow-senzu/20">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                        </svg>
                        {{ phone }}
                    </a>
                </div>
            </div>
        </transition>
    </nav>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const props = defineProps({
    phone: { type: String, default: '0456 155 078' },
    phoneRaw: { type: String, default: '+61456155078' },
});

const scrolled = ref(false);
const mobileOpen = ref(false);

const page = usePage();

const isHomePage = computed(() => {
    const url = page.url;
    return url === '/' || url === '';
});

const navLinks = [
    { id: 'home', label: 'Home' },
    { id: 'services', label: 'Services' },
    { id: 'about', label: 'About Us', href: '/about' },
    { id: 'gallery', label: 'Gallery', href: '/gallery' },
    { id: 'contact', label: 'Contact', href: '/contact' },
];

// Determine the active nav link based on current URL or scroll position
const routeActiveId = computed(() => {
    const url = page.url;
    const match = navLinks.find(l => l.href && url.startsWith(l.href));
    return match ? match.id : null;
});

const scrollActiveSection = ref('home');

const activeSection = computed(() => {
    // On dedicated pages (about, gallery), highlight their nav link
    if (routeActiveId.value) return routeActiveId.value;
    // On the home page, use scroll-based detection
    return scrollActiveSection.value;
});

function navigate(id) {
    const link = navLinks.find(l => l.id === id);

    // Links with dedicated routes always navigate there
    if (link?.href) {
        router.visit(link.href);
        return;
    }

    // On the home page, scroll to the section
    if (isHomePage.value) {
        const el = document.getElementById(id);
        if (el) {
            el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
        return;
    }

    // On other pages, go to home page with the anchor hash
    router.visit('/#' + id);
}

function handleScroll() {
    scrolled.value = window.scrollY > 50;

    // Only run scroll-based detection on the home page
    if (!isHomePage.value) return;

    const sections = navLinks.map(l => l.id);

    const nearPageBottom = window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 8;
    if (nearPageBottom) {
        scrollActiveSection.value = sections[sections.length - 1];
        return;
    }

    for (let i = sections.length - 1; i >= 0; i--) {
        const el = document.getElementById(sections[i]);
        if (el && el.getBoundingClientRect().top <= 150) {
            scrollActiveSection.value = sections[i];
            break;
        }
    }
}

onMounted(() => {
    handleScroll();
    window.addEventListener('scroll', handleScroll);
});
onUnmounted(() => window.removeEventListener('scroll', handleScroll));
</script>

<style scoped>
.nav-logo-frame {
    display: block;
    width: 10rem;
    height: 3.25rem;
    overflow: hidden;
}

.nav-logo-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transform: scale(1.55);
    transform-origin: center;
}

@media (min-width: 1024px) {
    .nav-logo-frame {
        width: 13rem;
        height: 4rem;
    }

    .nav-logo-image {
        transform: scale(1.68);
    }
}
</style>

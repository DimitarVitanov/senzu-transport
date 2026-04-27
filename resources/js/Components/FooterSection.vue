<template>
    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-main">
                <!-- Left: logo + tagline -->
                <div class="footer-brand">
                    <div class="footer-logo">
                        <img src="/images/logo.png" alt="Senzu Transport logo" />
                    </div>
                    <div>
                        <div class="footer-tagline">Brisbane's trusted delivery specialists.</div>
                    </div>
                </div>

                <!-- Center: nav links -->
                <nav class="footer-nav">
                    <a v-for="link in links" :key="link.id"
                       :href="link.href || '#' + link.id"
                       @click.prevent="navigate(link)">{{ link.label }}</a>
                </nav>

                <!-- Right: social icons -->
                <div class="footer-social">
                    <!-- Facebook -->
                    <a v-if="facebookUrl" :href="facebookUrl" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="social-icon">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <!-- Instagram -->
                    <a v-if="instagramUrl" :href="instagramUrl" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="social-icon">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Copyright -->
            <div class="footer-bottom">
                <p>&copy; {{ new Date().getFullYear() }} Senzu Transport. All rights reserved.</p>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { computed } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const props = defineProps({
    facebookUrl: { type: String, default: '' },
    instagramUrl: { type: String, default: '' },
});

const page = usePage();
const isHomePage = computed(() => page.url === '/' || page.url === '');

const links = [
    { id: 'home', label: 'Home' },
    { id: 'services', label: 'Services' },
    { id: 'about', label: 'About Us', href: '/about' },
    { id: 'gallery', label: 'Gallery', href: '/gallery' },
    { id: 'contact', label: 'Contact', href: '/contact' },
];

function navigate(link) {
    if (link.href) {
        router.visit(link.href);
        return;
    }

    if (isHomePage.value) {
        const el = document.getElementById(link.id);
        if (el) {
            el.scrollIntoView({ behavior: 'smooth', block: 'start' });
            return;
        }
    }

    router.visit('/#' + link.id);
}
</script>

<style scoped>
.site-footer {
    background: #050608;
    padding: 36px 0 28px;
}

.footer-container {
    max-width: 78rem;
    margin: 0 auto;
    padding: 0 1rem;
}

.footer-main {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 24px;
}

/* Brand */
.footer-brand {
    display: flex;
    align-items: center;
    gap: 12px;
}

.footer-logo {
    width: 210px;
    height: 72px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    overflow: hidden;
}

.footer-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    object-position: center;
    transform: scale(1.55);
    transform-origin: center;
}

.footer-name {
    font-size: 14px;
    font-weight: 800;
    color: #fff;
    letter-spacing: 0.04em;
    line-height: 1;
}

.footer-tagline {
    font-size: 11px;
    color: #6b7280;
    margin-top: 4px;
    letter-spacing: 0.02em;
}

/* Nav */
.footer-nav {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.footer-nav a {
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #9ca3af;
    text-decoration: none;
    transition: color 0.2s;
}

.footer-nav a:hover {
    color: #8ac507;
}

/* Social icons */
.footer-social {
    display: flex;
    gap: 12px;
}

.social-icon {
    width: 34px;
    height: 34px;
    background: #1a1a1a;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
    transition: background 0.2s, color 0.2s;
}

.social-icon:hover {
    background: #8ac507;
    color: #0a0a0a;
}

.social-icon svg {
    width: 16px;
    height: 16px;
}

/* Bottom */
.footer-bottom {
    margin-top: 24px;
    padding-top: 20px;
    border-top: 1px solid #2a2a2a;
    text-align: center;
}

.footer-bottom p {
    font-size: 11px;
    color: #4b5563;
}

@media (min-width: 640px) {
    .footer-container {
        padding: 0 1.5rem;
    }
}

@media (min-width: 768px) {
    .footer-main {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .footer-nav {
        gap: 18px;
    }

    .footer-nav a {
        font-size: 11px;
    }
}

@media (min-width: 1024px) {
    .site-footer {
        padding: 36px 0 28px;
    }

    .footer-container {
        padding: 0 2rem;
    }

    .footer-logo {
        width: 230px;
        height: 78px;
    }

    .footer-logo img {
        transform: scale(1.62);
    }

    .footer-nav {
        gap: 28px;
    }

    .footer-nav a {
        font-size: 12px;
    }
}
</style>

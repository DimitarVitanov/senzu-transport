<template>
    <Head>
        <title>Contact Us | Senzu Transport & Logistics Brisbane</title>
        <meta name="description" content="Contact Senzu Transport & Logistics for a fast, free delivery quote in Brisbane. Same-day availability. Call 0456 155 078 or request a quote online.">
        <meta name="keywords" content="contact Senzu Transport, Brisbane delivery quote, get a quote Brisbane, delivery enquiry Brisbane, transport contact Brisbane">
        <link rel="canonical" href="https://senzutransport.com.au/contact">
        <meta property="og:title" content="Contact Us | Senzu Transport & Logistics">
        <meta property="og:description" content="Get in touch for a fast, free delivery quote in Brisbane. Same-day availability.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://senzutransport.com.au/contact">
        <meta property="og:image" content="https://senzutransport.com.au/images/hero-truck-2.webp">
        <meta name="twitter:title" content="Contact Us | Senzu Transport & Logistics">
        <meta name="twitter:description" content="Get a fast, free delivery quote in Brisbane. Same-day availability.">
        <meta name="twitter:image" content="https://senzutransport.com.au/images/hero-truck-2.webp">
    </Head>

    <MainLayout>
        <!-- Hero Banner -->
        <section class="contact-hero">
            <div class="contact-hero-overlay"></div>
            <div class="contact-hero-content reveal reveal-delay-1">
                <div class="contact-hero-badge">
                    <span class="contact-hero-badge-line"></span>
                    <span class="contact-hero-badge-text">{{ settings.contact_badge || 'GET IN TOUCH' }}</span>
                </div>
                <h1 class="contact-hero-title">
                    <span>{{ settings.contact_title || 'CONTACT' }}</span>
                    <em>{{ settings.contact_title_accent || 'US' }}</em>
                </h1>
                <p class="contact-hero-subtitle reveal reveal-delay-2">{{ settings.contact_subtitle || 'Have a delivery or installation job? Get in touch for a fast, free quote. We respond quickly.' }}</p>
            </div>
        </section>

        <!-- Contact Content — white background -->
        <section class="contact-content">
            <div class="contact-container">
                <div class="contact-grid">

                    <!-- Left: Quote Form on white bg -->
                    <div class="contact-form-wrap reveal reveal-delay-1">
                        <!-- Success State -->
                        <div v-if="submitted" class="contact-success">
                            <div class="contact-success-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <h3 class="contact-success-title">Quote Request Sent!</h3>
                            <p class="contact-success-text">We'll get back to you shortly.</p>
                            <button @click="submitted = false; form.reset()" class="contact-success-btn">Send Another</button>
                        </div>

                        <!-- Form -->
                        <div v-else>
                            <h2 class="contact-form-title">{{ settings.contact_form_heading || 'Request a Free Quote' }}</h2>
                            <p class="contact-form-desc">{{ settings.contact_form_description || "Fill in the details below and we'll get back to you ASAP." }}</p>

                            <form @submit.prevent="submitForm" class="contact-form">
                                <div class="contact-form-row">
                                    <div class="contact-field">
                                        <label class="contact-label">Name</label>
                                        <input v-model="form.name" type="text" required placeholder="Your name" class="contact-input" />
                                        <p v-if="form.errors.name" class="contact-error">{{ form.errors.name }}</p>
                                    </div>
                                    <div class="contact-field">
                                        <label class="contact-label">Email</label>
                                        <input v-model="form.email" type="email" required placeholder="Your email address" class="contact-input" />
                                        <p v-if="form.errors.email" class="contact-error">{{ form.errors.email }}</p>
                                    </div>
                                </div>
                                <div class="contact-form-row">
                                    <div class="contact-field">
                                        <label class="contact-label">Phone</label>
                                        <input v-model="form.phone" type="tel" required placeholder="Your phone number" class="contact-input" />
                                        <p v-if="form.errors.phone" class="contact-error">{{ form.errors.phone }}</p>
                                    </div>
                                </div>
                                <div class="contact-field">
                                    <label class="contact-label">Suburb</label>
                                    <input v-model="form.suburb" type="text" required placeholder="Your suburb" class="contact-input" />
                                    <p v-if="form.errors.suburb" class="contact-error">{{ form.errors.suburb }}</p>
                                </div>
                                <div class="contact-field">
                                    <label class="contact-label">Job Details</label>
                                    <textarea v-model="form.job_details" required rows="4" placeholder="Describe what you need delivered or installed..." class="contact-input contact-textarea"></textarea>
                                    <p v-if="form.errors.job_details" class="contact-error">{{ form.errors.job_details }}</p>
                                </div>
                                <button type="submit" :disabled="form.processing" class="contact-submit">
                                    <span v-if="form.processing">Sending...</span>
                                    <span v-else>Submit Quote Request</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Right: Dark info sidebar -->
                    <div class="contact-sidebar reveal reveal-delay-2">
                        <h2 class="contact-sidebar-title">{{ settings.contact_info_heading || 'Other Ways to Reach Us' }}</h2>

                        <div class="contact-cards">
                            <!-- Phone (highlighted) -->
                            <a :href="'tel:' + (settings.phone_raw || '+61456155078')" class="contact-card contact-card--highlight">
                                <div class="contact-card-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="contact-card-label">Call Us</span>
                                    <span class="contact-card-value">{{ settings.phone || '0456 155 078' }}</span>
                                </div>
                            </a>

                            <!-- Email -->
                            <a :href="'mailto:' + (settings.email || 'senzutransport@gmail.com')" class="contact-card">
                                <div class="contact-card-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <rect x="2" y="4" width="20" height="16" rx="2"/>
                                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="contact-card-label">Email</span>
                                    <span class="contact-card-value">{{ settings.email || 'senzutransport@gmail.com' }}</span>
                                </div>
                            </a>

                            <!-- Hours -->
                            <div class="contact-card">
                                <div class="contact-card-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <circle cx="12" cy="12" r="10"/>
                                        <path d="M12 6v6l4 2"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="contact-card-label">Hours</span>
                                    <span class="contact-card-value">{{ settings.contact_hours || 'Mon – Sun: 6:00am – 8:00pm' }}</span>
                                </div>
                            </div>

                            <!-- Area -->
                            <div class="contact-card">
                                <div class="contact-card-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 1 1 16 0Z"/>
                                        <circle cx="12" cy="10" r="3"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="contact-card-label">Area</span>
                                    <span class="contact-card-value">{{ settings.contact_area || 'Servicing Brisbane & surrounding areas' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Socials -->
                        <div class="contact-socials">
                            <a :href="settings.facebook_url || 'https://facebook.com'" target="_blank" rel="noopener noreferrer" class="contact-social-link">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12S0 5.446 0 12.073c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                Facebook
                            </a>
                            <a :href="settings.instagram_url || 'https://instagram.com'" target="_blank" rel="noopener noreferrer" class="contact-social-link">
                                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C8.74 0 8.333.014 7.053.072 2.695.273.273 2.695.072 7.053.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.947.201 4.359 2.623 6.782 6.981 6.981C8.333 23.986 8.741 24 12 24c3.259 0 3.667-.014 4.947-.072 4.358-.199 6.78-2.622 6.981-6.981.058-1.279.072-1.688.072-4.947 0-3.259-.014-3.667-.072-4.947-.201-4.358-2.623-6.78-6.981-6.981C15.667.014 15.259 0 12 0zm0 2.162c3.204 0 3.584.012 4.85.07 3.252.148 4.77 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.011 3.584-.069 4.849-.149 3.225-1.664 4.77-4.919 4.919-1.266.058-1.646.069-4.85.069-3.205 0-3.584-.011-4.85-.069-3.26-.149-4.77-1.696-4.919-4.919-.058-1.265-.069-1.644-.069-4.849 0-3.204.011-3.584.069-4.849.149-3.227 1.664-4.77 4.919-4.919 1.266-.058 1.645-.07 4.85-.07zm0 3.676a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm0 10.162a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.88 1.44 1.44 0 000-2.88z"/></svg>
                                Instagram
                            </a>
                        </div>

                        <!-- Same-day badge -->
                        <div class="contact-urgent">
                            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M13 2L4 14h6l-1 8 9-12h-6l1-8z"/></svg>
                            <span>Same-day & urgent jobs available</span>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <StatsBar :settings="settings" />

        <CtaSection
            :cta-title="settings.cta_title || 'NEED A DELIVERY'"
            :cta-title-accent="settings.cta_title_accent || 'DONE RIGHT?'"
            :cta-description="settings.cta_description || 'Get in touch today for a fast, free quote.'"
            :cta-tagline="settings.cta_tagline || 'We get it done right.'"
            :phone="settings.phone || '0456 155 078'"
            :phone-raw="settings.phone_raw || '+61456155078'"
            @open-quote="showQuote = true"
        />

        <QuoteModal
            :show="showQuote"
            :phone-raw="settings.phone_raw || '+61456155078'"
            :facebook-url="settings.facebook_url || 'https://facebook.com'"
            :instagram-url="settings.instagram_url || 'https://instagram.com'"
            @close="showQuote = false"
        />
    </MainLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
import StatsBar from '@/Components/StatsBar.vue';
import CtaSection from '@/Components/CtaSection.vue';
import QuoteModal from '@/Components/QuoteModal.vue';
import { useScrollReveal } from '@/composables/useScrollReveal';

defineProps({
    settings: { type: Object, required: true },
});

const showQuote = ref(false);
const submitted = ref(false);

const form = useForm({
    name: '',
    email: '',
    phone: '',
    suburb: '',
    job_details: '',
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

useScrollReveal();
</script>

<style scoped>
/* ─── Hero ─── */
.contact-hero {
    position: relative;
    min-height: 40vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--color-dark-bg);
    overflow: hidden;
    text-align: center;
    padding: 7rem 1rem 3rem;
}

.contact-hero-overlay {
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 25% 40%, rgba(138,197,7,0.08), transparent 50%),
        radial-gradient(circle at 80% 60%, rgba(56,189,248,0.06), transparent 45%);
    pointer-events: none;
}

.contact-hero-content {
    position: relative;
    max-width: 48rem;
}

.contact-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1.25rem;
}

.contact-hero-badge-line {
    display: block;
    width: 1.5rem;
    height: 1px;
    background: var(--color-senzu);
}

.contact-hero-badge-text {
    color: var(--color-senzu);
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
}

.contact-hero-title {
    font-size: clamp(2.2rem, 5vw, 3.4rem);
    font-weight: 900;
    line-height: 1.05;
    margin-bottom: 1.25rem;
    font-style: italic;
}

.contact-hero-title span { display: block; color: #fff; }
.contact-hero-title em   { display: block; color: var(--color-senzu); font-style: italic; }

.contact-hero-subtitle {
    color: #9ca3af;
    font-size: clamp(0.95rem, 1.5vw, 1.1rem);
    line-height: 1.7;
    max-width: 36rem;
    margin: 0 auto;
}

/* ─── Content Section (white) ─── */
.contact-content {
    background: #fff;
    padding: 3.5rem 0 2.5rem;
}

.contact-container {
    max-width: 78rem;
    margin: 0 auto;
    padding: 0 1rem;
}

.contact-grid {
    display: grid;
    gap: 2rem;
}

/* ─── Form (left side, on white bg) ─── */
.contact-form-wrap {
    padding: 0;
}

.contact-form-title {
    color: var(--color-dark-bg);
    font-size: clamp(1.3rem, 2.5vw, 1.6rem);
    font-weight: 800;
    margin-bottom: 0.35rem;
}

.contact-form-desc {
    color: #6b7280;
    font-size: 0.95rem;
    margin-bottom: 1.75rem;
    line-height: 1.6;
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 1.15rem;
}

.contact-form-row {
    display: grid;
    gap: 1.15rem;
}

.contact-field {
    display: flex;
    flex-direction: column;
}

.contact-label {
    color: #374151;
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-bottom: 0.4rem;
}

.contact-input {
    width: 100%;
    background: #f9fafb;
    border: 1.5px solid #e5e7eb;
    border-radius: 0.6rem;
    padding: 0.8rem 1rem;
    color: #111827;
    font-size: 0.9rem;
    outline: none;
    transition: all 0.2s;
}

.contact-input::placeholder {
    color: #9ca3af;
}

.contact-input:focus {
    border-color: var(--color-senzu);
    box-shadow: 0 0 0 3px rgba(138,197,7,0.12);
    background: #fff;
}

.contact-textarea {
    resize: none;
    min-height: 110px;
}

.contact-error {
    color: #ef4444;
    font-size: 0.75rem;
    margin-top: 0.3rem;
}

.contact-submit {
    width: 100%;
    background: var(--color-senzu);
    color: var(--color-dark-bg);
    font-weight: 800;
    font-size: 0.9rem;
    padding: 1rem;
    border-radius: 0.6rem;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    letter-spacing: 0.02em;
    margin-top: 0.25rem;
}

.contact-submit:hover {
    filter: brightness(1.08);
    box-shadow: 0 8px 28px rgba(138,197,7,0.25);
    transform: translateY(-1px);
}

.contact-submit:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

/* ─── Success ─── */
.contact-success {
    text-align: center;
    padding: 3rem 1rem;
}

.contact-success-icon {
    width: 4.5rem;
    height: 4.5rem;
    margin: 0 auto 1.25rem;
    border-radius: 50%;
    background: rgba(138,197,7,0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-senzu);
}

.contact-success-icon svg { width: 2.2rem; height: 2.2rem; }

.contact-success-title {
    color: var(--color-dark-bg);
    font-size: 1.4rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
}

.contact-success-text {
    color: #6b7280;
    font-size: 0.95rem;
    margin-bottom: 1.5rem;
}

.contact-success-btn {
    background: var(--color-senzu);
    color: var(--color-dark-bg);
    font-weight: 700;
    font-size: 0.875rem;
    padding: 0.75rem 2rem;
    border-radius: 0.5rem;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
}

.contact-success-btn:hover { filter: brightness(1.08); }

/* ─── Sidebar (dark card) ─── */
.contact-sidebar {
    background: var(--color-dark-bg);
    border-radius: 1.25rem;
    padding: 2rem 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.06);
}

.contact-sidebar::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 10% 15%, rgba(138,197,7,0.1), transparent 45%),
        radial-gradient(circle at 90% 85%, rgba(56,189,248,0.06), transparent 40%);
    pointer-events: none;
}

.contact-sidebar-title {
    color: #fff;
    font-size: 1.15rem;
    font-weight: 800;
    margin-bottom: 0.15rem;
    position: relative;
}

/* ─── Info Cards ─── */
.contact-cards {
    display: flex;
    flex-direction: column;
    gap: 0.65rem;
    position: relative;
}

.contact-card {
    display: flex;
    align-items: center;
    gap: 0.85rem;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 0.75rem;
    padding: 0.85rem 1rem;
    text-decoration: none;
    transition: all 0.2s;
}

.contact-card:hover {
    border-color: rgba(138,197,7,0.35);
    background: rgba(255,255,255,0.06);
}

.contact-card--highlight {
    border-color: rgba(138,197,7,0.3);
    background: rgba(138,197,7,0.06);
}

.contact-card--highlight:hover {
    background: rgba(138,197,7,0.1);
}

.contact-card-icon {
    width: 2.25rem;
    height: 2.25rem;
    border-radius: 50%;
    border: 1.5px solid rgba(138,197,7,0.5);
    color: var(--color-senzu);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.contact-card-icon svg { width: 1.05rem; height: 1.05rem; }

.contact-card-label {
    display: block;
    color: #9ca3af;
    font-size: 0.65rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    line-height: 1;
    margin-bottom: 0.2rem;
}

.contact-card-value {
    display: block;
    color: #fff;
    font-size: 0.9rem;
    font-weight: 600;
    line-height: 1.3;
}

/* ─── Socials ─── */
.contact-socials {
    display: flex;
    gap: 0.6rem;
    position: relative;
}

.contact-social-link {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.45rem;
    padding: 0.6rem 0.75rem;
    border-radius: 0.6rem;
    border: 1px solid rgba(255,255,255,0.1);
    background: rgba(255,255,255,0.03);
    color: rgba(255,255,255,0.75);
    font-size: 0.78rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
}

.contact-social-link svg { width: 1.1rem; height: 1.1rem; }

.contact-social-link:hover {
    background: rgba(255,255,255,0.08);
    border-color: rgba(255,255,255,0.2);
    color: #fff;
}

/* ─── Urgent Badge ─── */
.contact-urgent {
    display: flex;
    align-items: center;
    gap: 0.65rem;
    background: rgba(138,197,7,0.08);
    border: 1px solid rgba(138,197,7,0.2);
    border-radius: 0.65rem;
    padding: 0.75rem 1rem;
    color: var(--color-senzu);
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    position: relative;
}

.contact-urgent svg { width: 1.1rem; height: 1.1rem; flex-shrink: 0; }

/* ─── Responsive ─── */
@media (min-width: 640px) {
    .contact-container { padding: 0 1.5rem; }
    .contact-form-row { grid-template-columns: 1fr 1fr; }
    .contact-sidebar { padding: 2rem; }
}

@media (min-width: 768px) {
    .contact-content { padding: 4rem 0 3rem; }
    .contact-grid {
        grid-template-columns: 1.2fr 0.8fr;
        gap: 2rem;
        align-items: start;
    }
}

@media (min-width: 1024px) {
    .contact-hero {
        min-height: 46vh;
        padding: 8rem 2rem 3.5rem;
    }
    .contact-content {
        padding: 4.5rem 0 3.5rem;
    }
    .contact-container { padding: 0 2rem; }
    .contact-grid {
        grid-template-columns: 1.3fr 0.7fr;
        gap: 3rem;
        align-items: start;
    }
    .contact-sidebar { padding: 2.25rem; }
}
</style>

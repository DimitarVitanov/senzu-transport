<template>
    <div class="min-h-screen">
        <Navbar :phone="nav.phone" :phone-raw="nav.phone_raw" />
        <slot />
        <FooterSection :facebook-url="nav.facebook_url" :instagram-url="nav.instagram_url" />
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import FooterSection from '@/Components/FooterSection.vue';

const page = usePage();
const nav = computed(() => page.props.nav || {});
</script>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({});
</script>

<template>
  <GuestLayout>
    <Head title="Welcome" />

    <h1 class="text-3xl bold">Welcome to RecipeBook</h1>
  </GuestLayout>
</template>

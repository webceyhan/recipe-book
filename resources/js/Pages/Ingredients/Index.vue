<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
  ingredients: {
    type: Array,
    default: () => [],
  },
});
</script>

<template>
  <GuestLayout>
    <Head title="Ingredients" />

    <h1 class="text-3xl bold">Ingredients</h1>

    <ul>
      <li v-for="(ingredient, i) in ingredients" :key="i">
        {{ ingredient.name }}
      </li>
    </ul>
  </GuestLayout>
</template>

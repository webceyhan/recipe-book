<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
  recipes: {
    type: Array,
    default: () => [],
  },
});
</script>

<template>
  <GuestLayout>
    <Head title="Recipes" />

    <h1 class="text-3xl bold">Recipes</h1>

    <ul>
      <li v-for="(recipe, i) in recipes" :key="i">
        {{ recipe.name }}
      </li>
    </ul>
  </GuestLayout>
</template>

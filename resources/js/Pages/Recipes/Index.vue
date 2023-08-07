<script setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import RecipeCard from "@/Components/RecipeCard.vue";
import RecipeSearchFilter from "@/Components/RecipeSearchFilter.vue";

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

    <RecipeSearchFilter />

    <!-- card list -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <RecipeCard v-for="(recipe, i) in recipes" :key="i" :recipe="recipe" />
    </div>
  </GuestLayout>
</template>

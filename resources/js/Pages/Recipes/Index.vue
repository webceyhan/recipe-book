<script setup>
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import RecipeCard from "@/Components/RecipeCard.vue";
import RecipeSearchFilter from "@/Components/RecipeSearchFilter.vue";
import RecipeCuisineFilter from "@/Components/RecipeCuisineFilter.vue";

defineProps({
  recipes: {
    type: Array,
    default: () => [],
  },
  cuisine: {
    type: String,
    default: undefined,
  },
  cuisineOptions: {
    type: Array,
    default: () => [],
  },
});
</script>

<template>
  <GuestLayout>
    <Head title="Recipes" />

    <div class="flex justify-between items-center">
      <h1 class="text-3xl bold">Recipes</h1>
      <Link
        :href="route('recipes.create')"
        class="btn btn-primary shadow rounded-3xl"
        >create</Link
      >
    </div>

    <RecipeSearchFilter />
    <RecipeCuisineFilter :options="cuisineOptions" :value="cuisine" />

    <!-- card list -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <RecipeCard v-for="(recipe, i) in recipes" :key="i" :recipe="recipe" />
    </div>
  </GuestLayout>
</template>

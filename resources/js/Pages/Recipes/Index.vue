<script setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Button from "@/Components/Button.vue";
import RecipeCard from "./Partials/RecipeCard.vue";
import RecipeSearchFilter from "./Partials/RecipeSearchFilter.vue";
import RecipeCuisineFilter from "./Partials/RecipeCuisineFilter.vue";

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
      <Button :href="route('recipes.create')" class="rounded-full" large> create </Button>
    </div>

    <RecipeSearchFilter />
    <RecipeCuisineFilter :options="cuisineOptions" :value="cuisine" />

    <!-- card list -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <RecipeCard v-for="(recipe, i) in recipes" :key="i" :recipe="recipe" />
    </div>
  </GuestLayout>
</template>

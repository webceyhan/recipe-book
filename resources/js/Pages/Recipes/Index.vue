<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import RecipeCard from "@/Components/RecipeCard.vue";

defineProps({
  recipes: {
    type: Array,
    default: () => [],
  },
});

const handleSearch = (name) => {
  router.reload({
    data: { name },
    preserveState: true,
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Recipes" />

    <h1 class="text-3xl bold">Recipes</h1>

    <!-- search by name -->
    <div class="w-full">
      <h6 class="text-sm font-bold uppercase mb-2">Search by name</h6>
      <input
        type="search"
        placeholder="type something..."
        class="input input-bordered w-full max-w-md"
        @input="handleSearch($event.target.value)"
      />
    </div>

    <!-- card list -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <RecipeCard v-for="(recipe, i) in recipes" :key="i" :recipe="recipe" />
    </div>
  </GuestLayout>
</template>

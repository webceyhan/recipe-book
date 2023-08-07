<script setup>
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import IngredientList from "@/Components/IngredientList.vue";

defineProps({
  recipe: {
    type: Object,
    default: () => ({}),
  },
});
</script>

<template>
  <GuestLayout>
    <Head title="Recipe Details" />

    <!-- image -->
    <figure class="overflow-hidden max-h-40">
      <img :src="recipe.image_url" alt="recipe" class="w-full h-auto" />
    </figure>

    <header class="flex items-center justify-between">
      <!-- name -->
      <h1 class="text-3xl bold capitalize">{{ recipe.name }}</h1>

      <!-- cuisine -->
      <div class="badge badge-secondary">{{ recipe.cuisine }}</div>
    </header>

    <!-- ingredients -->
    <section>
      <h2 class="text-lg font-bold mb-2">Ingredients</h2>
    <IngredientList :ingredients="recipe.ingredients" />
    </section>

    <!-- instructions -->
    <section>
      <h2 class="text-lg font-bold mb-2">Instructions</h2>
      <pre class="whitespace-pre-wrap font-sans" v-html="recipe.instructions" />
    </section>

    <!-- actions -->
    <footer class="flex items-center gap-4">
      <Link :href="route('recipes.edit', recipe.id)" class="btn btn-sm btn-primary">
        edit
      </Link>

      <Link
        :href="route('recipes.destroy', recipe.id)"
        class="btn btn-sm btn-error btn-outline"
        method="delete"
        as="button"
      >
        delete
      </Link>
    </footer>
  </GuestLayout>
</template>

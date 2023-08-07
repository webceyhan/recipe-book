<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  recipe: {
    type: Object,
  },
});
</script>

<template>
  <div class="card glass shadow-xl">
    <!-- image -->
    <figure class="overflow-hidden max-h-40">
      <img :src="recipe.image_url" alt="recipe" class="w-100 h-auto" />
    </figure>

    <div class="card-body">
      <!-- name -->
      <h2 class="card-title capitalize">
        {{ recipe.name }}
      </h2>

      <div class="card-actions justify-between items-center">
        <!-- cuisine -->
        <div class="badge badge-secondary">{{ recipe.cuisine }}</div>

        <!-- read button -->
        <Link
          :href="route('recipes.show', recipe.id)"
          class="btn btn-sm btn-primary btn-outline"
        >
          read
        </Link>
      </div>
    </div>
  </div>
</template>

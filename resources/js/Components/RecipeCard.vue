<script setup>
import Badge from "./Badge.vue";
import Button from "./Button.vue";

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
        <Badge>{{ recipe.cuisine }}</Badge>

        <!-- read button -->
        <Button :href="route('recipes.show', recipe.id)" ghost small> read </Button>
      </div>
    </div>
  </div>
</template>

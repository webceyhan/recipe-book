<script setup>
import Badge from "./Badge.vue";
import Button from "./Button.vue";
import Card from "./Card.vue";

defineProps({
  recipe: {
    type: Object,
  },
});
</script>

<template>
  <Card :title="recipe.name" :cover="recipe.image_url">
    <template #actions>
      <!-- cuisine -->
      <Badge>{{ recipe.cuisine }}</Badge>

      <!-- read button -->
      <Button :href="route('recipes.show', recipe.id)" ghost small> read </Button>
    </template>
  </Card>
</template>

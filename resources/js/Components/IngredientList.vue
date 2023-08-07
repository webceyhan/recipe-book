<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  ingredients: {
    type: Array,
    default: () => [],
  },
});
</script>

<template>
  <ul class="divide-y divide-y-1 divide-gray-200">
    <li
      v-for="(ingredient, i) in ingredients"
      :key="i"
      class="flex justify-between items-center"
    >
      <div>{{ ingredient.name }}</div>

      <div>
        <span v-if="ingredient.pivot" class="badge badge-ghost">
          {{ ingredient.pivot.quantity }}
        </span>

        <slot name="actions" />
      </div>
    </li>
  </ul>
</template>

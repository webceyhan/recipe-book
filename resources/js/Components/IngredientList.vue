<script setup>
import { Link } from "@inertiajs/vue3";

defineEmits(["delete"]);

defineProps({
  ingredients: {
    type: Array,
    default: () => [],
  },
  canDelete: {
    type: Boolean,
    default: false,
  },
});
</script>

<template>
  <ul class="divide-y divide-y-1 divide-gray-200">
    <li
      v-for="(ingredient, i) in ingredients"
      :key="i"
      class="flex justify-between items-center p-2"
    >
      <div>{{ ingredient.name }}</div>

      <div>
        <span v-if="ingredient.pivot" class="badge badge-ghost">
          {{ ingredient.pivot.quantity }}
        </span>

        <Link
          v-if="canDelete"
          :href="route('ingredients.destroy', ingredient.id)"
          class="btn btn-xs btn-error btn-outline"
          method="delete"
          as="button"
        >
          x
        </Link>
      </div>
    </li>
  </ul>
</template>

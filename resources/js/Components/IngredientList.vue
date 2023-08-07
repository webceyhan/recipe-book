<script setup>
import { Link, router } from "@inertiajs/vue3";

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

function deleteIngredient(id) {
  try {
    router.delete(route("ingredients.destroy", id), {
    preserveState: true,
  });
  } catch (error) {
    // doesn't work yet!
    console.log(error);
  }
  finally {
    console.log('error finished')
  }

  
}
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

        <button
          v-if="canDelete"
          class="btn btn-xs btn-error btn-outline"
          @click="deleteIngredient(ingredient.id)"
        >
          x
        </button>
      </div>
    </li>
  </ul>
</template>

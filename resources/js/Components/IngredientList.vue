<script setup>
import { router } from "@inertiajs/vue3";
import { onUnmounted } from "vue";
import Badge from "./Badge.vue";
import Button from "./Button.vue";

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

// global even for invalid responses
const removeListener = router.on("invalid", (event) => {
  // get the response status code
  const { status } = event.detail.response;

  // handle if the response is 403
  if (status === 403) {
    // prevent default popup behavior
    event.preventDefault();

    // handle the error as you wish...
    alert("Ingredient is in use. Cannot be deleted!");
  }
});

onUnmounted(() => {
  removeListener();
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
        <Badge v-if="ingredient.pivot" ghost>
          {{ ingredient.pivot.quantity }}
        </Badge>

        <Button
          v-if="canDelete"
          :href="route('ingredients.destroy', ingredient.id)"
          method="delete"
          danger
          small
        >
          x
        </Button>
      </div>
    </li>
  </ul>
</template>

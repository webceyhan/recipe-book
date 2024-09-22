<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Button from "@/Components/Button.vue";
import FormControl from "@/Components/FormControl.vue";
import RecipeIngredientSelector from "./Partials/RecipeIngredientSelector.vue";

const { recipe, ingredients, ingredientOptions } = defineProps({
  recipe: {
    type: Object,
    default: () => ({}),
  },
  ingredients: {
    type: Array,
    default: () => [],
  },
  cuisineOptions: {
    type: Array,
    default: () => [],
  },
  ingredientOptions: {
    type: Array,
    default: () => [],
  },
});

const isEdit = !!recipe.id;
const title = isEdit ? "Edit Recipe" : "Create New Recipe";

const form = useForm({
  name: recipe.name ?? "",
  cuisine: recipe.cuisine ?? "",
  instructions: recipe.instructions ?? "",
  ingredients: ingredients ?? [],
  picture: "",
});

function back() {
  window.history.back();
}

function handleSubmit() {
  if (isEdit) {
    form.put(route("recipes.update", recipe.id));
  } else {
    form.post(route("recipes.store"));
  }
}
</script>

<template>
  <GuestLayout>
    <Head :title="title" />

    <h1 class="text-3xl bold capitalize">{{ title }}</h1>

    <form class="grid lg:grid-cols-2 w-full gap-4" @submit.prevent>
      <div class="space-y-4">
        <!-- name -->
        <FormControl label="Recipe Name" v-model="form.name" />

        <!-- picture -->
        <FormControl label="Upload picture" type="file" v-model="form.picture" />

        <!-- cuisine -->
        <FormControl
          label="Select cuisine"
          :options="cuisineOptions"
          v-model="form.cuisine"
        />
      </div>

      <!-- ingredients -->
      <RecipeIngredientSelector
        :ingredients="form.ingredients"
        :ingredientOptions="ingredientOptions"
      />

      <!-- instructions -->
      <FormControl
        class="col-span-full"
        label="Instructions"
        rows="5"
        v-model="form.instructions"
      />

      <!-- actions -->
      <div class="col-span-full flex justify-end gap-4">
        <Button @click="back()" ghost>Cancel</Button>
        <Button @click="handleSubmit()"> Save </Button>
      </div>
    </form>
  </GuestLayout>
</template>

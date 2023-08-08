<script setup>
import { ref, computed } from "vue";
import { Head, useForm } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Button from "@/Components/Button.vue";
import FormControl from "@/Components/FormControl.vue";
import Input from "@/Components/Input.vue";

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

const normalizedIngredientOptions = computed(() => {
  return ingredientOptions.map((opt) => ({
    label: opt.name,
    value: opt.id,
  }));
});

const newIngredientId = ref(null);

function addIngredient() {
  if (!newIngredientId.value) return;

  form.ingredients.push({
    id: newIngredientId.value,
    name: ingredientOptions.find(({ id }) => id === +newIngredientId.value).name,
    quantity: 1,
  });

  newIngredientId.value = null;
}

function removeIngredient(index) {
  form.ingredients.splice(index, 1);
}
</script>

<template>
  <GuestLayout>
    <Head :title="title" />

    <h1 class="text-3xl bold capitalize">{{ title }}</h1>

    <form class="w-full space-y-4" @submit.prevent>
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

      <!-- ingredients -->
      <section>
        <div class="flex items-end gap-x-4">
          <FormControl
            label="Select ingredient"
            :options="normalizedIngredientOptions"
            v-model="newIngredientId"
          />

          <Button ghost @click="addIngredient()"> add new ingredient </Button>
        </div>

        <ul class="divide-y divide-y-1 divide-gray-200">
          <li
            v-for="(ingredient, i) in form.ingredients"
            class="flex items-center justify-between py-2 max-w-md space-x-4"
            :key="i"
          >
            <span class="w-full" v-html="ingredient.name" />

            <Input type="number" class="w-24" v-model="ingredient.quantity" />

            <Button danger small @click="removeIngredient(i)">x</Button>
          </li>
        </ul>
      </section>

      <!-- instructions -->
      <FormControl label="Instructions" rows="5" v-model="form.instructions" />

      <!-- actions -->
      <div class="flex justify-end gap-4">
        <Button @click="back()" ghost>Cancel</Button>
        <Button @click="handleSubmit()"> Save </Button>
      </div>
    </form>
  </GuestLayout>
</template>

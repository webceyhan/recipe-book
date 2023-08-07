<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import IngredientList from "@/Components/IngredientList.vue";
import { ref } from "vue";

const { recipe, ingredients } = defineProps({
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

const newIngredient = ref(null);

function addIngredient() {
  if (!newIngredient) return;

  form.ingredients.push({
    id: newIngredient.value.id,
    name: newIngredient.value.name,
    quantity: 1,
  });

  newIngredient.value = null;
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
      <div class="form-control w-full max-w-xl">
        <label class="label">
          <span class="label-text">Recipe name</span>
        </label>
        <input type="text" class="input input-bordered w-full" v-model="form.name" />
      </div>

      <!-- picture -->
      <div class="form-control w-full">
        <label class="label">
          <span class="label-text">Upload picture</span>
        </label>
        <input
          type="file"
          class="file-input file-input-bordered w-full max-w-sm"
          @input="form.picture = $event.target.files[0]"
        />
      </div>

      <!-- cuisine -->
      <div class="form-control w-full">
        <label class="label">
          <span class="label-text">Select cuisine</span>
        </label>
        <select class="select select-bordered w-full max-w-xs" v-model="form.cuisine">
          <option v-for="opt in cuisineOptions" :key="opt" :value="opt">
            {{ opt }}
          </option>
        </select>
      </div>

        <!-- ingredients -->
        <section>
          <label class="label">
            <span class="label-text">Ingredients</span>
          </label>

          <div class="flex items-center gap-x-4">
            <select
              class="select select-bordered w-full max-w-md"
              v-model="newIngredient"
            >
              <option v-for="opt in ingredientOptions" :key="opt.id" :value="opt">
                {{ opt.name }}
              </option>
            </select>
            <button class="btn btn-primary btn-outline" @click="addIngredient()">
              add new ingredient
            </button>
          </div>

          <ul class="divide-y divide-y-1 divide-gray-200">
            <li
              v-for="(ingredient, i) in form.ingredients"
              class="flex items-center justify-between py-2 max-w-md space-x-4"
              :key="i"
            >
              <span class="w-full" v-html="ingredient.name" />

              <input
                type="number"
                class="input input-sm input-bordered w-24"
                v-model="ingredient.quantity"
              />

              <button
                type="button"
                class="btn btn-sm btn-error btn-outline"
                @click="removeIngredient(i)"
              >
                X
              </button>
            </li>
          </ul>
        </section>

      <!-- instructions -->
      <div class="form-control w-full">
        <label class="label">
          <span class="label-text">Instructions</span>
        </label>
        <textarea
          class="textarea textarea-bordered"
          rows="5"
          v-model="form.instructions"
        />
      </div>

      <!-- actions -->
      <div class="flex justify-end gap-4">
        <button class="btn btn-secondary btn-outline" @click="back()">Cancel</button>

        <button type="button" class="btn btn-primary" @click="handleSubmit()">
          Save
        </button>
      </div>
    </form>
  </GuestLayout>
</template>

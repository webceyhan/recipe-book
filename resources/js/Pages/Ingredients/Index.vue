<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import IngredientList from "@/Components/IngredientList.vue";

defineProps({
  ingredients: {
    type: Array,
    default: () => [],
  },
});

const form = useForm({
  name: "",
});

function addIngredient() {
  form.post(route("ingredients.store"), {
    onSuccess: () => form.reset(),
    preserveState: true,
  });
}
</script>

<template>
  <GuestLayout>
    <Head title="Ingredients" />

    <h1 class="text-3xl bold">Ingredients</h1>

    <form @submit.prevent="addIngredient()" class="flex gap-4">
      <input
        type="text"
        placeholder="new ingredient..."
        class="input input-bordered w-full max-w-xs"
        v-model="form.name"
      />
      <button type="submit" class="btn btn-primary">add</button>
    </form>

    <IngredientList :ingredients="ingredients" canDelete />
      
  </GuestLayout>
</template>

<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Input from "@/Components/Input.vue";
import Button from "@/Components/Button.vue";
import IngredientList from "./Partials/IngredientList.vue";

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
      <Input placeholder="new ingredient..." v-model="form.name" />
      <Button type="submit">add</Button>
    </form>

    <IngredientList :ingredients="ingredients" canDelete />
  </GuestLayout>
</template>

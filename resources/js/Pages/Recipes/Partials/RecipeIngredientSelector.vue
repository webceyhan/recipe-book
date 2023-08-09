<script setup>
import { ref, computed } from "vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import FormControl from "@/Components/FormControl.vue";

const props = defineProps({
  ingredients: {
    type: Array,
    default: () => [],
  },
  ingredientOptions: {
    type: Array,
    default: () => [],
  },
});

const selectedId = ref(null);

const normalizedIngredientOptions = computed(() => {
  return props.ingredientOptions.map((opt) => ({
    label: opt.name,
    value: opt.id,
  }));
});

function addIngredient() {
  if (!selectedId.value) return;

  props.ingredients.push({
    id: selectedId.value,
    name: props.ingredientOptions.find(({ id }) => id === +selectedId.value).name,
    quantity: 1,
  });

  selectedId.value = null;
}

function removeIngredient(index) {
  props.ingredients.splice(index, 1);
}
</script>

<template>
  <section>
    <div class="flex items-end gap-x-4">
      <FormControl
        label="Select ingredient"
        :options="normalizedIngredientOptions"
        v-model="selectedId"
      />

      <Button ghost @click="addIngredient()"> add new ingredient </Button>
    </div>

    <ul class="divide-y divide-y-1 divide-gray-200">
      <li
        v-for="(ingredient, i) in ingredients"
        class="flex items-center justify-between py-2 max-w-md space-x-4"
        :key="i"
      >
        <span class="w-full" v-html="ingredient.name" />

        <Input type="number" class="w-24" v-model="ingredient.quantity" />

        <Button danger small @click="removeIngredient(i)">x</Button>
      </li>
    </ul>
  </section>
</template>

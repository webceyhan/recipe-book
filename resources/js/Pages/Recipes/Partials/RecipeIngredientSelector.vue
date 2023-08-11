<script setup>
import { ref, computed } from "vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Input.vue";
import FormControl from "@/Components/FormControl.vue";
import List from "@/Components/List.vue";
import ListItem from "@/Components/ListItem.vue";

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
  <section class="space-y-4">
    <div class="flex items-end gap-x-4">
      <FormControl
        label="Select ingredient"
        :options="normalizedIngredientOptions"
        v-model="selectedId"
      />

      <Button ghost @click="addIngredient()"> add new ingredient </Button>
    </div>



    <List>
      <ListItem v-for="(ingredient, i) in ingredients" :key="i">
        <span class="w-full" v-html="ingredient.name" />
        <Input type="number" class="input-sm w-24" v-model="ingredient.quantity" />
        <Button danger small @click="removeIngredient(i)">x</Button>
      </ListItem>
    </List>
  </section>
</template>

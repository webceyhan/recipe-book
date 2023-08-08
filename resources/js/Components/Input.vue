<script setup>
defineEmits(["update:modelValue"]);

defineProps({
  modelValue: {
    type: String,
    default: "",
  },
});
</script>

<template>
  <input
    type="text"
    class="input input-bordered w-full"
    @input="$emit('update:modelValue', $event.target.value)"
    :value="modelValue"
  />
</template>

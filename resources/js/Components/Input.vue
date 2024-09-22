<script setup>
defineEmits(["update:modelValue"]);

defineProps(["modelValue"]);
</script>

<template>
  <textarea
    v-if="$attrs.rows"
    class="textarea textarea-bordered w-full"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />

  <input
    v-else-if="$attrs.type === 'file'"
    class="file-input file-input-bordered w-full"
    @input="$emit('update:modelValue', $event.target.files[0])"
  />

  <input
    v-else
    type="text"
    class="input input-bordered w-full"
    @input="$emit('update:modelValue', $event.target.value)"
    :value="modelValue"
  />
</template>

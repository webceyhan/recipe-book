<script setup>
defineEmits(["update:modelValue"]);

defineProps(["modelValue", "options"]);

const normalize = (options) => {
  return options.map((opt) => ({
    label: opt.label ?? opt,
    value: opt.value ?? opt,
  }));
};
</script>

<template>
  <select
    class="select select-bordered w-full"
    @change="$emit('update:modelValue', $event.target.value)"
    :value="modelValue"
  >
    <option v-for="(opt, i) in normalize(options)" :key="i" :value="opt.value">
      {{ opt.label }}
    </option>
  </select>
</template>

<script>
export default {
  inheritAttrs: false,
};
</script>

<script setup>
import Input from "./Input.vue";
import Select from "./Select.vue";

defineEmits(["update:modelValue"]);

defineProps(["label", "class"]);
</script>

<template>
  <div class="form-control w-full" :class="class">
    <label v-if="label" class="label">
      <span class="label-text" v-html="label" />
    </label>

    <Select
      v-if="$attrs.options"
      v-bind="{ ...$attrs }"
      @update:model-value="$emit('update:modelValue', $event)"
    />

    <Input
      v-else
      v-bind="{ ...$attrs }"
      @update:model-value="$emit('update:modelValue', $event)"
    />
  </div>
</template>

<script setup>
import { watch } from "vue";
import { useFlash } from "@/utils";
import { computed } from "vue";

const props = defineProps({
  message: String,
  flashable: Boolean,
});

const { shown, flash } = useFlash(!props.flashable);

const variants = {
  created: "alert-success",
  updated: "alert-info",
  deleted: "alert-error",
};

// change the variant based on the action
// parsed from the message prop
const variant = computed(() => {
  const [action] = props.message.match(/created|updated|deleted/);
  return variants[action] ?? "alert-info";
});

if (props.flashable) {
  watch(
    () => props.message,
    () => flash()
  );
  props.message && flash();
}
</script>

<template>
  <div v-if="shown" class="alert" :class="variant">
    <span>
      <slot>{{ message }}</slot>
    </span>
  </div>
</template>

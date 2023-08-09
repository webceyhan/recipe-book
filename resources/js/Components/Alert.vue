<script setup>
import { ref, watch } from "vue";
import { delay } from "@/utils";

const props = defineProps({
  message: String,
  flashable: Boolean,
});

const shown = ref(!props.flashable);

const flash = async () => {
  shown.value = true;
  await delay(3000); // wait 3 seconds
  shown.value = false;
};

if (props.flashable) {
  watch(
    () => props.message,
    () => flash()
  );
  props.message && flash();
}
</script>

<template>
  <div class="alert alert-info" v-if="shown">
    <span>
      <slot>{{ message }}</slot>
    </span>
  </div>
</template>

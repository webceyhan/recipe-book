<script setup>
defineProps({
  ghost: Boolean,
});
</script>

<template>
  <div
    class="badge"
    :class="{
      'badge-secondary': !ghost,
      'badge-ghost': ghost,
    }"
  >
    <slot />
  </div>
</template>

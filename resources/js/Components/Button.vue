<script setup>
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
  small: Boolean,
  large: Boolean,
  ghost: Boolean, // btn-ghost + btn-outline
  danger: Boolean, // btn-error,
});

const classes = computed(() => ({
  btn: true,
  "btn-sm": props.small,
  "btn-lg": props.large,
  "btn-primary": !props.ghost && !props.danger,
  "btn-ghost btn-outline": props.ghost,
  "btn-error btn-outline": props.danger,
}));
</script>

<template>
  <Link v-if="$attrs.href" :class="classes" as="button">
    <slot />
  </Link>

  <button v-else type="button" :class="classes">
    <slot />
  </button>
</template>

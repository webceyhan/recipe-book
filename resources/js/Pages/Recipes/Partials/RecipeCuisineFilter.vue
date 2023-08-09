<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  value: {
    type: String,
    default: undefined,
  },
  options: {
    type: Array,
    default: () => [],
  },
});
</script>

<template>
  <div>
    <h6 class="text-sm font-bold uppercase mb-2">Filter by cuisine</h6>
    <div class="flex items-center gap-2">
      <Link
        v-if="value"
        class="btn btn-xs btn-neutral btn-outline"
        :href="$page.url"
        :data="{ cuisine: undefined }"
        preserve-state
      >
        any
      </Link>

      <Link
        v-for="opt in options"
        class="btn btn-xs btn-neutral"
        :class="{
          'btn-primary': value === opt,
          'btn-outline': value !== opt,
        }"
        :key="opt"
        :href="$page.url"
        :data="{ cuisine: opt }"
        preserve-state
      >
        {{ opt }}
      </Link>
    </div>
  </div>
</template>

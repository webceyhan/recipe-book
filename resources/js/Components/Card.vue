<script setup>
defineProps({
  cover: {
    type: String,
  },
  title: {
    type: String,
  },
});
</script>

<template>
  <div class="card glass shadow-xl">
    <!-- cover -->
    <figure v-if="cover" class="overflow-hidden max-h-32">
      <img :src="cover" class="object-cover w-full h-auto" />
    </figure>

    <div class="card-body space-y-4">
      <!-- title -->
      <h2 v-if="title" class="card-title capitalize" v-html="title" />

      <!-- content -->
      <slot />

      <!-- actions -->
      <div v-if="$slots.actions" class="card-actions justify-between items-center">
        <slot name="actions" />
      </div>
    </div>
  </div>
</template>

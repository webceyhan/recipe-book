<script setup>
import { router } from "@inertiajs/vue3";
import Input from "./Input.vue";

const handleSearch = (name) => {
  router.reload({
    data: { name },
    preserveState: true,
  });
};
</script>

<template>
  <div>
    <h6 class="text-sm font-bold uppercase mb-2">Search by name</h6>
    <Input
      type="search"
      placeholder="type something..."
      @update:model-value="handleSearch"
    />
  </div>
</template>

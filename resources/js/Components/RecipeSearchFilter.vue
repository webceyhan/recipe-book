<script setup>
import { router } from "@inertiajs/vue3";

const handleSearch = (name) => {
  router.reload({
    data: { name },
    preserveState: true,
  });
};
</script>

<template>
  <div class="w-full">
    <h6 class="text-sm font-bold uppercase mb-2">Search by name</h6>
    <input
      type="search"
      placeholder="type something..."
      class="input input-bordered w-full max-w-md"
      @input="handleSearch($event.target.value)"
    />
  </div>
</template>

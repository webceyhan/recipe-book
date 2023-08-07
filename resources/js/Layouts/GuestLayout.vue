<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <div class="w-full max-w-5xl mx-auto p-8 space-y-8">
    <header class="shadow">
      <Link href="/">Home </Link>
    </header>

    <main class="w-full">
      <slot />
    </main>
  </div>
</template>

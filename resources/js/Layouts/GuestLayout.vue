<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <div class="w-full max-w-5xl mx-auto p-8 space-y-8">
    <header class="flex items-center gap-x-4 shadow">
      <Link href="/">Home </Link>
      <Link :href="route('recipes.index')">Recipes</Link>
      <Link :href="route('ingredients.index')">Ingredients</Link>
    </header>

    <main class="w-full space-y-8">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const links = [
  {
    name: "Recipes",
    route: "recipes.index",
  },
  {
    name: "Ingredients",
    route: "ingredients.index",
  },
];
</script>

<template>
  <div class="w-full max-w-5xl mx-auto p-8 space-y-8">
    <!-- main navigation -->
    <nav class="navbar bg-base-100 rounded-lg shadow-lg">
      <div class="flex-none">
        <!-- logo -->
        <Link
          :href="route('home')"
          class="btn btn-ghost normal-case text-xl"
          :class="{ '!btn-neutral': route().current('home') }"
        >
          Home
        </Link>
      </div>
      <div class="navbar-center">
        <ul class="menu menu-horizontal px-1">
          <li v-for="(link, i) in links" :key="1">
            <Link
              :href="route(link.route)"
              :class="{ active: route().current(link.route) }"
              v-html="link.name"
            />
          </li>
        </ul>
      </div>
    </nav>

    <main class="w-full space-y-8">
      <slot />
    </main>
  </div>
</template>

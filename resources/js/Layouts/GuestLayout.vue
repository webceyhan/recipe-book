<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { ref, computed, watch } from "vue";

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

const delay = (ms = 1000) => new Promise((resolve) => setTimeout(resolve, ms));

const toastShown = ref(false);
const toastMessage = ref("");

const flashToast = async (message) => {
  toastMessage.value = message;
  toastShown.value = true;
  await delay(3000); // wait 3 seconds
  toastShown.value = false;
};

const status = computed(() => usePage().props.status);

watch(status, (value) => flashToast(value));

status.value && flashToast(status.value);
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

    <div class="toast" v-if="toastShown">
      <div class="alert alert-info">
        <span>{{ toastMessage }}</span>
      </div>
    </div>
  </div>
</template>

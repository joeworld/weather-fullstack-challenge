<script setup lang="ts">
  import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <header>
    <div
            class="wrapper max-w-6xl mx-auto py-4 border-b border-gray-100 sm:mb-6"
    >
      <nav class="flex">
        <RouterLink to="/" class="font-semibold">Home</RouterLink>
      </nav>
    </div>
  </header>
  <RouterView />
</template>

<style scoped></style>
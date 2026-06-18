<template>
    <div class="flex h-screen">
        <app-sidebar />
        <slot />
    </div>
</template>

<script setup lang="ts">
import AppSidebar from "@/components/AppSidebar.vue";
</script>

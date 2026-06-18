<template>
    <ChatEmptyWindow />
</template>

<script setup lang="ts">
import ChatEmptyWindow from "@/components/ChatEmptyWindow.vue";

import ChatLayout from "@/layouts/ChatLayout.vue";

defineOptions({
    layout: ChatLayout,
});
</script>

<template>
    <ChatWindow :chat />
</template>

<script setup lang="ts">
import ChatLayout from "@/layouts/ChatLayout.vue";
import ChatWindow from "@/components/ChatWindow.vue";

defineOptions({
    layout: ChatLayout,
});

defineProps({
    chat: Object,
});
</script>

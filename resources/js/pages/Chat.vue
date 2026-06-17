<template>
    <AppSidebar :chats />
    <ChatWindow :chat />
</template>

<script setup lang="ts">
import ChatLayout from "../layouts/ChatLayout.vue";
import AppSidebar from "@/components/AppSidebar.vue";
import ChatWindow from "@/components/ChatWindow.vue";

defineOptions({
    layout: ChatLayout,
});

defineProps({
    chat: Object,
    chats: Object,
});
</script>

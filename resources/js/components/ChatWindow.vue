<template>
    <div class="flex h-full flex-1 flex-col">
        <ChatHeader :username="chat?.data.username" :chatId="chat?.data.id" />
        <ChatMessages :messages="chat?.data.relationships.messages" />
        <ChatMessageInput />
    </div>
</template>

<script setup lang="ts">
import ChatHeader from "./ChatHeader.vue";
import ChatMessageInput from "./ChatMessageInput.vue";
import ChatMessages from "./ChatMessages.vue";

const props = defineProps({
    chat: Object,
});
</script>

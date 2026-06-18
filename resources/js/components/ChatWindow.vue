<template>
    <div class="flex h-full flex-1 flex-col">
        <ChatHeader :username="chat?.username" />
        <ChatMessages />
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

const chat = props.chat?.data;
</script>

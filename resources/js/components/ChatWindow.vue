<template>
    <div class="flex h-full flex-1 flex-col">
        <ChatHeader />
        <ChatMessages />
        <ChatMessageInput />
    </div>
</template>

<script setup lang="ts">
import ChatHeader from "./ChatHeader.vue";
import ChatMessageInput from "./ChatMessageInput.vue";
import ChatMessages from "./ChatMessages.vue";
</script>

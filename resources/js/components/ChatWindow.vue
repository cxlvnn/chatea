<template>
    <div class="flex h-full flex-1 flex-col">
        <ChatHeader :username="chat?.data.username" :chatId="chat?.data.id" />
        <ChatMessages
            :messages="chat?.data.relationships.messages"
            :chatId="chat?.data.id"
        />
        <ChatMessageInput :chatId="chat?.data.id" />
    </div>
</template>

<script setup lang="ts">
import { useEchoPresence } from "@laravel/echo-vue";
import ChatHeader from "./ChatHeader.vue";
import ChatMessageInput from "./ChatMessageInput.vue";
import ChatMessages from "./ChatMessages.vue";
import { onMounted } from "vue";

const props = defineProps({
    chat: Object,
});

const { channel } = useEchoPresence(
    `room.${props.chat?.data.id}`,
    "",
    () => {},
);

onMounted(() => {
    channel().here((users) => {
        console.log(users);
    });
});
</script>

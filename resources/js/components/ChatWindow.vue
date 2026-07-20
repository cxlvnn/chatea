<template>
    <div class="flex h-full flex-1 flex-col">
        <ChatHeader
            :username="chat?.data.username"
            :chatId="chat?.data.id"
            :isOnline="chat?.data.isOnline"
        />
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

type user = {
    id: number;
    username: string;
};

const props = defineProps({
    chat: Object,
});

const { channel } = useEchoPresence(
    `room.${props.chat?.data.id}`,
    "",
    () => {},
);

onMounted(() => {
    channel()
        .here((users: user[]) => {
            users.forEach((user) => {
                console.log(user.username);
            });
        })
        .joining((user: user) => {
            console.log("joined: ", user);
        })
        .leaving((user: user) => {
            console.log("leaving: ", user);
        });
});
</script>

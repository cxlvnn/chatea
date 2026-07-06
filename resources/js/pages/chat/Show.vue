<template>
    <ChatWindow :chat />
</template>

<script setup lang="ts">
import ChatLayout from "@/layouts/ChatLayout.vue";
import ChatWindow from "@/components/ChatWindow.vue";
import { useEcho } from "@laravel/echo-vue";

defineOptions({
    layout: ChatLayout,
});

const props = defineProps<{
    chat: {
        data: {
            id: number;
            username: string;
            relationships: [
                messages: {
                    id: number;
                    content: string;
                    time: string;
                    sent: boolean;
                },
            ];
        };
    };

    auth: {
        user: {
            id: number;
        };
    };
}>();

useEcho(`user.${props.auth.user.id}`, ".chat.created", (e) => {
    console.log(e.chat);
});
</script>

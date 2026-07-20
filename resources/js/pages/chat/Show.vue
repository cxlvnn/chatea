<template>
    <ChatWindow :chat />
</template>

<script setup lang="ts">
import ChatLayout from "@/layouts/ChatLayout.vue";
import ChatWindow from "@/components/ChatWindow.vue";

defineOptions({
    layout: ChatLayout,
});

const props = defineProps<{
    chat: {
        data: {
            id: number;
            username: string;
            isOnline: boolean;
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
}>();

console.log("from show.vue: ", props.chat);
</script>

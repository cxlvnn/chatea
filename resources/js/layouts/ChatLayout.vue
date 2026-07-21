<template>
    <div class="flex h-screen">
        <app-sidebar />
        <slot />
    </div>
</template>

<script setup lang="ts">
import AppSidebar from "@/components/AppSidebar.vue";
import { usePage } from "@inertiajs/vue3";
import { useEcho, useEchoPresence } from "@laravel/echo-vue";
import { provide, ref } from "vue";
import { onMounted } from "vue";

type user = {
    id: number;
    username: string;
};

const props = defineProps<{
    auth: {
        user: {
            id: number;
        };
    };
}>();

const page = usePage<{
    chats: {
        data: Array<{
            id: number;
            username: string;
            initial: string;
            isOnline: boolean;
        }>;
    };
}>();

const { channel } = useEchoPresence(`online`, "", () => {});
const onlineUsersId = ref<Set<number>>(new Set());

onMounted(() => {
    channel()
        .here((users: user[]) => {
            users.forEach((user) => {
                onlineUsersId.value = new Set(onlineUsersId.value.add(user.id));
            });
        })
        .joining((user: user) => {
            onlineUsersId.value = new Set(onlineUsersId.value.add(user.id));
        })
        .leaving((user: user) => {
            onlineUsersId.value.delete(user.id);
        });
});

provide("onlineUsersId", onlineUsersId);

useEcho(`user.${props.auth.user.id}`, ".chat.created", (e) => {
    page.props.chats.data.push(e.chat);
});
</script>

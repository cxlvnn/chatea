<template>
    <div class="flex h-screen">
        <app-sidebar />
        <slot />
    </div>
</template>

<script setup lang="ts">
import AppSidebar from "@/components/AppSidebar.vue";
import { usePage } from "@inertiajs/vue3";
import { useEcho } from "@laravel/echo-vue";

const props = defineProps<{
    auth: {
        user: {
            id: number;
        };
    };
}>();

const page = usePage<{
    chats: { data: Array<{ id: number; username: string; initial: string }> };
}>();

useEcho(`user.${props.auth.user.id}`, ".chat.created", (e) => {
    page.props.chats.data.push(e.chat);
});
</script>

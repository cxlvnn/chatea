<template>
    <div
        class="flex h-14 shrink-0 items-center justify-between border-b border-border px-4"
    >
        <div class="flex flex-col">
            <span class="text-xs font-medium text-foreground">{{
                username
            }}</span>
            <span class="text-[10px] text-muted-foreground">{{
                onlineStatus
            }}</span>
        </div>
        <Link :href="`/chats/${chatId}`" method="delete">
            <Button variant="outline" size="icon-sm">
                <IconDelete />
            </Button>
        </Link>
    </div>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import IconDelete from "./IconDelete.vue";
import Button from "./ui/button/Button.vue";
import { computed, inject, ref } from "vue";
import { onlineUsersIdSetKey } from "@/lib/keys";

const props = defineProps({
    username: String,
    chatId: Number,
    otherUserId: { type: Number, required: true },
});

const onlineUsersId = inject(onlineUsersIdSetKey, ref(new Set<number>()));
const onlineStatus = computed(() => {
    return onlineUsersId.value.has(props.otherUserId) ? "online" : "offline";
});
</script>

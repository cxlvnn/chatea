<template>
    <div
        class="flex h-14 shrink-0 items-center justify-between border-b border-border px-4"
    >
        <div class="flex flex-col">
            <span class="text-xs font-medium text-foreground">{{
                username
            }}</span>
            <span class="text-[10px] text-muted-foreground">online</span>
        </div>
        <Button @click="deleteChat()" variant="outline" size="icon-sm">
            <IconDelete />
        </Button>
    </div>
</template>

<script setup lang="ts">
import { useHttp, usePage } from "@inertiajs/vue3";
import IconDelete from "./IconDelete.vue";
import Button from "./ui/button/Button.vue";

const props = defineProps({
    username: String,
});

const http = useHttp();
const page = usePage();

const deleteChat = () => {
    if (window.confirm("Are you sure you want to delete this chat?")) {
        http.delete(page.url);
    }
};
</script>

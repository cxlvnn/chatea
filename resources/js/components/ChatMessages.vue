<template>
    <div class="flex-1 overflow-y-auto">
        <div class="flex flex-col gap-1 p-4 pt-6">
            <div
                v-for="msg in messages"
                :key="msg.id"
                class="flex flex-col"
                :class="msg.sent ? 'items-end' : 'items-start'"
            >
                <div class="group relative max-w-[75%]">
                    <div
                        class="px-3 py-2 text-xs leading-relaxed"
                        :class="
                            msg.sent
                                ? 'bg-primary text-primary-foreground'
                                : 'bg-muted text-foreground'
                        "
                    >
                        {{ msg.content }}
                    </div>
                    <Link
                        v-if="msg.sent"
                        :href="`${$page.url}/messages/${msg.id}`"
                        method="put"
                        class="absolute -top-2 -right-2 flex size-7 items-center justify-center rounded-full border border-border bg-popover shadow-sm opacity-0 transition-opacity group-hover:opacity-100"
                    >
                        <IconEdit class="size-3.5 text-muted-foreground" />
                    </Link>
                </div>
                <span class="my-2 px-1 text-[11px] text-muted-foreground">{{
                    msg.time
                }}</span>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import IconEdit from "./IconEdit.vue";
const props = defineProps({
    messages: Array,
});
</script>

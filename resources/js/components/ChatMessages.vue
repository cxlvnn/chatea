<template>
    <div class="flex-1 overflow-y-auto">
        <div class="flex flex-col gap-3 p-4">
            <div
                v-for="(msg, i) in messages"
                :key="i"
                class="flex flex-col"
                :class="msg.sent ? 'items-end' : 'items-start'"
            >
                <div
                    class="max-w-[70%] px-3 py-2 text-xs"
                    :class="
                        msg.sent
                            ? 'bg-primary text-primary-foreground'
                            : 'bg-muted text-foreground'
                    "
                >
                    {{ msg.text }}
                </div>
                <span class="mt-1 text-[10px] text-muted-foreground">{{
                    msg.time
                }}</span>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
const messages = [];
</script>

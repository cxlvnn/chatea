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
const messages = [
    {
        text: "hey, are you coming to dinner tonight?",
        sent: false,
        time: "18:42",
    },
    { text: "yeah i'll be there around 7", sent: true, time: "18:43" },
    { text: "ok perfect, i'm making pasta", sent: false, time: "18:43" },
    { text: "nice, should i bring anything?", sent: true, time: "18:44" },
    { text: "just wine if you want", sent: false, time: "18:45" },
    { text: "already on it", sent: true, time: "18:45" },
    { text: "see you soon then", sent: false, time: "18:46" },
    { text: "see you", sent: true, time: "18:46" },
];
</script>

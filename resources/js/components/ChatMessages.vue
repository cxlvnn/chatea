<template>
    <div class="flex-1 overflow-y-auto">
        <div class="flex flex-col gap-3 p-4">
            <div v-for="msg in messages" :key="msg.id" class="flex flex-col">
                <div class="max-w-[70%] px-3 py-2 text-xs">
                    {{ msg.content }}
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
const props = defineProps({
    messages: Array,
});
</script>

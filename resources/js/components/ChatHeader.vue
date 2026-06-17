<template>
    <div
        class="flex h-14 shrink-0 items-center justify-between border-b border-border px-4"
    >
        <span class="text-xs font-medium text-foreground">{{
            person.username
        }}</span>
        <span class="text-[10px] text-muted-foreground">online</span>
    </div>
</template>

<script setup lang="ts">
const person = {
    username: "wife",
};
</script>

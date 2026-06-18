<template>
    <div class="flex h-full w-72 flex-col border-r border-border">
        <div
            class="flex h-14 shrink-0 items-center justify-between border-b border-border px-4"
        >
            <span
                class="text-sm font-bold tracking-widest text-foreground uppercase"
            >
                chatea
            </span>
            <div class="flex flex-row items-center gap-2">
                <Link
                    class="text-[10px] border px-1"
                    href="/logout"
                    method="post"
                >
                    log out
                </Link>

                <ChatAddDialog />
                <ThemeToggle />
                <AppProfileButton />
            </div>
        </div>
        <div class="flex-1 overflow-y-auto">
            <div class="p-2">
                <ChatList />
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import ChatList from "@/components/ChatList.vue";
import ThemeToggle from "@/components/ThemeToggle.vue";
import { Link } from "@inertiajs/vue3";
import ChatAddDialog from "./ChatAddDialog.vue";
import AppProfileButton from "./AppProfileButton.vue";
</script>

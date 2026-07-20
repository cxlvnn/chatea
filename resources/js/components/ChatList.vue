<template>
    <div class="flex w-full flex-col">
        <ItemGroup>
            <template v-for="chat in chats" :key="chat.id">
                <Link :href="`/chats/${chat.id}`">
                    <Item
                        :variant="
                            $page.url === `/chats/${chat.id}`
                                ? 'outline'
                                : 'default'
                        "
                        size="default"
                        class="cursor-pointer py-3"
                        @click="activeIndex = chat.id"
                    >
                        <ItemMedia variant="icon" class="mx-1">
                            <span class="text-xs font-bold uppercase">{{
                                chat.initial
                            }}</span>
                        </ItemMedia>
                        <ItemContent class="gap-0.5">
                            <ItemTitle class="text-foreground">{{
                                chat.username
                            }}</ItemTitle>
                            <ItemDescription
                                v-if="chat.relationships.lastMessage"
                                >{{
                                    chat.relationships.lastMessage
                                }}</ItemDescription
                            >
                        </ItemContent>
                        <ItemActions>
                            <span class="text-[10px] text-muted-foreground">{{
                                chat.relationships.lastMessageAt
                            }}</span>
                        </ItemActions>
                    </Item>
                </Link>
            </template>
        </ItemGroup>
    </div>
</template>

<script setup lang="ts">
import { computed, ref } from "vue";
import {
    Item,
    ItemContent,
    ItemGroup,
    ItemMedia,
    ItemTitle,
    ItemDescription,
    ItemActions,
} from "@/components/ui/item";

import { Link, router, usePage } from "@inertiajs/vue3";
import { useEcho } from "@laravel/echo-vue";

const activeIndex = ref(0);

const page = usePage<{
    chats: {
        data: Array<{
            id: number;
            username: string;
            initial: string;
            isOnline: boolean;
            relationships: {
                lastMessage: string;
                lastMessageAt: string;
            };
        }>;
    };
    auth: { user: { id: number; username: string } };
}>();

const chats = computed(() => page.props.chats.data);

useEcho(`user.${page.props.auth.user.id}`, ".chat.deleted", (e) => {
    const index = page.props.chats.data.findIndex(
        (chat) => chat.id === e.chat.id,
    );

    if (index > -1) {
        page.props.chats.data.splice(index, 1);
        router.get("/chats");
    }
});
</script>

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
                            <!-- <ItemDescription -->
                            <!--     v-if="chat.relationships?.lastMessage" -->
                            <!--     >{{ -->
                            <!--         chat.relationships?.lastMessage -->
                            <!--     }}</ItemDescription -->
                            <!-- > -->
                        </ItemContent>
                        <!-- <ItemActions> -->
                        <!--     <span class="text-[10px] text-muted-foreground">{{ -->
                        <!--         chat.last_message_at -->
                        <!--     }}</span> -->
                        <!-- </ItemActions> -->
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
} from "@/components/ui/item";

import { Link, usePage } from "@inertiajs/vue3";

const activeIndex = ref(0);

const page = usePage<{
    chats: { data: Array<{ id: number; username: string; initial: string }> };
}>();

const chats = computed(() => page.props.chats.data);
</script>

<template>
    <div class="flex w-full flex-col">
        <ItemGroup>
            <template v-for="chat in chats" :key="chats?.id">
                <Item
                    :variant="activeIndex === chat.id ? 'outline' : 'default'"
                    size="default"
                    class="cursor-pointer"
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
                        <ItemDescription>{{
                            chat.lastMessage
                        }}</ItemDescription>
                    </ItemContent>
                    <ItemActions>
                        <span class="text-[10px] text-muted-foreground">{{
                            chat.last_message_at
                        }}</span>
                    </ItemActions>
                </Item>
            </template>
        </ItemGroup>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import {
    Item,
    ItemActions,
    ItemContent,
    ItemDescription,
    ItemGroup,
    ItemMedia,
    ItemTitle,
} from "@/components/ui/item";

const activeIndex = ref(0);

defineProps({
    chats: Object,
});
</script>

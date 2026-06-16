<template>
    <div class="flex w-full flex-col">
        <ItemGroup>
            <template v-for="(person, index) in people" :key="person.username">
                <Item
                    :variant="activeIndex === index ? 'outline' : 'default'"
                    size="default"
                    class="cursor-pointer"
                    @click="activeIndex = index"
                >
                    <ItemMedia variant="icon" class="mx-1">
                        <span class="text-xs font-bold uppercase">{{
                            person.initial
                        }}</span>
                    </ItemMedia>
                    <ItemContent class="gap-0.5">
                        <ItemTitle class="text-foreground">{{
                            person.username
                        }}</ItemTitle>
                        <ItemDescription>{{
                            person.lastMessage
                        }}</ItemDescription>
                    </ItemContent>
                    <ItemActions>
                        <span class="text-[10px] text-muted-foreground">{{
                            person.time
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

const people = [
    {
        username: "wife",
        initial: "w",
        lastMessage: "see you",
        time: "18:46",
    },
    {
        username: "brother",
        initial: "b",
        lastMessage: "check out this link",
        time: "16:20",
    },
    {
        username: "mom",
        initial: "m",
        lastMessage: "call me when you're free",
        time: "14:05",
    },
];
</script>

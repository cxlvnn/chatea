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
                        v-if="editingId != msg.id"
                        class="px-3 py-2 text-xs leading-relaxed"
                        :class="
                            msg.sent
                                ? 'bg-primary text-primary-foreground'
                                : 'bg-muted text-foreground'
                        "
                    >
                        {{ msg.content }}
                    </div>
                    <div v-else>
                        <Form
                            :action="`/messages/${msg.id}`"
                            method="patch"
                            disable-while-processing
                            @success="editingId = 0"
                        >
                            <Input
                                class="mb-2"
                                type="text"
                                :defaultValue="msg.content"
                                name="content"
                                @keydown.escape="editingId = 0"
                                autofocus
                            />
                            <div class="flex gap-1">
                                <Button type="submit" size="sm">Save</Button>
                                <Button
                                    type="button"
                                    variant="ghost"
                                    size="sm"
                                    @click="editingId = 0"
                                >
                                    Cancel
                                </Button>
                            </div>
                        </Form>
                    </div>
                    <div
                        v-if="editingId != msg.id && msg.sent"
                        class="absolute -top-6 right-0 flex gap-1 opacity-0 transition-opacity group-hover:opacity-100"
                    >
                        <Button
                            @click="editingId = msg.id"
                            size="icon-xs"
                            variant="outline"
                        >
                            <IconEdit />
                        </Button>
                        <Button
                            @click="sendDelete(msg.id)"
                            size="icon-xs"
                            variant="outline"
                        >
                            <IconDelete />
                        </Button>
                    </div>
                </div>
                <span class="my-2 px-1 text-[11px] text-muted-foreground">{{
                    msg.time
                }}</span>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Form, useHttp } from "@inertiajs/vue3";
import IconEdit from "./IconEdit.vue";
import Button from "./ui/button/Button.vue";
import { ref } from "vue";
import Input from "./ui/input/Input.vue";
import IconDelete from "./IconDelete.vue";

defineProps<{
    messages: {
        id: number;
        content: string;
        time: string;
        sent: boolean;
    }[];
}>();

const http = useHttp();

const sendDelete = (msgId: number) => {
    if (window.confirm("Are you sure you want to delete this message")) {
        http.delete(`/messages/${msgId}`);
    }
};

const editingId = ref(0);
</script>

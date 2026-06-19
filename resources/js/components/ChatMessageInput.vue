<template>
    <form @submit.prevent="sendForm()">
        <div class="flex flex-col gap-1 border-t border-border p-3">
            <div
                v-if="form.errors.content"
                class="text-xs text-destructive px-1"
            >
                {{ form.errors.content }}
            </div>
            <div class="flex items-center gap-2">
                <Input
                    v-model="form.content"
                    placeholder="type a message..."
                    class="min-h-10 flex-1 resize-none"
                />
                <Button
                    :disabled="form.processing || !form.content?.trim()"
                    variant="default"
                    size="default"
                >
                    send
                </Button>
            </div>
        </div>
    </form>
</template>

<script setup lang="ts">
import { Button } from "@/components/ui/button";
import { useForm, usePage } from "@inertiajs/vue3";
import Input from "./ui/input/Input.vue";

const page = usePage();

const form = useForm({
    content: "",
});

const sendForm = () => {
    form.post(`${page.url}/messages`);
    form.reset();
};
</script>

<template>
    <div class="flex items-end gap-2 border-t border-border p-3">
        <Textarea
            v-model="message"
            placeholder="type a message..."
            class="min-h-10 flex-1 resize-none"
            :rows="1"
        />
        <Button variant="default" size="sm" @click="send">
            send
        </Button>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { Textarea } from "@/components/ui/textarea";
import { Button } from "@/components/ui/button";

const message = ref("");

function send() {
    message.value = "";
}
</script>

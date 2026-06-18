<script setup lang="ts">
import { ref } from "vue";
import { Button } from "@/components/ui/button";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog";
import {
    Field,
    FieldDescription,
    FieldError,
    FieldGroup,
    FieldLabel,
} from "@/components/ui/field";
import { Input } from "@/components/ui/input";
import IconPlus from "./IconPlus.vue";
import { Form } from "@inertiajs/vue3";
</script>

<template>
    <Dialog>
        <DialogTrigger as-child>
            <Button variant="outline" size="icon-xs">
                <IconPlus />
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-106.25">
            <DialogHeader>
                <DialogTitle>Add a new chat</DialogTitle>
                <DialogDescription>
                    Search for people and start texting with them from here
                </DialogDescription>
            </DialogHeader>

            <Form
                action="/chats/create"
                method="post"
                v-slot="{ errors, processing }"
            >
                <FieldGroup>
                    <Field>
                        <FieldLabel for="username"> Username </FieldLabel>
                        <Input
                            id="username"
                            name="username"
                            type="text"
                            placeholder="johndoe"
                        />
                        <FieldError v-if="errors.username">
                            {{ errors.username }}
                        </FieldError>
                        <FieldDescription>
                            Type the username of a friend.
                        </FieldDescription>
                    </Field>
                </FieldGroup>

                <DialogFooter>
                    <Button :disabled="processing" type="submit">
                        Start chatting
                    </Button>
                </DialogFooter>
            </Form>
        </DialogContent>
    </Dialog>
</template>

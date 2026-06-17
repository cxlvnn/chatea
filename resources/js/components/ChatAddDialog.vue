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
    FieldGroup,
    FieldLabel,
} from "@/components/ui/field";
import { Input } from "@/components/ui/input";
import IconPlus from "./IconPlus.vue";
import { Form } from "@inertiajs/vue3";

const username = ref("");
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

            <Form>
                <FieldGroup>
                    <Field>
                        <FieldLabel for="username"> Username </FieldLabel>
                        <Input
                            id="username"
                            v-model="username"
                            type="text"
                            placeholder="johndoe"
                        />
                        <FieldDescription>
                            Type the username of a friend.
                        </FieldDescription>
                    </Field>
                </FieldGroup>
            </Form>

            <DialogFooter>
                <Button type="submit"> Start chatting </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
</template>

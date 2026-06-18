<template>
    <div class="w-full max-w-md">
        <div class="my-3 bg-secondary/50 w-fit p-1 border border-boder">
            <Link href="/chats">
                <HugeiconsIcon :icon="ArrowLeft02Icon" />
            </Link>
        </div>
        <div class="border border-border bg-secondary/50 p-10">
            <FieldLegend class="text-center mb-6">
                <h1 class="text-xl">Hello, {{ user?.username }}</h1>
            </FieldLegend>

            <Form
                action="/profile"
                method="put"
                #default="{ errors, processing }"
                resetOnSuccess
            >
                <FieldSet>
                    <Field>
                        <FieldLabel for="username"> Username </FieldLabel>
                        <Input
                            id="username"
                            type="text"
                            name="username"
                            placeholder="johndoe"
                        />
                        <FieldError v-if="errors.username">{{
                            errors.username
                        }}</FieldError>
                        <FieldDescription>
                            Update your username
                        </FieldDescription>
                    </Field>
                    <Field class="flex justify-end" orientation="horizontal">
                        <Button :disabled="processing"> Update </Button>
                    </Field>
                </FieldSet>
            </Form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Button } from "@/components/ui/button";
import {
    Field,
    FieldDescription,
    FieldError,
    FieldLabel,
    FieldLegend,
    FieldSet,
} from "@/components/ui/field";
import { Input } from "@/components/ui/input";
import ProfileLayout from "@/layouts/ProfileLayout.vue";
import { ArrowLeft02Icon } from "@hugeicons/core-free-icons";
import { HugeiconsIcon } from "@hugeicons/vue";
import { Form, Link } from "@inertiajs/vue3";

defineOptions({
    layout: ProfileLayout,
});

defineProps({
    user: Object,
});
</script>

<template>
    <div
        class="w-full max-w-md border border-border bg-secondary/50 py-5 px-10"
    >
        <FieldLegend class="text-center mb-6">
            <h1 class="text-xl">Hello, {{ user?.username }}</h1>
        </FieldLegend>

        <Form>
            <FieldSet>
                <Field>
                    <FieldLabel for="username"> Username </FieldLabel>
                    <Input
                        id="username"
                        type="text"
                        name="username"
                        placeholder="johndoe"
                    />
                    <FieldDescription> Update your username </FieldDescription>
                </Field>
                <Field class="flex justify-end" orientation="horizontal">
                    <Button> Update </Button>
                </Field>
            </FieldSet>
        </Form>
    </div>
</template>

<script setup lang="ts">
import { Button } from "@/components/ui/button";
import {
    Field,
    FieldDescription,
    FieldLabel,
    FieldLegend,
    FieldSet,
} from "@/components/ui/field";
import { Input } from "@/components/ui/input";
import ProfileLayout from "@/layouts/ProfileLayout.vue";
import { Form } from "@inertiajs/vue3";

defineOptions({
    layout: ProfileLayout,
});

defineProps({
    user: Object,
});
</script>

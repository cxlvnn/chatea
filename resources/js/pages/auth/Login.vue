<script setup lang="ts">
import Button from "@/components/ui/button/Button.vue";
import {
    Field,
    FieldError,
    FieldGroup,
    FieldLabel,
    FieldSet,
} from "@/components/ui/field";
import { Input } from "@/components/ui/input";
import AuthLayout from "@/layouts/AuthLayout.vue";
import { Form, Link } from "@inertiajs/vue3";

defineOptions({
    layout: AuthLayout,
});
</script>

<template>
    <div class="w-full bg-primary-foreground p-10 max-w-md">
        <Form action="/login" method="post" v-slot="{ errors, processing }">
            <FieldSet>
                <FieldGroup>
                    <Field>
                        <FieldLabel data-invalid for="username">
                            Username
                        </FieldLabel>
                        <Input
                            id="username"
                            name="username"
                            type="text"
                            placeholder="johndoe"
                        />
                    </Field>

                    <Field>
                        <FieldLabel for="password"> Password </FieldLabel>
                        <Input
                            id="password"
                            name="password"
                            type="password"
                            placeholder="********"
                        />
                        <FieldError v-if="errors.username">{{
                            errors.username
                        }}</FieldError>
                    </Field>

                    <Field>
                        <Button
                            variant="default"
                            :disabled="processing"
                            type="submit"
                        >
                            Login
                        </Button>
                    </Field>

                    <div class="text-xs">
                        <p>
                            Don't have an account?
                            <Link class="font-medium underline" href="/register"
                                >Sign up</Link
                            >
                        </p>
                    </div>
                </FieldGroup>
            </FieldSet>
        </Form>
    </div>
</template>

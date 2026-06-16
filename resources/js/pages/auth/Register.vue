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
        <Form action="/register" method="post" v-slot="{ errors, processing }">
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
                        <FieldError v-if="errors.username">{{
                            errors.username
                        }}</FieldError>
                    </Field>

                    <Field>
                        <FieldLabel for="password"> Password </FieldLabel>
                        <Input
                            id="password"
                            name="password"
                            type="password"
                            placeholder="********"
                        />
                    </Field>

                    <Field>
                        <FieldLabel for="password_confirmation">
                            Confirm password
                        </FieldLabel>
                        <Input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            placeholder="********"
                        />
                        <FieldError v-if="errors.password">{{
                            errors.password
                        }}</FieldError>
                    </Field>

                    <Field>
                        <Button
                            :disabled="processing"
                            variant="default"
                            type="submit"
                        >
                            Register
                        </Button>
                    </Field>

                    <div class="text-xs">
                        <p>
                            Have an account?
                            <Link class="font-medium underline" href="/login"
                                >Sign in</Link
                            >
                        </p>
                    </div>
                </FieldGroup>
            </FieldSet>
        </Form>
    </div>
</template>

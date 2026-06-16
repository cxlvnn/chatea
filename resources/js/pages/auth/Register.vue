<script setup lang="ts">
import Button from "@/components/ui/button/Button.vue";
import {
    Field,
    FieldDescription,
    FieldGroup,
    FieldLabel,
    FieldSet,
} from "@/components/ui/field";
import { Input } from "@/components/ui/input";
import AuthLayout from "@/layouts/AuthLayout.vue";
import { Form } from "@inertiajs/vue3";

defineOptions({
    layout: AuthLayout,
});
</script>

<template>
    <div class="w-full max-w-md">
        <Form action="/register" method="post">
            <FieldSet>
                <FieldGroup>
                    <Field>
                        <FieldLabel for="username"> Username </FieldLabel>
                        <Input
                            id="username"
                            name="username"
                            type="text"
                            placeholder="johndoe"
                        />
                        <FieldDescription>
                            Choose a unique username for your account.
                        </FieldDescription>
                    </Field>

                    <Field>
                        <FieldLabel for="password"> Password </FieldLabel>
                        <FieldDescription>
                            Must be at least 8 characters long.
                        </FieldDescription>
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
                        <FieldDescription>
                            Enter your password again.
                        </FieldDescription>
                        <Input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            placeholder="********"
                        />
                    </Field>

                    <Field>
                        <Button variant="default" type="submit">
                            Register
                        </Button>
                    </Field>
                </FieldGroup>
            </FieldSet>
        </Form>
    </div>
</template>

<template>
    <Link href="/profile">
        <Button variant="outline" size="icon-xs">
            <IconProfile />
        </Button>
    </Link>
</template>

<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import IconProfile from "./IconProfile.vue";
import Button from "./ui/button/Button.vue";
</script>

<template>
    <Button variant="outline" size="icon-xs" @click="toggle">
        <HugeiconsIcon
            :icon="isDark ? Moon01Icon : Sun01Icon"
            :size="16"
            :stroke-width="1.5"
        />
    </Button>
</template>

<script setup lang="ts">
import { ref, onMounted } from "vue";
import { useLocalStorage } from "@vueuse/core";
import { Moon01Icon, Sun01Icon } from "@hugeicons/core-free-icons";
import { HugeiconsIcon } from "@hugeicons/vue";
import { Button } from "@/components/ui/button";

const theme = useLocalStorage<string | null>("theme", null);
const isDark = ref(false);

function apply(dark: boolean) {
    isDark.value = dark;
    document.documentElement.classList.toggle("dark", dark);
}

function toggle() {
    apply(!isDark.value);
    theme.value = isDark.value ? "dark" : "light";
}

onMounted(() => {
    const saved = theme.value;
    if (saved === "dark") {
        apply(true);
    } else if (saved === "light") {
        apply(false);
    } else {
        apply(window.matchMedia("(prefers-color-scheme: dark)").matches);
    }
    theme.value = isDark.value ? "dark" : "light";
});
</script>

<template>
    <div class="text-center w-fit my-5 mx-auto">
        <h1>{{ count }}</h1>
        <button
            class="bg-gray-300 py-2 px-4 rounded my-2"
            @click="updateCounter()"
        >
            Click me
        </button>
        <button
            class="bg-red-300 py-2 px-4 rounded my-2"
            @click="decreaseCounter()"
        >
            Click me
        </button>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";

const count = ref(1);

const updateCounter = () => {
    count.value++;
};

const decreaseCounter = () => {
    count.value--;
};
</script>

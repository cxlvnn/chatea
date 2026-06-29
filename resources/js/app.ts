import { createInertiaApp } from "@inertiajs/vue3";
import { configureEcho } from '@laravel/echo-vue';

configureEcho({
    broadcaster: 'reverb',
});

createInertiaApp();

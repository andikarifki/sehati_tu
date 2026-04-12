<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"
    >
        <div>
            <Link
                href="/"
                class="flex flex-col items-center justify-center gap-2"
            >
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />

                <div class="text-center">
                    <h1
                        class="text-4xl font-extrabold text-blue-900 tracking-tight"
                    >
                        SEHATI-TU
                    </h1>
                    <p
                        class="text-sm font-semibold text-gray-700 uppercase tracking-wider mt-1"
                    >
                        Sistem Informasi Bapelkum Semarang
                    </p>
                </div>
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>

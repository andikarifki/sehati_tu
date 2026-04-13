<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-gray-50 to-gray-200"
    >
        <div class="mb-2">
            <Link
                href="/"
                class="flex flex-col items-center justify-center transition-transform duration-300 hover:scale-105"
            >
                <div class="p-4 bg-white rounded-full shadow-sm mb-4">
                    <ApplicationLogo
                        class="w-16 h-16 fill-current text-blue-600"
                    />
                </div>

                <div class="text-center">
                    <h1
                        class="text-5xl font-black tracking-tighter text-blue-950"
                    >
                        SEHATI<span class="text-blue-600">-</span>TU
                    </h1>

                    <div class="mt-2 flex flex-col items-center">
                        <span
                            class="text-xs font-bold text-blue-800 uppercase tracking-[0.2em] leading-relaxed"
                        >
                            Sistem Informasi Tata Usaha
                        </span>

                        <div
                            class="mt-3 inline-flex items-center px-3 py-1 bg-blue-900 rounded-md"
                        >
                            <p
                                class="text-[10px] font-black text-white uppercase tracking-widest"
                            >
                                Bapelkum Semarang
                            </p>
                        </div>
                    </div>
                </div>
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-8 px-8 py-10 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 overflow-hidden sm:rounded-2xl"
        >
            <slot />
        </div>

        <p class="mt-8 text-center text-xs text-gray-400 font-medium">
            &copy; 2026 Bapelkum Semarang. All rights reserved.
        </p>
    </div>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

// Ambil props totalPegawai dari Controller
defineProps({
    totalPegawai: Number,
});
</script>

<template>
    <Head title="Dashboard SEHATI-TU" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div
                        class="overflow-hidden bg-white shadow-sm sm:rounded-xl border-l-4 border-blue-600"
                    >
                        <div class="p-6">
                            <div class="flex items-center">
                                <div class="p-3 bg-blue-100 rounded-lg">
                                    <svg
                                        class="w-8 h-8 text-blue-600"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                        />
                                    </svg>
                                </div>
                                <div class="ml-5">
                                    <p
                                        class="text-sm font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Total Data Pegawai
                                    </p>
                                    <h3
                                        class="text-3xl font-bold text-gray-900"
                                    >
                                        {{ totalPegawai }}
                                    </h3>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a
                                    :href="route('pegawai.index')"
                                    class="text-sm font-semibold text-blue-600 hover:text-blue-800"
                                >
                                    Lihat detail →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="mt-8 overflow-hidden bg-white shadow-sm sm:rounded-xl border border-gray-100"
                >
                    <div class="p-8 text-gray-900">
                        <h4 class="text-lg font-bold">
                            Selamat Datang di SEHATI-TU!
                        </h4>
                        <p class="text-gray-500 mt-1">
                            Anda masuk sebagai sistem administrator Bapelkum
                            Semarang.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

// Tambahkan totalArsip di props
defineProps({
    totalPegawai: Number,
    totalArsip: Number, // Tambahkan ini
});
</script>

<template>
    <Head title="Dashboard SEHATI-TU" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-bold leading-tight text-gray-800">
                Dashboard Overview
            </h2>
        </template>

        <div class="py-10">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="relative overflow-hidden bg-white shadow-md sm:rounded-2xl border border-gray-100 mb-8"
                >
                    <div
                        class="absolute top-0 right-0 -mt-4 -mr-4 h-32 w-32 rounded-full bg-blue-50 opacity-50"
                    ></div>
                    <div
                        class="relative p-8 flex flex-col md:flex-row md:items-center md:justify-between"
                    >
                        <div>
                            <h4
                                class="text-2xl font-extrabold text-gray-900 tracking-tight"
                            >
                                Selamat Datang di
                                <span class="text-blue-600">SEHATI-TU</span>!
                            </h4>
                            <p class="text-gray-500 mt-2 max-w-2xl text-lg">
                                Halo, Anda masuk sebagai
                                <span class="font-semibold text-gray-700"
                                    >Sistem Administrator</span
                                >
                                Bapelkum Semarang.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div
                        class="group overflow-hidden bg-white shadow-sm hover:shadow-xl transition-all duration-300 sm:rounded-2xl border border-gray-100"
                    >
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p
                                        class="text-sm font-bold text-gray-400 uppercase tracking-widest"
                                    >
                                        Total Pegawai
                                    </p>
                                    <h3
                                        class="mt-1 text-4xl font-black text-gray-900 leading-none"
                                    >
                                        {{ totalPegawai }}
                                    </h3>
                                </div>
                                <div
                                    class="p-4 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl shadow-lg shadow-blue-200 group-hover:scale-110 transition-transform"
                                >
                                    <svg
                                        class="w-8 h-8 text-white"
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
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-50">
                                <Link
                                    :href="route('pegawai.index')"
                                    class="flex items-center text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors"
                                >
                                    Kelola Data Pegawai
                                    <svg
                                        class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"
                                        />
                                    </svg>
                                </Link>
                            </div>
                        </div>
                    </div>

                    <div
                        class="group overflow-hidden bg-white shadow-sm hover:shadow-xl transition-all duration-300 sm:rounded-2xl border border-gray-100"
                    >
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p
                                        class="text-sm font-bold text-gray-400 uppercase tracking-widest"
                                    >
                                        Total Arsip
                                    </p>
                                    <h3
                                        class="mt-1 text-4xl font-black text-gray-900 leading-none"
                                    >
                                        {{ totalArsip }}
                                    </h3>
                                </div>
                                <div
                                    class="p-4 bg-gradient-to-br from-amber-400 to-amber-600 rounded-2xl shadow-lg shadow-amber-200 group-hover:scale-110 transition-transform"
                                >
                                    <svg
                                        class="w-8 h-8 text-white"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                        />
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-50">
                                <Link
                                    :href="route('arsip.index')"
                                    class="flex items-center text-sm font-bold text-amber-600 hover:text-amber-800 transition-colors"
                                >
                                    Buka Arsip Digital
                                    <svg
                                        class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"
                                        />
                                    </svg>
                                </Link>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex items-center justify-center p-6 text-center"
                    >
                        <span class="text-gray-400 text-sm font-medium italic"
                            >Statistik penunjang lainnya akan muncul di
                            sini...</span
                        >
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

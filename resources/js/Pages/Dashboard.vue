<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3"; // Menggunakan Link untuk navigasi SPA yang lebih mulus

// Ambil props totalPegawai dari Controller
defineProps({
    totalPegawai: Number,
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
                                Bapelkum Semarang. Kelola data pegawai Anda
                                dengan efisien di sini.
                            </p>
                        </div>
                        <div class="mt-6 md:mt-0">
                            <div
                                class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-full text-sm font-medium border border-blue-100"
                            >
                                <span class="relative flex h-3 w-3 mr-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"
                                    ></span>
                                    <span
                                        class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"
                                    ></span>
                                </span>
                                Sistem Aktif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div
                        class="group overflow-hidden bg-white shadow-sm hover:shadow-xl transition-shadow duration-300 sm:rounded-2xl border border-gray-100"
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
                                    <p
                                        class="text-xs text-gray-400 mt-2 italic"
                                    >
                                        *Data tersinkronisasi
                                    </p>
                                </div>
                                <div
                                    class="p-4 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl shadow-lg shadow-blue-200 group-hover:scale-110 transition-transform duration-300"
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
                                    Lihat Detail Pegawai
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
                        class="hidden md:block bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl flex items-center justify-center p-6"
                    >
                        <span class="text-gray-400 text-sm font-medium italic"
                            >Statistik lainnya akan muncul di sini...</span
                        >
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

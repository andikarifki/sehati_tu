<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

defineProps({
    arsip: Array, // Menerima data dari ArsipController
});
</script>

<template>
    <Head title="Arsip Dokumen" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Arsip Dokumen Digital
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4"
                >
                    <div class="relative w-full md:w-96">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-3"
                        >
                            <svg
                                class="w-5 h-5 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                        </span>
                        <input
                            type="text"
                            placeholder="Cari dokumen atau pihak terkait..."
                            class="block w-full pl-10 pr-3 py-2.5 border-none rounded-xl bg-white shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-500 transition-all text-sm"
                        />
                    </div>

                    <Link
                        :href="route('arsip.create')"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-sm font-black transition-all shadow-lg shadow-blue-200 active:scale-95 flex items-center gap-2 uppercase tracking-widest w-full md:w-auto justify-center"
                    >
                        <span>+</span> Upload Dokumen
                    </Link>
                </div>

                <div
                    class="bg-white shadow-2xl shadow-gray-200/50 sm:rounded-3xl overflow-hidden border border-gray-100"
                >
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left border-collapse">
                            <thead
                                class="bg-gray-50/50 text-gray-500 uppercase font-black text-[10px] tracking-[0.15em]"
                            >
                                <tr>
                                    <th class="p-5 border-b text-center w-16">
                                        No
                                    </th>
                                    <th class="p-5 border-b">Nama Dokumen</th>
                                    <th class="p-5 border-b">Asal Surat</th>
                                    <th class="p-5 border-b text-center">
                                        Kategori
                                    </th>
                                    <th class="p-5 border-b text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                class="divide-y divide-gray-100 text-gray-600"
                            >
                                <tr
                                    v-for="(a, index) in arsip"
                                    :key="a.id"
                                    class="hover:bg-blue-50/30 transition-colors"
                                >
                                    <td
                                        class="p-5 text-center text-gray-300 font-bold"
                                    >
                                        {{ index + 1 }}
                                    </td>
                                    <td class="p-5">
                                        <div>
                                            <div
                                                class="font-bold text-gray-900"
                                            >
                                                {{ a.judul }}
                                            </div>
                                            <div
                                                class="text-xs text-gray-500 font-mono tracking-tight italic"
                                            >
                                                {{ a.nomor_surat }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-5 font-semibold text-gray-700">
                                        {{ a.pihak_terkait }}
                                    </td>
                                    <td class="p-5 text-center">
                                        <span
                                            class="px-3 py-1 bg-gray-100 rounded-full text-[9px] font-black uppercase tracking-widest text-gray-500 border border-gray-200"
                                        >
                                            {{ a.kategori }}
                                        </span>
                                    </td>
                                    <td class="p-5 text-center">
                                        <div
                                            class="flex items-center justify-center gap-2"
                                        >
                                            <a
                                                :href="a.file_url"
                                                target="_blank"
                                                class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all shadow-sm"
                                            >
                                                <svg
                                                    class="w-4 h-4"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                    />
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                    />
                                                </svg>
                                            </a>
                                            <button
                                                @click="hapusArsip(a.id)"
                                                class="p-2 bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-all shadow-sm"
                                            >
                                                <svg
                                                    class="w-4 h-4"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                    />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr v-if="arsip.length === 0">
                                    <td
                                        colspan="5"
                                        class="p-20 text-center opacity-30"
                                    >
                                        <p
                                            class="font-black uppercase tracking-[0.3em]"
                                        >
                                            Arsip Kosong
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

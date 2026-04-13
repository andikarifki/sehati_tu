<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";

// Hanya menerima data pegawai dari Controller
defineProps({ pegawai: Array });

// Fungsi Hapus Data
const hapusPegawai = (id) => {
    if (confirm("Apakah Anda yakin ingin menghapus data pegawai ini?")) {
        router.delete(route("pegawai.destroy", id));
    }
};
</script>

<template>
    <Head title="Data Pegawai" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Daftar Pegawai
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mb-4 px-4 sm:px-0">
                    <Link
                        :href="route('pegawai.create')"
                        class="inline-flex items-center px-5 py-2.5 bg-blue-600 border border-transparent rounded-xl font-black text-sm text-white uppercase tracking-widest hover:bg-blue-700 transition duration-150 shadow-lg shadow-blue-200"
                    >
                        + Tambah Pegawai
                    </Link>
                </div>

                <div
                    class="bg-white shadow-xl sm:rounded-xl border border-gray-100"
                >
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table
                                class="w-full text-sm text-left border-collapse min-w-[800px]"
                            >
                                <thead
                                    class="bg-gray-50 text-gray-700 uppercase font-bold text-xs tracking-wider"
                                >
                                    <tr>
                                        <th
                                            class="p-4 border-b text-center w-16"
                                        >
                                            No
                                        </th>
                                        <th class="p-4 border-b text-center">
                                            NIP
                                        </th>
                                        <th class="p-4 border-b">
                                            Nama Pegawai
                                        </th>
                                        <th class="p-4 border-b text-center">
                                            Pangkat/Gol
                                        </th>
                                        <th class="p-4 border-b">Jabatan</th>
                                        <th class="p-4 border-b text-center">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="divide-y divide-gray-200 text-gray-600"
                                >
                                    <tr
                                        v-for="(p, index) in pegawai"
                                        :key="p.id"
                                        class="hover:bg-blue-50/50 transition-colors"
                                    >
                                        <td
                                            class="p-4 text-center text-gray-400"
                                        >
                                            {{ index + 1 }}
                                        </td>
                                        <td
                                            class="p-4 font-mono font-bold text-blue-700 text-sm text-center"
                                        >
                                            {{ p.nip }}
                                        </td>
                                        <td
                                            class="p-4 font-semibold text-gray-900 capitalize"
                                        >
                                            {{ p.nama }}
                                        </td>
                                        <td class="p-4 text-center">
                                            {{ p.pangkat }}
                                            <span class="text-gray-400 text-xs"
                                                >({{ p.golongan }})</span
                                            >
                                        </td>
                                        <td
                                            class="p-4 text-xs font-medium uppercase tracking-tight"
                                        >
                                            {{ p.jabatan }}
                                        </td>
                                        <td class="p-4 text-center">
                                            <div
                                                class="flex justify-center space-x-3"
                                            >
                                                <div
                                                    class="flex justify-center items-center space-x-3"
                                                >
                                                    <div
                                                        class="flex justify-center items-center space-x-3"
                                                    >
                                                        <Link
                                                            :href="
                                                                route(
                                                                    'pegawai.edit',
                                                                    p.id,
                                                                )
                                                            "
                                                            class="p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-200 shadow-sm"
                                                            title="Edit Data"
                                                        >
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                class="h-5 w-5"
                                                                fill="none"
                                                                viewBox="0 0 24 24"
                                                                stroke="currentColor"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                                                />
                                                            </svg>
                                                        </Link>

                                                        <button
                                                            @click="
                                                                hapusPegawai(
                                                                    p.id,
                                                                )
                                                            "
                                                            class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-600 hover:text-white transition-all duration-200 shadow-sm"
                                                            title="Hapus Data"
                                                        >
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                class="h-5 w-5"
                                                                fill="none"
                                                                viewBox="0 0 24 24"
                                                                stroke="currentColor"
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
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="pegawai.length === 0">
                                        <td
                                            colspan="6"
                                            class="p-10 text-center text-gray-400 italic"
                                        >
                                            Belum ada data pegawai yang
                                            tersedia.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

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
                <div class="flex justify-end mb-4">
                    <Link
                        :href="route('pegawai.create')"
                        class="inline-flex items-center px-5 py-2.5 bg-blue-600 border border-transparent rounded-xl font-black text-sm text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-blue-200"
                    >
                        + Tambah Pegawai
                    </Link>
                </div>

                <div
                    class="bg-white shadow-xl sm:rounded-xl overflow-hidden border border-gray-100"
                >
                    <div class="p-6">
                        <table class="w-full text-sm text-left border-collapse">
                            <thead
                                class="bg-gray-50 text-gray-700 uppercase font-bold text-xs tracking-wider"
                            >
                                <tr>
                                    <th class="p-4 border-b text-center w-16">
                                        No
                                    </th>
                                    <th class="p-4 border-b text-center">
                                        NIP
                                    </th>
                                    <th class="p-4 border-b">Nama Pegawai</th>
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
                                    <td class="p-4 text-center text-gray-400">
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
                                        <Link
                                            :href="route('pegawai.edit', p.id)"
                                            class="text-blue-600 hover:underline mr-4 font-bold"
                                        >
                                            Edit
                                        </Link>
                                        <button
                                            @click="hapusPegawai(p.id)"
                                            class="text-red-500 hover:text-red-700 font-bold transition hover:underline"
                                        >
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="pegawai.length === 0">
                                    <td
                                        colspan="6"
                                        class="p-10 text-center text-gray-400 italic"
                                    >
                                        Belum ada data pegawai yang tersedia.
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

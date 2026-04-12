<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";

// Hanya menerima data pegawai dari Controller
defineProps({ pegawai: Array });

// Logika Hapus tetap dipertahankan
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Daftar Pegawai
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                    <div class="p-6">
                        <table class="w-full text-sm text-left border-collapse">
                            <thead
                                class="bg-gray-50 text-gray-700 uppercase font-semibold"
                            >
                                <tr>
                                    <th class="p-4 border-b">NIP</th>
                                    <th class="p-4 border-b">Nama</th>
                                    <th class="p-4 border-b">Pangkat</th>
                                    <th class="p-4 border-b">Gol</th>
                                    <th class="p-4 border-b">Jabatan</th>
                                    <th class="p-4 border-b text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr
                                    v-for="p in pegawai"
                                    :key="p.id"
                                    class="hover:bg-gray-50 transition-colors"
                                >
                                    <td class="p-4 font-mono">{{ p.nip }}</td>
                                    <td class="p-4 font-medium text-gray-900">
                                        {{ p.nama }}
                                    </td>
                                    <td class="p-4">{{ p.pangkat }}</td>
                                    <td class="p-4">{{ p.golongan }}</td>
                                    <td class="p-4">{{ p.jabatan }}</td>
                                    <td class="p-4 text-center">
                                        <button
                                            @click="hapusPegawai(p.id)"
                                            class="text-red-600 hover:text-red-800 font-semibold underline decoration-dotted"
                                        >
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="pegawai.length === 0">
                                    <td
                                        colspan="6"
                                        class="p-8 text-center text-gray-500 italic"
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

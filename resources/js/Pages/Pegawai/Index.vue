<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";

const props = defineProps({
    pegawai: Array,
    filters: Object, // Pastikan Controller mengirim ini
});

// State search dengan pengaman jika props.filters null
const search = ref(props.filters?.search || "");

// Watcher untuk pencarian otomatis
watch(
    search,
    debounce((value) => {
        router.get(
            route("pegawai.index"),
            { search: value },
            {
                preserveState: true,
                replace: true,
            },
        );
    }, 300),
);

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
                <div
                    class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 px-4 sm:px-0"
                >
                    <div class="relative w-full md:w-80">
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
                            v-model="search"
                            type="text"
                            placeholder="Cari NIP atau Nama..."
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-sm shadow-sm transition-all duration-200"
                        />
                    </div>

                    <Link
                        :href="route('pegawai.create')"
                        class="w-full md:w-auto text-center inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-blue-700 transition duration-150 shadow-lg shadow-blue-200 active:transform active:scale-95"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-2"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 4v16m8-8H4"
                            />
                        </svg>
                        Tambah Pegawai
                    </Link>
                </div>

                <div
                    class="bg-white shadow-xl sm:rounded-2xl border border-gray-100 overflow-hidden"
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
                                    class="divide-y divide-gray-200 text-gray-600 font-medium"
                                >
                                    <tr
                                        v-for="(p, index) in pegawai"
                                        :key="p.id"
                                        class="hover:bg-blue-50/50 transition-colors"
                                    >
                                        <td
                                            class="p-4 text-center text-gray-400 font-medium italic"
                                        >
                                            {{ index + 1 }}
                                        </td>
                                        <td
                                            class="p-4 font-mono font-bold text-blue-700 text-sm text-center"
                                        >
                                            {{ p.nip }}
                                        </td>
                                        <td
                                            class="p-4 font-bold text-gray-900 capitalize"
                                        >
                                            {{ p.nama }}
                                        </td>
                                        <td class="p-4 text-center">
                                            {{ p.pangkat }}
                                            <span
                                                class="text-gray-400 text-xs font-normal"
                                                >({{ p.golongan }})</span
                                            >
                                        </td>
                                        <td
                                            class="p-4 text-xs font-semibold uppercase tracking-tight text-gray-500"
                                        >
                                            {{ p.jabatan }}
                                        </td>
                                        <td class="p-4 text-center">
                                            <div
                                                class="flex justify-center items-center space-x-2"
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
                                                    @click="hapusPegawai(p.id)"
                                                    class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-500 hover:text-white transition-all duration-200 shadow-sm"
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
                                        </td>
                                    </tr>
                                    <tr v-if="pegawai.length === 0">
                                        <td
                                            colspan="6"
                                            class="p-16 text-center text-gray-400 italic"
                                        >
                                            Data tidak ditemukan.
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

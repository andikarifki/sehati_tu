<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";

const props = defineProps({
    pegawai: Array,
    filters: Object,
});

const search = ref(props.filters?.search || "");

watch(
    search,
    debounce((value) => {
        router.get(
            route("pegawai.index"),
            { search: value },
            { preserveState: true, replace: true },
        );
    }, 300),
);

const cetakPdf = () => {
    window.open(route("pegawai.pdf", { search: search.value }), "_blank");
};

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

        <div class="py-12 bg-[#fcfdfd]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header Actions -->
                <div
                    class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4"
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
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-sm shadow-sm"
                        />
                    </div>

                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <button
                            @click="cetakPdf"
                            class="w-full md:w-auto px-5 py-2.5 bg-red-600 rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-red-700 shadow-md active:scale-95"
                        >
                            Cetak PDF
                        </button>
                        <Link
                            :href="route('pegawai.create')"
                            class="w-full md:w-auto px-5 py-2.5 bg-blue-600 rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-blue-700 shadow-md active:scale-95 text-center"
                        >
                            Tambah Pegawai
                        </Link>
                    </div>
                </div>

                <!-- Table Data -->
                <div
                    class="bg-white shadow-xl sm:rounded-2xl border border-gray-200 overflow-hidden"
                >
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table
                                class="w-full text-left border-collapse min-w-[850px]"
                            >
                                <thead
                                    class="bg-gray-100 text-gray-800 uppercase font-black text-[10px] tracking-wider"
                                >
                                    <tr>
                                        <th
                                            class="p-4 border-b text-center w-16"
                                        >
                                            No
                                        </th>
                                        <th class="p-4 border-b">
                                            Informasi Pegawai
                                        </th>
                                        <th class="p-4 border-b">
                                            Pangkat/Gol
                                        </th>
                                        <!-- Rata Kiri -->
                                        <th class="p-4 border-b">Jabatan</th>
                                        <th
                                            class="p-4 border-b text-center w-32"
                                        >
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="divide-y divide-gray-200 text-gray-700 font-medium text-sm"
                                >
                                    <tr
                                        v-for="(p, index) in pegawai"
                                        :key="p.id"
                                        class="hover:bg-blue-50/50 transition-colors"
                                    >
                                        <td
                                            class="p-4 text-center text-gray-500 font-bold"
                                        >
                                            {{ index + 1 }}
                                        </td>
                                        <td class="p-4">
                                            <div
                                                class="flex flex-col space-y-1"
                                            >
                                                <span
                                                    class="font-black text-gray-900 text-base capitalize leading-tight"
                                                >
                                                    {{ p.nama }}
                                                </span>
                                                <span
                                                    class="text-[13px] font-bold text-black bg-yellow-50 px-2 py-0.5 rounded border border-yellow-200 w-fit"
                                                >
                                                    NIP: {{ p.nip }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="p-4 text-left">
                                            <!-- Rata Kiri -->
                                            <span
                                                class="font-bold text-gray-800 block leading-tight"
                                                >{{ p.pangkat }}</span
                                            >
                                            <span
                                                class="text-[11px] font-black text-blue-600 uppercase tracking-wide mt-1 block"
                                            >
                                                Gol: {{ p.golongan }}
                                            </span>
                                        </td>
                                        <td class="p-4">
                                            <span
                                                class="text-[11px] font-bold uppercase text-gray-600 leading-snug block max-w-[200px]"
                                            >
                                                {{ p.jabatan }}
                                            </span>
                                        </td>
                                        <td class="p-4 text-center">
                                            <div
                                                class="flex justify-center items-center space-x-2"
                                            >
                                                <!-- Tombol Edit -->
                                                <Link
                                                    :href="
                                                        route(
                                                            'pegawai.edit',
                                                            p.id,
                                                        )
                                                    "
                                                    class="p-2 text-blue-700 bg-blue-100 rounded-lg hover:bg-blue-700 hover:text-white transition-all border border-blue-200 active:scale-90"
                                                    title="Edit"
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

                                                <!-- Tombol Hapus -->
                                                <button
                                                    @click="hapusPegawai(p.id)"
                                                    class="p-2 text-red-700 bg-red-100 rounded-lg hover:bg-red-700 hover:text-white transition-all border border-red-200 active:scale-90"
                                                    title="Hapus"
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
                                            colspan="5"
                                            class="p-20 text-center text-gray-500 italic font-bold"
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

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";

const props = defineProps({
    nonPegawai: Array,
    filters: Object,
    totalArsip: Number,
});

const search = ref(props.filters?.search || "");

// Watcher untuk pencarian otomatis
watch(
    search,
    debounce((value) => {
        router.get(
            route("non-pegawai.index"),
            { search: value },
            { preserveState: true, replace: true },
        );
    }, 400),
);

const hapusData = (id) => {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        router.delete(route("non-pegawai.destroy", id));
    }
};
</script>

<template>
    <Head title="Data Non-Pegawai" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    Daftar <span class="text-emerald-600">Non-Pegawai</span>
                </h2>
                <div
                    class="hidden md:flex items-center bg-emerald-50 border border-emerald-100 px-4 py-1.5 rounded-2xl"
                >
                    <div
                        class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse mr-2"
                    ></div>
                    <span
                        class="text-[10px] font-black uppercase tracking-widest text-emerald-700"
                    >
                        Tenaga Pendukung Bapelkum
                    </span>
                </div>
            </div>
        </template>

        <div class="py-12 bg-[#fcfdfd]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="flex flex-col md:flex-row justify-between items-center mb-8 gap-6"
                >
                    <div class="relative w-full md:w-96">
                        <span
                            class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400"
                        >
                            <svg
                                class="w-5 h-5"
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
                            placeholder="Cari nama atau jabatan..."
                            class="block w-full pl-12 pr-4 py-3.5 border-none rounded-2xl bg-white shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-emerald-500 transition-all text-sm"
                        />
                    </div>

                    <Link
                        :href="route('non-pegawai.create')"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3.5 rounded-2xl text-sm font-bold transition-all shadow-xl shadow-emerald-100 active:scale-95 flex items-center gap-2 uppercase tracking-widest w-full md:w-auto justify-center"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
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
                    class="bg-white shadow-2xl shadow-gray-200/50 rounded-[2.5rem] overflow-hidden border border-gray-100"
                >
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-gray-50/50 text-gray-400 uppercase font-black text-[10px] tracking-[0.2em]"
                                >
                                    <th class="p-6 border-b text-center w-24">
                                        No
                                    </th>
                                    <th class="p-6 border-b">Nama Lengkap</th>
                                    <th class="p-6 border-b">Jabatan</th>
                                    <th class="p-6 border-b text-center w-40">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <tr
                                    v-for="(item, index) in nonPegawai"
                                    :key="item.id"
                                    class="hover:bg-emerald-50/30 transition-all group"
                                >
                                    <td
                                        class="p-6 text-center text-gray-300 font-bold italic text-lg"
                                    >
                                        {{ index + 1 }}
                                    </td>
                                    <td class="p-6">
                                        <span
                                            class="font-bold text-gray-800 text-base group-hover:text-emerald-600 transition-colors"
                                        >
                                            {{ item.nama }}
                                        </span>
                                    </td>
                                    <td class="p-6">
                                        <div
                                            class="inline-flex items-center px-3 py-1 rounded-lg bg-gray-100 text-gray-600 font-semibold text-xs uppercase tracking-wider"
                                        >
                                            {{ item.jabatan }}
                                        </div>
                                    </td>
                                    <td class="p-6 text-center">
                                        <div
                                            class="flex items-center justify-center gap-3"
                                        >
                                            <Link
                                                :href="
                                                    route(
                                                        'non-pegawai.edit',
                                                        item.id,
                                                    )
                                                "
                                                class="p-3 bg-blue-50 text-blue-600 rounded-2xl hover:bg-blue-600 hover:text-white transition-all shadow-sm border border-blue-100"
                                            >
                                                <svg
                                                    class="w-5 h-5"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
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
                                                @click="hapusData(item.id)"
                                                class="p-3 bg-red-50 text-red-500 rounded-2xl hover:bg-red-500 hover:text-white transition-all shadow-sm border border-red-100"
                                            >
                                                <svg
                                                    class="w-5 h-5"
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
                                <tr v-if="nonPegawai.length === 0">
                                    <td colspan="4" class="p-24 text-center">
                                        <p
                                            class="text-gray-400 font-medium italic"
                                        >
                                            Belum ada data tenaga non-pegawai.
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

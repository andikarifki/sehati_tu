<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";

const props = defineProps({
    arsip: Array,
    filters: Object,
});

const search = ref(props.filters?.search || "");

watch(
    search,
    debounce((value) => {
        router.get(
            route("arsip.index"),
            { search: value },
            { preserveState: true, replace: true },
        );
    }, 300),
);

const hapusArsip = (id) => {
    if (
        confirm(
            "Apakah Anda yakin ingin menghapus dokumen ini secara permanen?",
        )
    ) {
        router.delete(route("arsip.destroy", id));
    }
};
</script>

<template>
    <Head title="Arsip Dokumen" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                Arsip Digital <span class="text-blue-600">SEHATI</span>
            </h2>
        </template>

        <div class="py-6 md:py-12 bg-[#f8fafc] min-h-screen">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="flex flex-col md:flex-row justify-between items-center mb-8 gap-6"
                >
                    <div class="relative w-full md:w-1/3">
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
                            placeholder="Cari judul, nomor, atau pihak..."
                            class="block w-full pl-12 pr-4 py-3.5 border-none rounded-2xl bg-white shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-500 transition-all text-sm"
                        />
                    </div>

                    <Link
                        :href="route('arsip.create')"
                        class="bg-[#0f172a] hover:bg-blue-700 text-white px-8 py-3.5 rounded-2xl text-sm font-bold transition-all shadow-xl shadow-blue-100 active:scale-95 flex items-center gap-2 uppercase tracking-widest w-full md:w-auto justify-center"
                    >
                        <span>+</span> Upload Dokumen
                    </Link>
                </div>

                <div
                    class="bg-white shadow-2xl shadow-gray-200/50 rounded-[2rem] overflow-hidden border border-gray-100"
                >
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-gray-50/50 text-gray-400 uppercase font-black text-[10px] tracking-[0.2em]"
                                >
                                    <th class="p-6 border-b text-center w-20">
                                        No
                                    </th>
                                    <th class="p-6 border-b">
                                        Tanggal & Nama Dokumen
                                    </th>
                                    <th class="p-6 border-b">Pihak Terkait</th>
                                    <th class="p-6 border-b text-center">
                                        Kategori
                                    </th>
                                    <th class="p-6 border-b text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody
                                class="divide-y divide-gray-50 text-gray-600 font-medium"
                            >
                                <tr
                                    v-for="(a, index) in arsip"
                                    :key="a.id"
                                    class="hover:bg-blue-50/30 transition-all group"
                                >
                                    <td
                                        class="p-6 text-center text-gray-300 font-bold italic text-lg"
                                    >
                                        {{ index + 1 }}
                                    </td>

                                    <td class="p-6">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-[10px] font-bold text-blue-500 uppercase tracking-widest mb-1"
                                            >
                                                {{ a.tanggal_dokumen }}
                                            </span>
                                            <span
                                                class="font-extrabold text-gray-900 text-xs md:text-sm leading-snug group-hover:text-blue-600 transition-colors uppercase"
                                            >
                                                {{ a.judul }}
                                            </span>
                                            <span
                                                class="px-2 py-0.5 text-gray-800 font-mono text-xs md:text-sm"
                                            >
                                                {{
                                                    a.nomor_surat ||
                                                    "No. Surat: -"
                                                }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="p-6 uppercase">
                                        <div
                                            class="font-bold text-gray-700 text-xs"
                                        >
                                            {{ a.pihak_terkait }}
                                        </div>
                                    </td>

                                    <td class="p-6 text-center">
                                        <span
                                            class="inline-flex items-center justify-center px-3 py-1 rounded-full font-black uppercase tracking-tighter md:tracking-widest transition-all border shrink-0 min-w-[80px]"
                                            :class="{
                                                // Nota Dinas (Kuning/Orange)
                                                'bg-amber-50 text-amber-600 border-amber-200 shadow-sm shadow-amber-100':
                                                    a.kategori === 'Nota Dinas',

                                                // Surat Masuk (Hijau)
                                                'bg-emerald-50 text-emerald-600 border-emerald-200 shadow-sm shadow-emerald-100':
                                                    a.kategori ===
                                                    'Surat Masuk',

                                                // Surat Keluar (Biru)
                                                'bg-blue-50 text-blue-600 border-blue-200 shadow-sm shadow-blue-100':
                                                    a.kategori ===
                                                    'Surat Keluar',

                                                // SK Pegawai (Ungu)
                                                'bg-purple-50 text-purple-600 border-purple-200 shadow-sm shadow-purple-100':
                                                    a.kategori === 'SK Pegawai',

                                                // Default jika kategori lain
                                                'bg-gray-50 text-gray-500 border-gray-200':
                                                    ![
                                                        'Surat Masuk',
                                                        'Surat Keluar',
                                                        'SK Pegawai',
                                                        'Nota Dinas',
                                                    ].includes(a.kategori),
                                            }"
                                        >
                                            <span
                                                class="w-1.5 h-1.5 rounded-full mr-1.5 hidden md:block"
                                                :class="{
                                                    'bg-amber-500':
                                                        a.kategori ===
                                                        'Nota Dinas',
                                                    'bg-emerald-500':
                                                        a.kategori ===
                                                        'Surat Masuk',
                                                    'bg-blue-500':
                                                        a.kategori ===
                                                        'Surat Keluar',
                                                    'bg-purple-500':
                                                        a.kategori ===
                                                        'SK Pegawai',
                                                }"
                                            >
                                            </span>

                                            <span
                                                class="text-[8px] md:text-[10px] whitespace-nowrap"
                                            >
                                                {{ a.kategori }}
                                            </span>
                                        </span>
                                    </td>

                                    <td class="p-6 text-center">
                                        <div
                                            class="flex items-center justify-center gap-3"
                                        >
                                            <a
                                                :href="a.file_url"
                                                target="_blank"
                                                class="p-3 bg-blue-50 text-blue-600 rounded-2xl hover:bg-blue-600 hover:text-white transition-all transform hover:-translate-y-1 shadow-sm"
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
                                                class="p-3 bg-red-50 text-red-500 rounded-2xl hover:bg-red-500 hover:text-white transition-all transform hover:-translate-y-1 shadow-sm"
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

                                <tr v-if="arsip.length === 0">
                                    <td colspan="5" class="p-32 text-center">
                                        <div
                                            class="flex flex-col items-center opacity-20"
                                        >
                                            <svg
                                                class="w-20 h-20 mb-4"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                                />
                                            </svg>
                                            <p
                                                class="font-black uppercase tracking-[0.5em] text-xs"
                                            >
                                                Arsip Kosong
                                            </p>
                                        </div>
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

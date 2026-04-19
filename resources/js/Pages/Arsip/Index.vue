<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";

const props = defineProps({
    arsip: Object, // Sekarang menerima Object (Paginator), bukan Array lagi
    filters: Object,
});

const search = ref(props.filters?.search || "");

watch(
    search,
    debounce((value) => {
        router.get(
            route("arsip.index"),
            { search: value },
            {
                preserveState: true,
                replace: true,
            },
        );
    }, 400),
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
                        Upload Dokumen
                    </Link>
                </div>

                <div
                    class="bg-white shadow-2xl shadow-gray-200/50 rounded-[2.5rem] overflow-hidden border border-gray-100"
                >
                    <div class="overflow-x-auto">
                        <table
                            class="w-full text-sm text-left border-collapse min-w-[800px]"
                        >
                            <thead>
                                <tr
                                    class="bg-gray-50/50 text-gray-400 uppercase font-black text-[10px] tracking-[0.2em]"
                                >
                                    <th class="p-6 border-b text-center w-20">
                                        No
                                    </th>
                                    <th class="p-6 border-b">Detail Dokumen</th>
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
                                    v-for="(a, index) in arsip.data"
                                    :key="a.id"
                                    class="hover:bg-blue-50/30 transition-all group"
                                >
                                    <td
                                        class="p-6 text-center text-gray-300 font-bold italic text-lg"
                                    >
                                        {{
                                            (arsip.current_page - 1) *
                                                arsip.per_page +
                                            index +
                                            1
                                        }}
                                    </td>

                                    <td class="p-6">
                                        <div class="flex flex-col">
                                            <span
                                                class="text-[9px] font-bold text-blue-500 uppercase tracking-[0.2em] mb-1"
                                            >
                                                {{ a.tanggal_dokumen }}
                                            </span>
                                            <span
                                                class="font-medium text-gray-500 text-xs md:text-sm leading-snug group-hover:text-blue-600 transition-colors uppercase mb-1.5"
                                            >
                                                {{ a.judul }}
                                            </span>
                                            <div class="inline-flex">
                                                <span
                                                    class="px-2.5 py-1 text-gray-800 font-mono font-bold text-xs md:text-sm bg-gray-50 rounded border border-gray-100"
                                                >
                                                    {{
                                                        a.nomor_surat ||
                                                        "No. Surat: -"
                                                    }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="p-6 uppercase">
                                        <div
                                            class="font-bold text-gray-700 text-xs tracking-tight"
                                        >
                                            {{ a.pihak_terkait }}
                                        </div>
                                    </td>

                                    <td class="p-6 text-center">
                                        <span
                                            class="inline-flex items-center justify-center px-4 py-1.5 rounded-full font-black uppercase transition-all border shrink-0 min-w-[100px]"
                                            :class="{
                                                'bg-amber-50 text-amber-600 border-amber-200':
                                                    a.kategori === 'Nota Dinas',
                                                'bg-emerald-50 text-emerald-600 border-emerald-200':
                                                    a.kategori ===
                                                    'Surat Masuk',
                                                'bg-blue-50 text-blue-600 border-blue-200':
                                                    a.kategori ===
                                                    'Surat Keluar',
                                                'bg-purple-50 text-purple-600 border-purple-200':
                                                    a.kategori === 'SK Pegawai',
                                            }"
                                        >
                                            <span
                                                class="text-[9px] md:text-[10px] whitespace-nowrap tracking-widest"
                                                >{{ a.kategori }}</span
                                            >
                                        </span>
                                    </td>

                                    <td class="p-6 text-center">
                                        <div
                                            class="flex items-center justify-center gap-3"
                                        >
                                            <a
                                                :href="a.file_url"
                                                target="_blank"
                                                class="p-3 bg-blue-50 text-blue-600 rounded-2xl hover:bg-blue-600 hover:text-white transition-all shadow-sm border border-blue-100"
                                                title="Buka PDF"
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
                                            <Link
                                                :href="
                                                    route('arsip.edit', a.id)
                                                "
                                                class="p-3 bg-amber-50 text-amber-600 rounded-2xl hover:bg-amber-500 hover:text-white transition-all shadow-sm border border-amber-100"
                                                title="Edit Dokumen"
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
                                                @click="hapusArsip(a.id)"
                                                class="p-3 bg-red-50 text-red-500 rounded-2xl hover:bg-red-500 hover:text-white transition-all shadow-sm border border-red-100"
                                                title="Hapus Arsip"
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

                                <tr v-if="arsip.data.length === 0">
                                    <td
                                        colspan="5"
                                        class="p-32 text-center opacity-20"
                                    >
                                        <p
                                            class="font-black uppercase tracking-[0.5em] text-xs"
                                        >
                                            Arsip Tidak Ditemukan
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div
                        v-if="arsip.links.length > 3"
                        class="px-6 py-4 bg-gray-50/50 border-t border-gray-100 flex justify-center flex-wrap gap-2"
                    >
                        <template v-for="(link, k) in arsip.links" :key="k">
                            <div
                                v-if="link.url === null"
                                class="px-4 py-2 text-xs text-gray-400 border border-gray-100 rounded-xl"
                                v-html="link.label"
                            />
                            <Link
                                v-else
                                :href="link.url"
                                class="px-4 py-2 text-xs rounded-xl transition-all border"
                                :class="{
                                    'bg-blue-600 text-white border-blue-600 font-bold shadow-lg shadow-blue-100':
                                        link.active,
                                    'bg-white text-gray-600 border-gray-200 hover:border-blue-300':
                                        !link.active,
                                }"
                                v-html="link.label"
                                preserve-scroll
                            />
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { computed } from "vue";

// Menerima data pegawai untuk pilihan dropdown jika kategori SK dipilih
const props = defineProps({
    pegawai: Array,
});

const form = useForm({
    judul: "",
    nomor_surat: "",
    tanggal_dokumen: "",
    kategori: "",
    pihak_terkait: "",
    file: null,
});

// Logika dinamis untuk label Pihak Terkait
const labelPihak = computed(() => {
    switch (form.kategori) {
        case "Surat Masuk":
            return "Asal Surat (Instansi)";
        case "Surat Keluar":
            return "Tujuan Surat (Instansi/Pejabat)";
        case "SK Pegawai":
            return "Nama Pegawai";
        case "Nota Dinas":
            return "Unit Pengirim";
        default:
            return "Pihak Terkait";
    }
});

const submit = () => {
    // Gunakan form.post untuk upload file
    form.post(route("arsip.store"), {
        forceFormData: true,
    });
};
</script>

<template>
    <Head title="Upload Dokumen" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Upload Dokumen Baru
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white shadow-2xl rounded-[2rem] overflow-hidden border border-gray-100"
                >
                    <div class="p-8">
                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <label
                                    class="block text-sm font-black text-gray-700 uppercase tracking-widest mb-2"
                                    >Kategori Arsip</label
                                >
                                <select
                                    v-model="form.kategori"
                                    class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 font-bold text-gray-700"
                                >
                                    <option value="" disabled>
                                        Pilih Jenis Dokumen
                                    </option>
                                    <option value="Surat Masuk">
                                        Surat Masuk
                                    </option>
                                    <option value="Surat Keluar">
                                        Surat Keluar
                                    </option>
                                    <option value="SK Pegawai">
                                        SK Pegawai
                                    </option>
                                    <option value="Nota Dinas">
                                        Nota Dinas
                                    </option>
                                    <option value="Sertifikat">
                                        Sertifikat/Ijazah
                                    </option>
                                </select>
                                <div
                                    v-if="form.errors.kategori"
                                    class="text-red-500 text-xs mt-1"
                                >
                                    {{ form.errors.kategori }}
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-black text-gray-700 uppercase tracking-widest mb-2"
                                    >Judul Dokumen</label
                                >
                                <input
                                    v-model="form.judul"
                                    type="text"
                                    class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Contoh: Undangan Rapat Koordinasi..."
                                />
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-sm font-black text-gray-700 uppercase tracking-widest mb-2"
                                        >Nomor Surat</label
                                    >
                                    <input
                                        v-model="form.nomor_surat"
                                        type="text"
                                        class="w-full border-gray-200 rounded-xl font-mono"
                                        placeholder="No. Surat Resmi"
                                    />
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-black text-gray-700 uppercase tracking-widest mb-2"
                                        >Tanggal Surat</label
                                    >
                                    <input
                                        v-model="form.tanggal_dokumen"
                                        type="date"
                                        class="w-full border-gray-200 rounded-xl"
                                    />
                                </div>
                            </div>

                            <div v-if="form.kategori">
                                <label
                                    class="block text-sm font-black text-blue-600 uppercase tracking-widest mb-2"
                                    >{{ labelPihak }}</label
                                >

                                <select
                                    v-if="form.kategori === 'SK Pegawai'"
                                    v-model="form.pihak_terkait"
                                    class="w-full border-gray-200 rounded-xl focus:ring-blue-500"
                                >
                                    <option value="">Pilih Pegawai...</option>
                                    <option
                                        v-for="p in pegawai"
                                        :key="p.id"
                                        :value="p.nama"
                                    >
                                        {{ p.nama }}
                                    </option>
                                </select>

                                <input
                                    v-else
                                    v-model="form.pihak_terkait"
                                    type="text"
                                    class="w-full border-gray-200 rounded-xl"
                                    :placeholder="'Masukkan ' + labelPihak"
                                />
                            </div>

                            <div
                                class="p-6 border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50/50"
                            >
                                <label
                                    class="block text-sm font-black text-gray-700 uppercase tracking-widest mb-3 text-center"
                                    >Berkas PDF (Maks 2MB)</label
                                >
                                <input
                                    type="file"
                                    @input="form.file = $event.target.files[0]"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-blue-600 file:text-white hover:file:bg-blue-700"
                                    accept=".pdf"
                                />
                                <div
                                    v-if="form.errors.file"
                                    class="text-red-500 text-xs mt-1"
                                >
                                    {{ form.errors.file }}
                                </div>
                            </div>

                            <div
                                class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100"
                            >
                                <Link
                                    :href="route('arsip.index')"
                                    class="text-sm font-bold text-gray-400 hover:text-gray-600 uppercase tracking-widest"
                                >
                                    Batal
                                </Link>
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-3.5 rounded-xl font-black shadow-lg shadow-blue-100 transition-all active:scale-95 disabled:opacity-50 uppercase text-xs tracking-widest"
                                >
                                    Simpan Arsip
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

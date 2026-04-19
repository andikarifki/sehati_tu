<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";

const props = defineProps({
    arsip: Object, // Data arsip yang akan diedit
});

// Inisialisasi form dengan data dari props
const form = useForm({
    _method: "PUT", // Penting: Laravel membutuhkan ini untuk spoofing metode PUT pada form data
    judul: props.arsip.judul,
    nomor_surat: props.arsip.nomor_surat,
    tanggal_dokumen: props.arsip.tanggal_dokumen,
    pihak_terkait: props.arsip.pihak_terkait,
    kategori: props.arsip.kategori,
    file: null, // File baru jika ingin diganti
});

const submit = () => {
    // Kita kirim sebagai POST dengan _method PUT karena berisi File (multipart/form-data)
    form.post(route("arsip.update", props.arsip.id), {
        onSuccess: () => {
            alert("Dokumen berhasil diperbarui!");
        },
    });
};
</script>

<template>
    <Head title="Edit Arsip" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight">
                Edit Dokumen <span class="text-blue-600">Arsip</span>
            </h2>
        </template>

        <div class="py-12 bg-[#f8fafc] min-h-screen">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="bg-white shadow-2xl shadow-gray-200/50 rounded-[2.5rem] p-8 md:p-12 border border-gray-100"
                >
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2"
                                >Judul Dokumen</label
                            >
                            <input
                                v-model="form.judul"
                                type="text"
                                class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold text-gray-700 transition-all"
                                placeholder="Masukkan Judul..."
                                required
                            />
                            <div
                                v-if="form.errors.judul"
                                class="text-red-500 text-xs mt-1"
                            >
                                {{ form.errors.judul }}
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2"
                                    >Nomor Surat</label
                                >
                                <input
                                    v-model="form.nomor_surat"
                                    type="text"
                                    class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold text-gray-700"
                                    placeholder="Contoh: W13.PAS.PAS27..."
                                />
                            </div>

                            <div>
                                <label
                                    class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2"
                                    >Tanggal Dokumen</label
                                >
                                <input
                                    v-model="form.tanggal_dokumen"
                                    type="date"
                                    class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold text-gray-700"
                                    required
                                />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label
                                    class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2"
                                    >Kategori</label
                                >
                                <select
                                    v-model="form.kategori"
                                    class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold text-gray-700"
                                    required
                                >
                                    <option value="Surat Masuk">
                                        Surat Masuk
                                    </option>
                                    <option value="Surat Keluar">
                                        Surat Keluar
                                    </option>
                                    <option value="Nota Dinas">
                                        Nota Dinas
                                    </option>
                                    <option value="SK Pegawai">
                                        SK Pegawai
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label
                                    class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2"
                                    >Pihak Terkait</label
                                >
                                <input
                                    v-model="form.pihak_terkait"
                                    type="text"
                                    class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500 font-bold text-gray-700"
                                    placeholder="Nama orang/instansi"
                                />
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2"
                                >Ganti File PDF (Kosongkan jika tidak ingin
                                mengganti)</label
                            >
                            <div class="relative group">
                                <input
                                    @input="form.file = $event.target.files[0]"
                                    type="file"
                                    accept=".pdf"
                                    class="w-full px-6 py-4 bg-blue-50/50 border-2 border-dashed border-blue-200 rounded-2xl text-sm font-bold text-blue-600 file:hidden cursor-pointer hover:bg-blue-50 transition-all"
                                />
                                <div
                                    class="mt-2 text-[10px] text-gray-400 font-medium"
                                >
                                    File saat ini:
                                    <span class="text-blue-500">{{
                                        props.arsip.file_path.split("/").pop()
                                    }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row gap-4 pt-6">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-black uppercase tracking-widest py-4 rounded-2xl shadow-xl shadow-blue-200 transition-all active:scale-95 disabled:opacity-50"
                            >
                                Simpan Perubahan
                            </button>
                            <Link
                                :href="route('arsip.index')"
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 font-black uppercase tracking-widest py-4 rounded-2xl text-center transition-all"
                            >
                                Batal
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

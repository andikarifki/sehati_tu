<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

// 1. Menerima data pegawai dari Controller
const props = defineProps({
    pegawai: Object,
});

// 2. Daftar Pangkat & Golongan (Array Statis)
const daftarPangkat = [
    "Juru Muda",
    "Juru Muda Tingkat I",
    "Juru",
    "Juru Tingkat I",
    "Pengatur Muda",
    "Pengatur Muda Tingkat I",
    "Pengatur",
    "Pengatur Tingkat I",
    "Penata Muda",
    "Penata Muda Tingkat I",
    "Penata",
    "Penata Tingkat I",
    "Pembina",
    "Pembina Tingkat I",
    "Pembina Utama Muda",
    "Pembina Utama Madya",
    "Pembina Utama",
];

const daftarGolongan = [
    "I/a",
    "I/b",
    "I/c",
    "I/d",
    "II/a",
    "II/b",
    "II/c",
    "II/d",
    "III/a",
    "III/b",
    "III/c",
    "III/d",
    "IV/a",
    "IV/b",
    "IV/c",
    "IV/d",
    "IV/e",
];

// 3. Inisialisasi Form dengan data dari Props
const form = useForm({
    nip: props.pegawai.nip,
    nama: props.pegawai.nama,
    pangkat: props.pegawai.pangkat,
    golongan: props.pegawai.golongan,
    jabatan: props.pegawai.jabatan,
});

// 4. Fungsi Submit
const submit = () => {
    form.put(route("pegawai.update", props.pegawai.id), {
        onSuccess: () => {
            // Logika tambahan jika berhasil (opsional)
        },
    });
};
</script>

<template>
    <Head title="Edit Data Pegawai" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Edit Data Pegawai
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100"
                >
                    <div class="p-8">
                        <form @submit.prevent="submit" class="space-y-6">
                            <!-- Input NIP -->
                            <div>
                                <label
                                    class="block text-sm font-bold text-gray-700 mb-2"
                                    >NIP</label
                                >
                                <input
                                    v-model="form.nip"
                                    type="text"
                                    class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500 font-mono"
                                    placeholder="Masukkan NIP"
                                />
                                <div
                                    v-if="form.errors.nip"
                                    class="text-red-500 text-xs mt-1"
                                >
                                    {{ form.errors.nip }}
                                </div>
                            </div>

                            <!-- Input Nama -->
                            <div>
                                <label
                                    class="block text-sm font-bold text-gray-700 mb-2"
                                    >Nama Pegawai</label
                                >
                                <input
                                    v-model="form.nama"
                                    type="text"
                                    class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Nama Lengkap"
                                />
                                <div
                                    v-if="form.errors.nama"
                                    class="text-red-500 text-xs mt-1"
                                >
                                    {{ form.errors.nama }}
                                </div>
                            </div>

                            <!-- Dropdown Pangkat & Golongan -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-sm font-bold text-gray-700 mb-2"
                                        >Pangkat</label
                                    >
                                    <select
                                        v-model="form.pangkat"
                                        class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    >
                                        <option value="" disabled>
                                            Pilih Pangkat
                                        </option>
                                        <option
                                            v-for="pangkat in daftarPangkat"
                                            :key="pangkat"
                                            :value="pangkat"
                                        >
                                            {{ pangkat }}
                                        </option>
                                    </select>
                                    <div
                                        v-if="form.errors.pangkat"
                                        class="text-red-500 text-xs mt-1"
                                    >
                                        {{ form.errors.pangkat }}
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-sm font-bold text-gray-700 mb-2"
                                        >Golongan</label
                                    >
                                    <select
                                        v-model="form.golongan"
                                        class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    >
                                        <option value="" disabled>
                                            Pilih Golongan
                                        </option>
                                        <option
                                            v-for="gol in daftarGolongan"
                                            :key="gol"
                                            :value="gol"
                                        >
                                            {{ gol }}
                                        </option>
                                    </select>
                                    <div
                                        v-if="form.errors.golongan"
                                        class="text-red-500 text-xs mt-1"
                                    >
                                        {{ form.errors.golongan }}
                                    </div>
                                </div>
                            </div>

                            <!-- Input Jabatan -->
                            <div>
                                <label
                                    class="block text-sm font-bold text-gray-700 mb-2"
                                    >Jabatan</label
                                >
                                <input
                                    v-model="form.jabatan"
                                    type="text"
                                    class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Jabatan Saat Ini"
                                />
                                <div
                                    v-if="form.errors.jabatan"
                                    class="text-red-500 text-xs mt-1"
                                >
                                    {{ form.errors.jabatan }}
                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div
                                class="flex items-center justify-end gap-4 pt-4 border-t"
                            >
                                <Link
                                    :href="route('pegawai.index')"
                                    class="text-sm text-gray-600 hover:text-gray-900 font-bold"
                                >
                                    Batal
                                </Link>
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-black shadow-lg shadow-blue-200 transition-all active:scale-95 disabled:opacity-50"
                                >
                                    <span v-if="form.processing"
                                        >Menyimpan...</span
                                    >
                                    <span v-else>Simpan Perubahan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

// Menerima data pegawai dari Controller
const props = defineProps({
    pegawai: Object,
});

// Inisialisasi form dengan data pegawai yang akan diedit
const form = useForm({
    nip: props.pegawai.nip,
    nama: props.pegawai.nama,
    pangkat: props.pegawai.pangkat,
    golongan: props.pegawai.golongan,
    jabatan: props.pegawai.jabatan,
});

// Fungsi untuk mengirim perubahan data
const submit = () => {
    form.put(route("pegawai.update", props.pegawai.id));
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

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-sm font-bold text-gray-700 mb-2"
                                        >Pangkat</label
                                    >
                                    <input
                                        v-model="form.pangkat"
                                        type="text"
                                        class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Contoh: Penata"
                                    />
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-bold text-gray-700 mb-2"
                                        >Golongan</label
                                    >
                                    <input
                                        v-model="form.golongan"
                                        type="text"
                                        class="w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Contoh: III/c"
                                    />
                                </div>
                            </div>

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
                            </div>

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
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

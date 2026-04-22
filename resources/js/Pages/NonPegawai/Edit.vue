<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

// Props yang dikirim dari Controller
const props = defineProps({
    nonPegawai: Object,
});

// Inisialisasi form dengan data lama dari props
const form = useForm({
    nama: props.nonPegawai.nama,
    jabatan: props.nonPegawai.jabatan,
});

const submit = () => {
    // Menggunakan route update dengan ID data yang diedit
    form.put(route("non-pegawai.update", props.nonPegawai.id));
};
</script>

<template>
    <Head title="Edit Data Pegawai" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Edit <span class="text-emerald-600">Data Pegawai</span>
            </h2>
        </template>

        <div class="py-12 bg-[#fcfdfd]">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="bg-white shadow-2xl shadow-gray-200/50 rounded-[2.5rem] overflow-hidden border border-gray-100"
                >
                    <div class="p-8 md:p-12">
                        <form @submit.prevent="submit" class="space-y-8">
                            <div>
                                <label
                                    class="block text-xs font-black uppercase tracking-[0.2em] text-gray-400 mb-3 ml-1"
                                >
                                    Nama Lengkap
                                </label>
                                <input
                                    v-model="form.nama"
                                    type="text"
                                    placeholder="Masukkan nama lengkap..."
                                    class="block w-full px-5 py-4 border-none rounded-2xl bg-gray-50 shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-emerald-500 transition-all text-sm font-medium"
                                    :class="{
                                        'ring-red-500': form.errors.nama,
                                    }"
                                />
                                <div
                                    v-if="form.errors.nama"
                                    class="text-red-500 text-xs mt-2 ml-1 font-bold italic"
                                >
                                    {{ form.errors.nama }}
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-black uppercase tracking-[0.2em] text-gray-400 mb-3 ml-1"
                                >
                                    Jabatan / Peran
                                </label>
                                <input
                                    v-model="form.jabatan"
                                    type="text"
                                    placeholder="Contoh: PPNPN, Security, Driver..."
                                    class="block w-full px-5 py-4 border-none rounded-2xl bg-gray-50 shadow-sm ring-1 ring-gray-200 focus:ring-2 focus:ring-emerald-500 transition-all text-sm font-medium"
                                    :class="{
                                        'ring-red-500': form.errors.jabatan,
                                    }"
                                />
                                <div
                                    v-if="form.errors.jabatan"
                                    class="text-red-500 text-xs mt-2 ml-1 font-bold italic"
                                >
                                    {{ form.errors.jabatan }}
                                </div>
                            </div>

                            <div
                                class="flex flex-col md:flex-row items-center gap-4 pt-4"
                            >
                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="w-full md:flex-1 bg-emerald-600 hover:bg-emerald-700 text-white py-4 rounded-2xl text-sm font-black transition-all shadow-xl shadow-emerald-100 active:scale-95 flex items-center justify-center gap-2 uppercase tracking-widest disabled:opacity-50"
                                >
                                    <svg
                                        v-if="!form.processing"
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                                        />
                                    </svg>
                                    {{
                                        form.processing
                                            ? "Memperbarui..."
                                            : "Simpan Perubahan"
                                    }}
                                </button>

                                <Link
                                    :href="route('non-pegawai.index')"
                                    class="w-full md:w-auto px-8 py-4 text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors uppercase tracking-widest text-center"
                                >
                                    Batal
                                </Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

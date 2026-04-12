<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, Link } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";

const form = useForm({
    nip: "",
    nama: "",
    pangkat: "",
    golongan: "",
    jabatan: "",
});

const submit = () => {
    form.post(route("pegawai.store"));
};
</script>

<template>
    <Head title="Tambah Pegawai" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Tambah Pegawai Baru
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white shadow-xl sm:rounded-2xl overflow-hidden border border-gray-100"
                >
                    <div class="p-8">
                        <div class="flex items-center gap-4 mb-8">
                            <div
                                class="bg-blue-600 text-white p-3 rounded-2xl shadow-lg shadow-blue-200"
                            >
                                <span class="text-2xl">👤</span>
                            </div>
                            <div>
                                <h3
                                    class="text-xl font-black text-gray-900 leading-none uppercase"
                                >
                                    Formulir Data
                                </h3>
                                <p
                                    class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-2 text-wrap"
                                >
                                    Lengkapi administrasi pegawai Bapelkum
                                </p>
                            </div>
                        </div>

                        <form @submit.prevent="submit" class="space-y-6">
                            <div>
                                <InputLabel
                                    for="nip"
                                    value="NIP (Nomor Induk Pegawai)"
                                    class="font-bold text-xs text-gray-500 uppercase tracking-widest"
                                />
                                <TextInput
                                    id="nip"
                                    v-model="form.nip"
                                    type="text"
                                    class="mt-2 block w-full bg-gray-50 border-gray-200 focus:bg-white rounded-xl"
                                    required
                                    autofocus
                                />
                                <InputError
                                    :message="form.errors.nip"
                                    class="mt-2"
                                />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <InputLabel
                                        for="nama"
                                        value="Nama Lengkap"
                                        class="font-bold text-xs text-gray-500 uppercase tracking-widest"
                                    />
                                    <TextInput
                                        id="nama"
                                        v-model="form.nama"
                                        type="text"
                                        class="mt-2 block w-full bg-gray-50 border-gray-200 rounded-xl"
                                        required
                                    />
                                    <InputError
                                        :message="form.errors.nama"
                                        class="mt-2"
                                    />
                                </div>
                                <div>
                                    <InputLabel
                                        for="pangkat"
                                        value="Pangkat"
                                        class="font-bold text-xs text-gray-500 uppercase tracking-widest"
                                    />
                                    <TextInput
                                        id="pangkat"
                                        v-model="form.pangkat"
                                        type="text"
                                        class="mt-2 block w-full bg-gray-50 border-gray-200 rounded-xl"
                                        required
                                    />
                                    <InputError
                                        :message="form.errors.pangkat"
                                        class="mt-2"
                                    />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <InputLabel
                                        for="golongan"
                                        value="Golongan"
                                        class="font-bold text-xs text-gray-500 uppercase tracking-widest"
                                    />
                                    <TextInput
                                        id="golongan"
                                        v-model="form.golongan"
                                        type="text"
                                        class="mt-2 block w-full bg-gray-50 border-gray-200 rounded-xl"
                                        required
                                    />
                                    <InputError
                                        :message="form.errors.golongan"
                                        class="mt-2"
                                    />
                                </div>
                                <div>
                                    <InputLabel
                                        for="jabatan"
                                        value="Jabatan"
                                        class="font-bold text-xs text-gray-500 uppercase tracking-widest"
                                    />
                                    <TextInput
                                        id="jabatan"
                                        v-model="form.jabatan"
                                        type="text"
                                        class="mt-2 block w-full bg-gray-50 border-gray-200 rounded-xl"
                                        required
                                    />
                                    <InputError
                                        :message="form.errors.jabatan"
                                        class="mt-2"
                                    />
                                </div>
                            </div>

                            <div
                                class="mt-10 flex justify-end gap-4 pt-8 border-t border-gray-100"
                            >
                                <Link :href="route('pegawai.index')">
                                    <SecondaryButton
                                        class="rounded-xl border-none font-bold text-gray-400 hover:text-gray-600"
                                        >Batal</SecondaryButton
                                    >
                                </Link>
                                <PrimaryButton
                                    class="px-10 py-4 bg-blue-600 hover:bg-blue-700 rounded-2xl font-black tracking-widest shadow-xl shadow-blue-100"
                                    :disabled="form.processing"
                                >
                                    Simpan Data
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

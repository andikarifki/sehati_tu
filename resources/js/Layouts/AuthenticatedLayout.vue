<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import { Link } from "@inertiajs/vue3";

// State untuk toggle sidebar
const isCollapsed = ref(false);

const toggleSidebar = () => {
    isCollapsed.value = !isCollapsed.value;
};
</script>

<template>
    <div class="flex h-screen bg-[#f8fafc] font-sans overflow-hidden">
        <aside
            :class="isCollapsed ? 'w-20' : 'w-64'"
            class="bg-[#0a1d37] text-white flex-shrink-0 hidden md:flex flex-col shadow-2xl transition-all duration-300 ease-in-out relative z-20"
        >
            <button
                @click="toggleSidebar"
                class="absolute -right-3 top-20 bg-yellow-400 text-[#0a1d37] rounded-full p-1 shadow-lg hover:bg-yellow-300 transition-colors z-50 border-2 border-[#0a1d37]"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 transition-transform duration-300"
                    :class="isCollapsed ? 'rotate-180' : ''"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="3"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>
            </button>

            <div class="p-4 border-b border-white/10 overflow-hidden">
                <div class="flex items-center justify-start flex-row">
                    <div class="w-10 h-10 flex-shrink-0">
                        <ApplicationLogo class="w-full h-full object-contain" />
                    </div>

                    <div
                        v-if="!isCollapsed"
                        class="flex flex-col ml-1.5 leading-none transition-opacity duration-300"
                    >
                        <span
                            class="text-xl font-black tracking-tighter uppercase"
                        >
                            SEHATI<span class="text-yellow-400">-</span>TU
                        </span>
                        <span
                            class="text-[8px] text-blue-300 font-bold uppercase tracking-tight -mt-0.5 whitespace-nowrap"
                        >
                            Bapelkum Semarang
                        </span>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-3 py-6 space-y-2 overflow-x-hidden">
                <NavLink
                    :href="route('dashboard')"
                    :active="route().current('dashboard')"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group hover:bg-white/10 border-none"
                >
                    <span
                        class="text-xl filter drop-shadow-sm"
                        :class="!isCollapsed ? 'mr-3' : 'mx-auto'"
                    >
                        📊
                    </span>
                    <span
                        v-if="!isCollapsed"
                        class="text-sm font-bold text-blue-100 group-hover:text-white whitespace-nowrap uppercase tracking-wide"
                    >
                        Dashboard
                    </span>
                </NavLink>

                <NavLink
                    :href="route('pegawai.index')"
                    :active="route().current('pegawai.index')"
                    class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group hover:bg-white/10 border-none"
                >
                    <span
                        class="text-xl filter drop-shadow-sm"
                        :class="!isCollapsed ? 'mr-3' : 'mx-auto'"
                    >
                        🗂️
                    </span>
                    <span
                        v-if="!isCollapsed"
                        class="text-sm font-bold text-blue-100 group-hover:text-white whitespace-nowrap uppercase tracking-wide"
                    >
                        Data Pegawai
                    </span>
                </NavLink>
            </nav>

            <div
                class="p-4 border-t border-white/5 text-center overflow-hidden bg-black/20"
            >
                <p
                    v-if="!isCollapsed"
                    class="text-[9px] text-blue-400/80 uppercase font-black tracking-tighter whitespace-nowrap"
                >
                    v1.0 &copy; 2026 Badiklat Jateng
                </p>
                <p v-else class="text-[9px] font-black text-yellow-400">V1</p>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <header
                class="bg-white border-b border-gray-100 h-16 flex items-center justify-between px-8 z-10 shrink-0"
            >
                <div class="flex-1 min-w-0">
                    <slot name="header" />
                </div>

                <div class="flex items-center ml-4">
                    <Dropdown align="right" width="48">
                        <template #trigger>
                            <span class="inline-flex rounded-md shadow-sm">
                                <button
                                    type="button"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-bold rounded-xl text-gray-600 bg-gray-50 hover:text-blue-600 hover:bg-blue-50 transition duration-150 ease-in-out focus:outline-none"
                                >
                                    {{ $page.props.auth.user.name }}
                                    <svg
                                        class="ms-2 -me-0.5 h-4 w-4 fill-blue-500"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </button>
                            </span>
                        </template>

                        <template #content>
                            <DropdownLink
                                :href="route('profile.edit')"
                                class="font-bold"
                            >
                                Profile
                            </DropdownLink>
                            <div class="border-t border-gray-100"></div>
                            <DropdownLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                                class="text-red-600 font-bold"
                            >
                                Log Out
                            </DropdownLink>
                        </template>
                    </Dropdown>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 sm:p-8">
                <div class="mx-auto max-w-[1600px]">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>

<style scoped>
/* Menghilangkan border default NavLink Breeze dan memberi efek aktif */
:deep(.border-indigo-400) {
    border-color: transparent !important;
    background-color: rgba(255, 255, 255, 0.12) !important;
    backdrop-filter: blur(4px);
    color: white !important;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
}

:deep(a) {
    text-decoration: none !important;
}

/* Transisi halus untuk konten utama saat sidebar toggle */
main {
    transition: padding 0.3s ease;
}
</style>

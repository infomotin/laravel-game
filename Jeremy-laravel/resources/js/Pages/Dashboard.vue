<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-blue-200 shadow-sm sm:rounded-lg dark:bg-gray-800"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-around">
                            <button class=" btn-primary" popovertarget="popover" popovertargetaction="show">
                                Popover show
                            </button>
                             <button class="btn-secondary" popovertarget="popover" popovertargetaction="close">
                                Popover close
                            </button>
                             <button class="btn-success" popovertarget="popover" popovertargetaction="show">
                                Popover show
                            </button>
                        </div>

                    </div>
                    <div popover="auto" id="popover" class="overflow-hidden bg-yellow-200 shadow-sm sm:rounded-lg dark:bg-gray-800">Message popover</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

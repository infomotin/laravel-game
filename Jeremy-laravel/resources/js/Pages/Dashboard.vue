<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";

const props = usePage().props; // all props from Laravel
const gaugeData = props.gaugeData; // only our data
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-blue-200 shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="bg-white p-4 shadow sm:rounded-lg dark:bg-gray-800">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                                    Gauge Data
                                </h2>
                                <pre class="text-gray-600 dark:text-gray-400">
                                    {{ gaugeData }}
                                    <br />

                                </pre>
                            </div>

                            <div class="bg-white p-4 shadow sm:rounded-lg dark:bg-gray-800">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                                    Date
                                </h2>
                                <p class="text-gray-600 dark:text-gray-400">
                                   <strong>Execution Time:</strong> {{ gaugeData.time }} seconds
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style scoped></style>

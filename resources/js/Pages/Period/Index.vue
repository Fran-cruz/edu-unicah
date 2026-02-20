<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
</script>

<template>
    <AuthenticatedLayout>
    <h1>Este es Period/Index.vue</h1>

    <a
        href="/period/create"
        class="inline-block mt-4 px-5 py-2.5 bg-blue-600 text-white rounded hover:bg-blue-700"
    >
        Ir a /Create
    </a>

    <a
        href="/period/edit"
        class="inline-block mt-4 px-5 py-2.5 bg-blue-600 text-white rounded hover:bg-blue-700"
    >
        Ir a /Edit
    </a>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>

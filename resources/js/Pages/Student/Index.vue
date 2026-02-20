<script setup>
import { Link } from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
</script>

<template>
    <AuthenticatedLayout>
    <div class="d-flex justify-center ga-2">
    <h1>Este es Student/Index.vue</h1>
    </div>

    <div class="d-flex justify-center">
        <Link href="/students/create">
            <v-btn>Ir a /Create</v-btn>
        </Link>

        <Link href="/students/edit">
            <v-btn>Ir a /Edit</v-btn>
        </Link>
    </div>
    </AuthenticatedLayout>`
</template>

<style scoped>

</style>

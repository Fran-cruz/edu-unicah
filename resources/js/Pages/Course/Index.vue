<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="d-flex justify-center ga-2">
        <h1>Este es Courses/Index.vue</h1>
    </div>

    <div class="d-flex justify-center">
        <Link href="/courses/create">
            <v-btn>Ir a /Create</v-btn>
        </Link>

        <Link href="/courses/edit">
            <v-btn>Ir a /Edit</v-btn>
        </Link>
    </div>
</template>

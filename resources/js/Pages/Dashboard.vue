<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="my-3 card">
            <div class="card-body">
                <div class="p-6 text-gray-900">You're logged in!</div>
                {{ $page.props.auth.permissions }}
            </div>
        </div>
    </AuthenticatedLayout>
</template>

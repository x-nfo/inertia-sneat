<script setup>
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <ApplicationLogo />

                        <!-- Main Content -->
                        <slot />

                        <!-- End of Main Content -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="buy-now">
        <a
            href="https://themeselection.com/item/sneat-bootstrap-html-admin-template/"
            target="_blank"
            class="btn btn-danger btn-buy-now"
            >Upgrade to Pro</a
        >
    </div>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { useDark } from '@vueuse/core';

const isDark = useDark({
    selector: 'html',
    attribute: 'class',
    valueDark: 'dark-style',
    valueLight: 'light-style',
});
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

    <div class="buy-now d-flex gap-2">
        <a
            href="https://themeselection.com/item/sneat-bootstrap-html-admin-template/"
            target="_blank"
            class="btn btn-danger btn-buy-now"
            >Upgrade to Pro</a
        >
    </div>
</template>

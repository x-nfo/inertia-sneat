<script setup>
import { ref, watchEffect } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, usePage } from '@inertiajs/vue3';
import DashboardAside from '@/Components/DashboardAside.vue';
import DashboardNavbar from '@/Components/DashboardNavbar.vue';
import Swal from 'sweetalert2';

const showingNavigationDropdown = ref(false);
import { useDark, useToggle } from '@vueuse/core';

const isDark = useDark({
    selector: 'html',
    attribute: 'class',
    valueDark: 'dark-style',
    valueLight: 'light-style',
});
const toggleDark = useToggle(isDark);

let getFullYear = new Date().getFullYear();

watchEffect(() => {
    let flashMessage = usePage().props.flashMessage;

    if (flashMessage.success) {
        Swal.fire({
            html: flashMessage.success,
            icon: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Ok, got it!',
            customClass: {
                confirmButton: 'btn btn-primary',
            },
        });
    }

    if (flashMessage.error || Object.keys(usePage().props.errors).length > 0) {
        if (flashMessage.error) {
            Swal.fire({
                title: 'Server Error',
                html: flashMessage.error,
                icon: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Ok, got it!',
                customClass: {
                    confirmButton: 'btn btn-danger',
                },
            });
        } else {
            Swal.fire({
                title: 'Validation Error',
                html: Object.keys(usePage().props.errors),
                icon: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Ok, got it!',
                customClass: {
                    confirmButton: 'btn btn-danger',
                },
            });
        }
    }
});
</script>

<template>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <DashboardAside />
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <DashboardNavbar />
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <main>
                        <!-- Page Content -->
                        <div class="container-xxl flex-grow-1 container-p-y">
                            <slot />
                        </div>
                    </main>
                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div
                            class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column"
                        >
                            <div class="mb-2 mb-md-0">
                                ©
                                {{ getFullYear }}
                                , made with ❤️ by
                                <a
                                    href="https://themeselection.com"
                                    target="_blank"
                                    class="footer-link fw-medium"
                                    >ThemeSelection</a
                                >
                            </div>
                            <div class="d-none d-lg-inline-block">
                                <a
                                    href="https://themeselection.com/license/"
                                    class="footer-link me-4"
                                    target="_blank"
                                    >License</a
                                >
                                <a
                                    href="https://themeselection.com/"
                                    target="_blank"
                                    class="footer-link me-4"
                                    >More Themes</a
                                >

                                <a
                                    href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                                    target="_blank"
                                    class="footer-link me-4"
                                    >Documentation</a
                                >

                                <a
                                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                                    target="_blank"
                                    class="footer-link"
                                    >Support</a
                                >
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
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

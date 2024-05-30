<script setup>
import { ref } from 'vue';
import ApplicationLogo from './ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { usePermissions } from '@/Composables/UsePermissions';

const isOpen = ref(false);
const isActive = ref(false);
</script>

<template>
    <!-- Menu -->

    <aside
        id="layout-menu"
        class="layout-menu menu-vertical menu bg-menu-theme"
    >
        <ApplicationLogo position="left" class="py-3">
            <a class="layout-menu-toggle menu-link text-large ms-auto">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </ApplicationLogo>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li
                class="menu-item"
                :class="{
                    active: route().current('dashboard'),
                }"
                @click="isActive = true"
            >
                <Link class="menu-link" :href="route('dashboard')">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Dashboards">Dashboards</div>
                </Link>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Apps &amp; Pages</span>
            </li>
            <!-- Apps -->
            <li
                class="menu-item"
                :class="{
                    active: route().current('profile.edit'),
                }"
            >
                <Link :href="route('profile.edit')" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                    <div>Profile</div>
                </Link>
            </li>

            <li
                v-show="usePermissions('read_user')"
                class="menu-item"
                :class="{
                    active: route().current('user.index'),
                }"
            >
                <Link :href="route('user.index')" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div>Users</div>
                </Link>
            </li>

            <li
                v-show="usePermissions('delete_user')"
                class="menu-item"
                :class="{ open: isOpen }"
                @click="isOpen = !isOpen"
            >
                <a class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-check-shield"></i>
                    <div>Roles & Permissions</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a
                            href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/landing-page.html"
                            class="menu-link"
                            target="_blank"
                        >
                            <div>Roles</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a
                            href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/pricing-page.html"
                            class="menu-link"
                            target="_blank"
                        >
                            <div data-i18n="Pricing">Permissions</div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
    <!-- / Menu -->
</template>

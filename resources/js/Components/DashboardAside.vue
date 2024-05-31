<script setup>
import { ref } from 'vue';
import ApplicationLogo from './ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { usePermissions } from '@/Composables/UsePermissions';

const { can } = usePermissions();
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
                <span class="menu-header-text">Pages</span>
            </li>
            <!-- Apps -->

            <li class="menu-item">
                <Link
                    method="post"
                    as="link"
                    :href="route('logout')"
                    class="menu-link"
                >
                    <i class="menu-icon tf-icons bx bx-log-in-circle"></i>
                    <div>Login</div>
                </Link>
            </li>

            <li class="menu-item">
                <Link :href="route('register')" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-plus"></i>
                    <div>Register</div>
                </Link>
            </li>
            <li class="menu-item">
                <Link :href="route('password.request')" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-envelope"></i>
                    <div>Forgot Password</div>
                </Link>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Management</span>
            </li>
            <!-- Apps -->
            <li
                class="menu-item"
                :class="{
                    active: route().current('profile.edit'),
                }"
            >
                <Link :href="route('profile.edit')" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-fingerprint"></i>
                    <div>Profile</div>
                </Link>
            </li>

            <li
                v-show="can('read_user')"
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
                class="menu-item"
                v-show="can('read_role')"
                :class="{
                    active: route().current('role.index'),
                }"
            >
                <Link :href="route('role.index')" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-check-shield"></i>
                    <div>Roles</div>
                </Link>
            </li>
            <li
                class="menu-item"
                v-show="can('read_permission')"
                :class="{
                    active: route().current('permission.index'),
                }"
            >
                <Link :href="route('permission.index')" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                    <div>Permissions</div>
                </Link>
            </li>
        </ul>
    </aside>
    <!-- / Menu -->
</template>

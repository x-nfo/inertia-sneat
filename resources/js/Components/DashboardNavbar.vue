<script setup>
import { ref } from 'vue';
import { useDark, useToggle } from '@vueuse/core';
import { Link } from '@inertiajs/vue3';
import DashboardDropdown from '@/Components/DashboardDropdown.vue';

const isDark = useDark({
    selector: 'html',
    attribute: 'class',
    valueDark: 'dark-style',
    valueLight: 'light-style',
});
const toggleDark = useToggle(isDark);

let isShow = ref(false);
</script>

<template>
    <nav
        class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar"
    >
        <div
            class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none"
        >
            <a class="nav-item nav-link px-0 me-xl-4">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div
            class="navbar-nav-right d-flex align-items-center"
            id="navbar-collapse"
        >
            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input
                        type="text"
                        class="form-control border-0 shadow-none ps-1 ps-sm-2"
                        placeholder="Search..."
                        aria-label="Search..."
                    />
                </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Language -->

                <DashboardDropdown>
                    <template #trigger>
                        <i class="bx bx-globe bx-sm"></i>
                    </template>
                    <template #menu-item>
                        <li>
                            <a
                                class="dropdown-item active"
                                data-language="en"
                                data-text-direction="ltr"
                            >
                                <span class="align-middle">English</span>
                            </a>
                        </li>
                        <li>
                            <a
                                class="dropdown-item"
                                data-language="fr"
                                data-text-direction="ltr"
                            >
                                <span class="align-middle">French</span>
                            </a>
                        </li>
                    </template>
                </DashboardDropdown>

                <li
                    role="button"
                    class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0"
                >
                    <a
                        class="nav-link dropdown-toggle hide-arrow show"
                        @click="toggleDark()"
                    >
                        <i
                            class="bx bx-sm"
                            :class="`${isDark ? 'bx-moon' : 'bx-sun'}`"
                        ></i>
                    </a>
                </li>
                <!-- End of Theme Switcher -->

                <!-- User -->

                <DashboardDropdown>
                    <template #trigger
                        ><div class="avatar avatar-online">
                            <img
                                src="assets/img/avatars/1.png"
                                alt=""
                                class="w-px-40 h-auto rounded-circle"
                            /></div
                    ></template>
                    <template #menu-item>
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img
                                                src="assets/img/avatars/1.png"
                                                alt=""
                                                class="w-px-40 h-auto rounded-circle"
                                            />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-medium d-block">{{
                                            $page.props.auth.user.name.slice(
                                                0,
                                                12
                                            )
                                        }}</span>
                                        <small class="text-muted"
                                            >{{ $page.props.auth.role }}
                                        </small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <Link
                                :href="route('profile.edit')"
                                class="dropdown-item"
                                href="#"
                            >
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                            </Link>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <span
                                    class="d-flex align-items-center align-middle"
                                >
                                    <i
                                        class="flex-shrink-0 bx bx-credit-card me-2"
                                    ></i>
                                    <span class="flex-grow-1 align-middle ms-1"
                                        >Billing</span
                                    >
                                    <span
                                        class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20"
                                        >4</span
                                    >
                                </span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <Link
                                as="button"
                                method="post"
                                :href="route('logout')"
                                class="dropdown-item"
                            >
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </Link>
                        </li>
                    </template>
                </DashboardDropdown>
                <!--/ User -->
            </ul>
        </div>
    </nav>
</template>

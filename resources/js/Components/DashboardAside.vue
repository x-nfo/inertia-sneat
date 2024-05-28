<script setup>
import { ref } from 'vue';
import ApplicationLogo from './ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';

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
            <a
                class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none"
            >
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
                    <i class="menu-icon tf-icons bx bx-envelope"></i>
                    <div>Profile</div>
                </Link>
            </li>
            <!-- Components -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Components</span>
            </li>
            <!-- Cards -->
            <li class="menu-item">
                <a href="cards-basic.html" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Basic">Cards</div>
                </a>
            </li>
            <!-- Front Pages -->
            <li
                class="menu-item"
                :class="{ open: isOpen }"
                @click="isOpen = !isOpen"
            >
                <a class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-store"></i>
                    <div data-i18n="Front Pages">Front Pages</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a
                            href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/landing-page.html"
                            class="menu-link"
                            target="_blank"
                        >
                            <div data-i18n="Landing">Landing</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a
                            href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/pricing-page.html"
                            class="menu-link"
                            target="_blank"
                        >
                            <div data-i18n="Pricing">Pricing</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a
                            href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/payment-page.html"
                            class="menu-link"
                            target="_blank"
                        >
                            <div data-i18n="Payment">Payment</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a
                            href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/checkout-page.html"
                            class="menu-link"
                            target="_blank"
                        >
                            <div data-i18n="Checkout">Checkout</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a
                            href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/help-center-landing.html"
                            class="menu-link"
                            target="_blank"
                        >
                            <div data-i18n="Help Center">Help Center</div>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- User interface -->
            <li
                class="menu-item"
                :class="{ open: isOpen }"
                @click="isOpen = !isOpen"
            >
                <a class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-box"></i>
                    <div data-i18n="User interface">User interface</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="ui-accordion.html" class="menu-link">
                            <div data-i18n="Accordion">Accordion</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-alerts.html" class="menu-link">
                            <div data-i18n="Alerts">Alerts</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-badges.html" class="menu-link">
                            <div data-i18n="Badges">Badges</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-buttons.html" class="menu-link">
                            <div data-i18n="Buttons">Buttons</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-carousel.html" class="menu-link">
                            <div data-i18n="Carousel">Carousel</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-collapse.html" class="menu-link">
                            <div data-i18n="Collapse">Collapse</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-dropdowns.html" class="menu-link">
                            <div data-i18n="Dropdowns">Dropdowns</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-footer.html" class="menu-link">
                            <div data-i18n="Footer">Footer</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-list-groups.html" class="menu-link">
                            <div data-i18n="List Groups">List groups</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-modals.html" class="menu-link">
                            <div data-i18n="Modals">Modals</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-navbar.html" class="menu-link">
                            <div data-i18n="Navbar">Navbar</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-offcanvas.html" class="menu-link">
                            <div data-i18n="Offcanvas">Offcanvas</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a
                            href="ui-pagination-breadcrumbs.html"
                            class="menu-link"
                        >
                            <div data-i18n="Pagination &amp; Breadcrumbs">
                                Pagination &amp; Breadcrumbs
                            </div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-progress.html" class="menu-link">
                            <div data-i18n="Progress">Progress</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-spinners.html" class="menu-link">
                            <div data-i18n="Spinners">Spinners</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-tabs-pills.html" class="menu-link">
                            <div data-i18n="Tabs &amp; Pills">
                                Tabs &amp; Pills
                            </div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-toasts.html" class="menu-link">
                            <div data-i18n="Toasts">Toasts</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-tooltips-popovers.html" class="menu-link">
                            <div data-i18n="Tooltips & Popovers">
                                Tooltips &amp; popovers
                            </div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="ui-typography.html" class="menu-link">
                            <div data-i18n="Typography">Typography</div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
    <!-- / Menu -->
</template>

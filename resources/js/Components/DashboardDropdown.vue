<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

import { onClickOutside } from '@vueuse/core';

const emit = defineEmits(['trigger']);

const isShow = ref(false);

const closeOnEscape = (e) => {
    if (isShow.value && e.key === 'Escape') {
        isShow.value = false;
    }
};

const dropdown = ref(null);

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

onClickOutside(dropdown, () => (isShow.value = false));
</script>

<template>
    <li
        class="nav-item dropdown-language dropdown me-2 me-xl-0"
        @click="isShow = !isShow"
        ref="dropdown"
    >
        <a
            class="nav-link dropdown-toggle hide-arrow"
            :class="{ show: isShow }"
            data-bs-toggle="dropdown"
            :aria-expanded="isShow"
        >
            <slot name="trigger" />
        </a>
        <ul
            class="dropdown-menu dropdown-menu-end"
            :class="{ show: isShow }"
            :data-bs-popper="isShow == true ? 'static' : ''"
        >
            <slot name="menu-item" />
        </ul>
    </li>
</template>

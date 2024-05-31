<script setup>
const props = defineProps({
    id: {
        type: String,
    },
    title: {
        type: String,
    },
});
const emit = defineEmits(['close']);
</script>
<template>
    <div
        class="offcanvas offcanvas-end"
        :id="props.id"
        aria-modal="true"
        role="dialog"
        data-bs-scroll="true"
        tabindex="-1"
    >
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">
                {{ props.title }}
            </h5>
            <button
                type="button"
                class="btn-close text-reset"
                @click="emit('close')"
            ></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <slot />
        </div>
    </div>
</template>

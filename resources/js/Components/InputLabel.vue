<script setup>
defineProps({
    value: {
        type: String,
    },
    isRequired: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <label class="form-label">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>

        <span v-if="isRequired" class="text-danger">*</span>
    </label>
</template>

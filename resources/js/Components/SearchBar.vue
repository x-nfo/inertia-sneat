<script setup>
import { ref } from 'vue';

const input = ref(null);

const props = defineProps({
    modelValue: {
        required: true,
    },
});

const emit = defineEmits(['update:modelValue']);
</script>

<template>
    <div class="d-flex align-items-center position-relative">
        <input
            type="text"
            class="form-control form-control-solid w-250px ps-14"
            placeholder="Search"
            @input="$emit('update:modelValue', $event.target.value)"
            ref="input"
            name="search"
        />
    </div>
</template>

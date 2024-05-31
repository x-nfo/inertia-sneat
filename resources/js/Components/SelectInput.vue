<script setup>
import { ref } from 'vue';

const props = defineProps(['modelValue', 'dataSet']);

const emit = defineEmits(['update:modelValue']);

const input = ref(null);
</script>

<template>
    <select
        class="form-select form-select-solid"
        :value="props.modelValue"
        @input="emit('update:modelValue', $event.target.value)"
        ref="input"
    >
        <option
            v-for="(data, index) in dataSet"
            :key="index"
            :value="data.value"
        >
            {{ data.label }}
        </option>
    </select>
</template>

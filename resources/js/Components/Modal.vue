<script setup>
const props = defineProps({
    id: { type: String, required: true },
    size: { type: String, default: null },
});

const emit = defineEmits(['close']);
</script>

<template>
    <div class="modal fade" tabindex="-1" :id="props.id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <slot name="title" />
                    </div>
                    <div>
                        <button
                            type="button"
                            class="btn-close"
                            @click="emit('close')"
                        ></button>
                    </div>
                </div>
                <div class="modal-body">
                    <slot name="body" />
                </div>

                <div class="modal-footer">
                    <slot name="footer" />
                </div>
            </div>
        </div>
    </div>
</template>

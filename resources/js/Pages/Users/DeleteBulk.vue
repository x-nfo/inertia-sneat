<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, watchEffect } from 'vue';

const passwordInput = ref(null);

const props = defineProps({
    show: Boolean,
    selectedId: Object,
});

const emit = defineEmits(['close', 'open']);

const form = useForm({
    id: [],
    password: '',
});

const deleteBulk = () => {
    form.post(route('user.destroy-bulk'), {
        preserveScroll: true,
        onSuccess: () => emit('close'),
        onFinish: () => form.reset(),
    });
};

watchEffect(() => {
    if (props.show) {
        form.id = props.selectedId;
    }
});
</script>

<template>
    <div>
        <div class="d-flex gap-2 align-items-center">
            <span class="font-bold"
                >{{ props.selectedId?.length }} Selected
            </span>
            <DangerButton @click="emit('open')"> Delete Selected </DangerButton>
        </div>

        <Modal id="deleteBulkUser" @close="emit('close')">
            <template #title>
                <h5 class="text-xl">
                    Are you sure you want to delete
                    {{ props.selectedId?.length }} user ?
                </h5>
            </template>
            <template #body>
                <p class="text-sm text-muted">
                    Once is deleted, all of its resources and data will be
                    permanently deleted. Please enter your password to confirm
                    you would like to permanently delete.
                </p>

                <div class="mt-6">
                    <InputLabel
                        for="password"
                        value="Password"
                        class="sr-only"
                    />

                    <TextInput
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="Password"
                        @keyup.enter="deleteBulk"
                    />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>
            </template>
            <template #footer>
                <SecondaryButton @click="emit('close')">
                    Cancel
                </SecondaryButton>

                <DangerButton
                    class="ms-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="deleteBulk"
                >
                    Delete Account
                </DangerButton>
            </template>
        </Modal>
    </div>
</template>

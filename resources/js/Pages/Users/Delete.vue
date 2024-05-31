<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    show: Boolean,
    user: Object,
});

const emit = defineEmits(['close', 'open']);

const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const deleteUser = () => {
    form.delete(route('user.destroy', props.user?.id), {
        preserveScroll: true,
        onSuccess: () => emit('close'),
        onError: () => passwordInput.value.facus(),
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <div>
        <div class="btn btn-sm btn-icon delete-record" @click="emit('open')">
            <i class="bx bx-trash"></i>
        </div>

        <Modal id="deleteUser" @close="emit('close')">
            <template #title>
                <h5 class="text-xl">
                    Are you sure you want to delete {{ props.user?.name }}?
                </h5>
            </template>
            <template #body>
                <p class="text-sm text-muted">
                    Once {{ props.user?.name }} is deleted, all of its resources
                    and data will be permanently deleted. Please enter your
                    password to confirm you would like to permanently delete
                    {{ props.user?.name }}.
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
                    @click="deleteUser"
                >
                    Delete Account
                </DangerButton>
            </template>
        </Modal>
    </div>
</template>

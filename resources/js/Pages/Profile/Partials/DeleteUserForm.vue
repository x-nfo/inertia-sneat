<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref, onMounted, onUnmounted, watchEffect } from 'vue';
import { useModal } from '@/Composables/UseModal';

const modal = ref(null);

onMounted(() => {
    modal.value = useModal('#deleteUserId');
});

const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const openModal = () => {
    modal.value.show();
};

const closeModal = () => {
    modal.value.hide();
    form.reset();
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

onUnmounted(() => {
    closeModal();
});
</script>

<template>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Delete Account</h2>

            <p class="mt-1 text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will
                be permanently deleted. Before deleting your account, please
                download any data or information that you wish to retain.
            </p>
        </header>

        <DangerButton @click="openModal">Delete Account</DangerButton>

        <Modal id="deleteUserId" @close="closeModal">
            <template #title>
                <h5 class="text-xl">
                    Are you sure you want to delete your account?
                </h5>
            </template>
            <template #body>
                <p class="text-sm">
                    Once your account is deleted, all of its resources and data
                    will be permanently deleted. Please enter your password to
                    confirm you would like to permanently delete your account.
                </p>
                <div class="mt-6">
                    <InputLabel
                        for="password"
                        value="Password"
                        class="sr-only"
                    />

                    <TextInput
                        id="password"
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
                <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

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
    </section>
</template>

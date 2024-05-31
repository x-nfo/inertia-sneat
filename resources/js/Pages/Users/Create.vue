<script setup>
import { onMounted, onUnmounted, ref, watchEffect } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import { useForm } from '@inertiajs/vue3';
import Offcanvas from '@/Components/Offcanvas.vue';
import { useOffcanvas } from '@/Composables/UseOffcanvas';

const offcanvas = ref(null);
onMounted(() => {
    offcanvas.value = useOffcanvas('#createUser');
});

const props = defineProps({
    roles: Object,
});

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: 'operator',
});

const openOffcanvas = () => {
    offcanvas.value.show();

    form.reset();
};

const closeOffcanvas = () => {
    offcanvas.value.hide();
    form.reset();
};

const createNewUser = () => {
    form.post(route('user.store'), {
        preserveScroll: true,
        onSuccess: () => {
            closeOffcanvas();
            form.reset();
        },
        onFinish: () => form.reset(),
    });
};

const roles = props.roles?.map((role) => ({
    label: role.name,
    value: role.name,
}));

onUnmounted(() => {
    closeOffcanvas();
});
</script>

<template>
    <!-- Button -->
    <PrimaryButton @click="openOffcanvas">
        <i class="bx bx-plus me-sm-1"></i>
        <span class="d-none d-sm-inline-block">Add New Record</span>
    </PrimaryButton>
    <!-- End of Button -->

    <Offcanvas id="createUser" title="New Record" @close="closeOffcanvas">
        <div
            class="add-new-record pt-0 row g-2 fv-plugins-bootstrap5 fv-plugins-framework"
        >
            <div class="col-sm-12 fv-plugins-icon-container">
                <InputLabel for="name" value="Full Name" :required="true" />
                <TextInput
                    v-model="form.name"
                    id="name"
                    type="text"
                    placeholder="Full Name"
                />
                <InputError :message="form.errors.name" />
            </div>

            <div class="mb-3 col-sm-12 fv-plugins-icon-container">
                <InputLabel for="email" value="Email" :required="true" />
                <TextInput
                    v-model="form.email"
                    id="email"
                    type="email"
                    placeholder="example@domain.com"
                />
                <InputError :message="form.errors.email" />
            </div>

            <div class="mb-3 col-sm-12 fv-plugins-icon-container">
                <InputLabel for="password" value="Password" :required="true" />
                <TextInput
                    v-model="form.password"
                    id="password"
                    type="password"
                    placeholder="Password"
                />
                <InputError :message="form.errors.password" />
            </div>
            <div class="mb-3 col-sm-12 fv-plugins-icon-container">
                <InputLabel
                    for="password_confirmation"
                    value="Password Confirmation"
                    :required="true"
                />
                <TextInput
                    v-model="form.password_confirmation"
                    id="password_confirmation"
                    type="password"
                    placeholder="Password Confirmation"
                />
                <InputError :message="form.errors.password" />
            </div>
            <div class="mb-3 col-sm-12 fv-plugins-icon-container">
                <InputLabel for="role" value="Role" :isRequired="true" />
                <SelectInput
                    id="role"
                    class="mt-1 block w-full"
                    v-model="form.role"
                    required
                    :dataSet="roles"
                >
                </SelectInput>
                <InputError class="mt-2" :message="form.errors.role" />
            </div>
            <div class="mb-3 d-flex gap-2 col-sm-12">
                <PrimaryButton
                    type="submit"
                    @click="createNewUser"
                    :disabled="form.processing"
                    :class="{ 'opacity-25': form.processing }"
                >
                    Submit
                </PrimaryButton>
                <button
                    type="reset"
                    class="btn btn-outline-secondary"
                    @click="closeOffcanvas"
                >
                    Cancel
                </button>
            </div>
        </div>
    </Offcanvas>
</template>

<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import Offcanvas from '@/Components/Offcanvas.vue';
import { useForm } from '@inertiajs/vue3';
import { watchEffect } from 'vue';

const props = defineProps({
    show: Boolean,
    roles: Object,
});

const emit = defineEmits(['close', 'open']);

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: 'operator',
});

const createNewUser = () => {
    form.post(route('user.store'), {
        preserveScroll: true,
        onSuccess: () => {
            emit('close');
            form.reset();
        },
        onFinish: () => form.reset(),
    });
};

watchEffect(() => {
    if (props.show) {
        form.errors = {};
    }
});

const roles = props.roles?.map((role) => ({
    label: role.name,
    value: role.name,
}));
</script>

<template>
    <div>
        <!-- Button -->
        <PrimaryButton @click="emit('open')">
            <i class="bx bx-plus me-sm-1"></i>
            <span class="d-none d-sm-inline-block">Add New Record</span>
        </PrimaryButton>
        <!-- End of Button -->

        <Offcanvas id="createUser" title="New Record" @close="emit('close')">
            <div
                class="add-new-record pt-0 row g-2 fv-plugins-bootstrap5 fv-plugins-framework"
            >
                <div class="col-sm-12 fv-plugins-icon-container">
                    <InputLabel for="name" value="Full Name" :required="true" />
                    <TextInput
                        v-model="form.name"
                        type="text"
                        placeholder="Full Name"
                    />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="mb-3 col-sm-12 fv-plugins-icon-container">
                    <InputLabel for="email" value="Email" :required="true" />
                    <TextInput
                        v-model="form.email"
                        type="email"
                        placeholder="example@domain.com"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="mb-3 col-sm-12 fv-plugins-icon-container">
                    <InputLabel
                        for="password"
                        value="Password"
                        :required="true"
                    />
                    <TextInput
                        v-model="form.password"
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
                        type="password"
                        placeholder="Password Confirmation"
                    />
                    <InputError :message="form.errors.password" />
                </div>
                <div class="mb-3 col-sm-12 fv-plugins-icon-container">
                    <InputLabel for="role" value="Role" :isRequired="true" />
                    <SelectInput
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
                        @click="emit('close')"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </Offcanvas>
    </div>
</template>

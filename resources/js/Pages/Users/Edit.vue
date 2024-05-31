<script setup>
import { onMounted, onUnmounted, ref, watchEffect } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import { useForm } from '@inertiajs/vue3';
import Offcanvas from '@/Components/Offcanvas.vue';

const props = defineProps({
    show: Boolean,
    user: Object,
    roles: Object,
});

const emit = defineEmits(['open', 'close']);

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: '',
});

const update = () => {
    form.put(route('user.update', props.user?.id), {
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
        form.name = props.user?.name;
        form.email = props.user?.email;
        form.role = props.user?.roles == 0 ? '' : props.user?.roles[0].name;
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
        <div @click="emit('open')" class="btn btn-sm btn-icon">
            <i class="bx bx-edit"></i>
        </div>

        <Offcanvas id="editUser" title="Edit Record" @close="emit('close')">
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
                        @click="update"
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

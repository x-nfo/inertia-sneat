<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <!-- /Logo -->
        <h4 class="mb-2">Welcome to Sneat! 👋</h4>
        <p class="mb-4">
            Please sign-in to your account and start the adventure
        </p>

        <form @submit.prevent="submit" class="mb-3">
            <div class="mb-3">
                <InputLabel for="email" value="Email or Username" />

                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Enter your email or username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between align-items-center">
                    <InputLabel for="password" value="Password" />
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="mb-1"
                    >
                        <small>Forgot your password?</small>
                    </Link>
                </div>

                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mb-3">
                <label class="d-flex gap-1 align-items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                    class="d-grid w-100"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Sign in
                </PrimaryButton>
            </div>
        </form>
        <p class="text-center">
            <span>New on our platform?</span>
            <Link :href="route('register')">
                <span> Create an account</span>
            </Link>
        </p>
    </GuestLayout>
</template>

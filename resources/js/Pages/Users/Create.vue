<script setup>
import { ref, watchEffect } from 'vue';

const emit = defineEmits(['openOffcanvas']);
const props = defineProps({
    isOpen: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <!-- Button -->
    <div class="btn create-new btn-primary" @click="emit('openOffcanvas')">
        <i class="bx bx-plus me-sm-1"></i>
        <span class="d-none d-sm-inline-block">Add New Record</span>
    </div>

    <!-- End of Button -->

    <div
        class="offcanvas offcanvas-end"
        :class="{ show: props.isOpen }"
        id="add-new-record"
        aria-modal="true"
        role="dialog"
    >
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5>
            <button
                type="button"
                class="btn-close text-reset"
                @click="emit('openOffcanvas')"
                aria-label="Close"
            ></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form
                class="add-new-record pt-0 row g-2 fv-plugins-bootstrap5 fv-plugins-framework"
                novalidate="novalidate"
            >
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicFullname"
                        >Full Name</label
                    >
                    <div class="input-group input-group-merge has-validation">
                        <span id="basicFullname2" class="input-group-text"
                            ><i class="bx bx-user"></i
                        ></span>
                        <input
                            type="text"
                            id="basicFullname"
                            class="form-control dt-full-name"
                            name="basicFullname"
                            placeholder="John Doe"
                            aria-label="John Doe"
                            aria-describedby="basicFullname2"
                        />
                    </div>
                    <div
                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"
                    ></div>
                </div>

                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicEmail">Email</label>
                    <div class="input-group input-group-merge has-validation">
                        <span class="input-group-text"
                            ><i class="bx bx-envelope"></i
                        ></span>
                        <input
                            type="text"
                            id="basicEmail"
                            name="basicEmail"
                            class="form-control dt-email"
                            placeholder="john.doe@example.com"
                            aria-label="john.doe@example.com"
                        />
                    </div>
                </div>

                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="basicSalary">Role</label>
                    <div class="input-group input-group-merge has-validation">
                        <span id="basicSalary2" class="input-group-text"
                            ><i class="bx bx-dollar"></i
                        ></span>
                        <input
                            type="number"
                            id="basicSalary"
                            name="basicSalary"
                            class="form-control dt-salary"
                            placeholder="12000"
                            aria-label="12000"
                            aria-describedby="basicSalary2"
                        />
                    </div>
                    <div
                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"
                    ></div>
                </div>
                <div class="col-sm-12">
                    <button
                        type="submit"
                        class="btn btn-primary data-submit me-sm-3 me-1"
                    >
                        Submit
                    </button>
                    <button
                        type="reset"
                        class="btn btn-outline-secondary"
                        @click="emit('openOffcanvas')"
                    >
                        Cancel
                    </button>
                </div>
                <input type="hidden" />
            </form>
        </div>
    </div>
</template>

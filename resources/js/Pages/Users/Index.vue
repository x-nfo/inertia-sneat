<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import { computed, ref, reactive, watch } from 'vue';
import { cloneDeep, debounce, pickBy } from 'lodash';
import Checkbox from '@/Components/Checkbox.vue';
import Dropdown from '@/Components/Dropdown.vue';
import Pagination from '@/Components/Pagination.vue';
import SearchBar from '@/Components/SearchBar.vue';
import SelectInput from '@/Components/SelectInput.vue';

import Create from './Create.vue';
import { usePermissions } from '@/Composables/UsePermissions';

const props = defineProps({
    users: Object,
    filters: Object,
    perPage: Number,
    roles: Object,
});

const data = reactive({
    params: {
        search: props.filters.search,
        field: props.filters.field,
        order: props.filters.order,
        perPage: props.perPage,
    },
    user: null,
    dataSet: usePage().props.app.perpage,
    selectedId: [],
    isMultiple: false,
});

const order = (request) => {
    data.params.field = request;
    data.params.order = data.params.order === 'asc' ? 'desc' : 'asc';
};

watch(
    () => cloneDeep(data.params),
    debounce(() => {
        let param = pickBy(data.params);

        router.get(route('user.index'), param, {
            replace: true,
            preserveState: true,
            preserveScroll: true,
        });
    }, 150)
);

const selectAll = (event) => {
    if (event.target.checked === false) {
        data.selectedId = [];
    } else {
        props.users?.data.forEach((user) => {
            data.selectedId.push(user.id);
        });
    }
};

const select = () => {
    if (props.users?.data.length == data.selectedId.length) {
        data.isMultiple = true;
    } else {
        data.isMultiple = false;
    }
};

const getBadgeClasses = (roleName) => {
    return roleName == 'superadmin'
        ? 'bg-label-success'
        : roleName == 'admin'
        ? 'bg-label-primary'
        : 'bg-label-warning';
};

const { can } = usePermissions();
</script>

<template>
    <Head title="User" />
    <AuthenticatedLayout>
        <!-- Create new record -->
        <!-- Create new record -->
        <div class="card">
            <div
                class="card-header d-flex align-items-center justify-content-between d-flex-md-row"
            >
                <div class="card-title d-flex gap-2">
                    <!--begin::Select PerPage-->
                    <div>
                        <SelectInput
                            name="select_perpage"
                            v-model="data.params.perPage"
                            :data-set="data.dataSet"
                        />
                    </div>
                    <!--end::Select PerPage-->

                    <!--begin::Search-->
                    <div class="w-70">
                        <SearchBar v-model="data.params.search" />
                    </div>
                    <!--end::Search-->
                </div>
                <div class="pt-md-0">
                    <div class="btn-group flex-wrap">
                        <Create :roles="props.roles" />
                    </div>
                </div>
            </div>
            <div class="card-body">
                <Dropdown />
                <table class="table">
                    <thead>
                        <tr>
                            <td>
                                <div>
                                    <Checkbox
                                        v-model:checked="data.isMultiple"
                                        @change="selectAll"
                                    />
                                </div>
                            </td>
                            <th @click="order('name')">
                                <div class="d-flex justify-content-between">
                                    <div>Name</div>

                                    <div>
                                        <i
                                            v-show="
                                                data.params.field === 'name' &&
                                                data.params.order === 'asc'
                                            "
                                            class="bx bx-chevron-up"
                                        ></i>
                                        <i
                                            v-show="
                                                data.params.field === 'name' &&
                                                data.params.order === 'desc'
                                            "
                                            class="bx bx-chevron-down"
                                        ></i>
                                    </div>
                                </div>
                            </th>
                            <th @click="order('email')">
                                <div class="d-flex justify-content-between">
                                    <div>Email</div>
                                    <div>
                                        <i
                                            v-show="
                                                data.params.field === 'email' &&
                                                data.params.order === 'asc'
                                            "
                                            class="bx bx-chevron-up"
                                        ></i>
                                        <i
                                            v-show="
                                                data.params.field === 'email' &&
                                                data.params.order === 'desc'
                                            "
                                            class="bx bx-chevron-down"
                                        ></i>
                                    </div>
                                </div>
                            </th>
                            <th @click="order('role')">Role</th>
                            <th @click="order('created_at')">
                                <div class="d-flex justify-content-between">
                                    <div>Joint Date</div>
                                    <div>
                                        <i
                                            v-show="
                                                data.params.field ===
                                                    'created_at' &&
                                                data.params.order === 'asc'
                                            "
                                            class="bx bx-chevron-up"
                                        ></i>
                                        <i
                                            v-show="
                                                data.params.field ===
                                                    'created_at' &&
                                                data.params.order === 'desc'
                                            "
                                            class="bx bx-chevron-down"
                                        ></i>
                                    </div>
                                </div>
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(user, index) in props.users.data"
                            :key="index"
                        >
                            <td>
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    :value="user.id"
                                    @change="select"
                                    v-model="data.selectedId"
                                />
                            </td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>
                                <span
                                    class="badge"
                                    :class="getBadgeClasses(user.roles[0].name)"
                                    >{{ user.roles[0].name }}</span
                                >
                            </td>
                            <td>{{ user.created_at }}</td>
                            <td class="d-flex">
                                <div
                                    v-show="can('read_user')"
                                    class="btn btn-sm btn-icon dropdown-toggle hide-arrow"
                                >
                                    <i
                                        class="bx bx-dots-vertical-rounded me-2"
                                    ></i>
                                </div>
                                <div
                                    v-show="can('update_user')"
                                    class="btn btn-sm btn-icon"
                                >
                                    <i class="bx bx-edit"></i>
                                </div>

                                <div
                                    v-show="can('delete_user')"
                                    class="btn btn-sm btn-icon delete-record"
                                >
                                    <i class="bx bx-trash"></i>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-4">
                    <Pagination :links="props.users" :filters="data.params" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

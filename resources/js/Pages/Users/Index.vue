<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import { computed, ref, reactive, watch } from 'vue';
import { cloneDeep, debounce, pickBy } from 'lodash';
import Checkbox from '@/Components/Checkbox.vue';
import Dropdown from '@/Components/Dropdown.vue';
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
    createModal: false,
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

const toggleOffcanvas = () => (data.createModal = !data.createModal);

const { can } = usePermissions();
</script>

<template>
    <Head title="User" />
    <AuthenticatedLayout>
        <!-- Create new record -->
        <!-- Create new record -->
        <div class="card">
            <div class="card-header flex align-items-center flex-md-row">
                <div class="head-label">
                    <h5 class="card-title">User</h5>
                </div>
                <div class="text-end pt-md-0">
                    <div class="btn-group flex-wrap">
                        <Create
                            :isOpen="data.createModal"
                            @openOffcanvas="toggleOffcanvas"
                        />
                    </div>
                </div>
            </div>
            <div class="card-body">
                <Dropdown />
                <table class="table">
                    <thead>
                        <tr>
                            <th><Checkbox /></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Joint Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr
                            v-for="(user, index) in props.users.data"
                            :key="index"
                        >
                            <td><Checkbox /></td>
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
            </div>
        </div>
    </AuthenticatedLayout>
</template>

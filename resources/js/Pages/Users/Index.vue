<script setup>
import { Head, router, usePage } from '@inertiajs/vue3';
import { reactive, watch, onMounted, onUnmounted } from 'vue';
import { cloneDeep, debounce, pickBy } from 'lodash';
import { usePermissions } from '@/Composables/UsePermissions';
import { useOffcanvas } from '@/Composables/UseOffcanvas';
import { useModal } from '@/Composables/UseModal';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Pagination from '@/Components/Pagination.vue';
import SearchBar from '@/Components/SearchBar.vue';
import SelectInput from '@/Components/SelectInput.vue';
import Create from './Create.vue';
import Edit from './Edit.vue';
import Delete from './Delete.vue';
import DeleteBulk from './DeleteBulk.vue';

const modal = reactive({
    isDeleteOpen: false,
    isDeleteBulkOpen: false,
    deleteId: null,
    deleteBulkUser: null,
});

const offcanvas = reactive({
    isCreateOpen: false,
    isEditOpen: false,
    createId: '',
    editId: '',
});

onMounted(() => {
    offcanvas.createId = useOffcanvas('#createUser');
    offcanvas.editId = useOffcanvas('#editUser');
    modal.deleteId = useModal('#deleteUser');
    modal.deleteBulkUser = useModal('#deleteBulkUser');
});

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

const openModal = (id) => {
    switch (id) {
        case 'delete':
            modal.deleteId.show();
            modal.isDeleteOpen = true;
            break;
        case 'deleteBulk':
            modal.deleteBulkUser.show();
            modal.isDeleteBulkOpen = true;
            break;
    }
};

const closeModal = (id) => {
    switch (id) {
        case 'delete':
            modal.deleteId.hide();
            modal.isDeleteOpen = false;
            break;
        case 'deleteBulk':
            modal.deleteBulkUser.hide();
            modal.isDeleteBulkOpen = false;
            data.isMultiple = false;
            data.selectedId = [];
            break;
    }
};

const openOffcanvas = (id) => {
    switch (id) {
        case 'create':
            offcanvas.createId.show();
            offcanvas.isCreateOpen = true;
            break;
        case 'edit':
            offcanvas.editId.show();
            offcanvas.isEditOpen = true;
            break;
    }
};

const closeOffcanvas = (id) => {
    switch (id) {
        case 'create':
            offcanvas.createId.hide();
            offcanvas.isCreateOpen = false;
            break;
        case 'edit':
            offcanvas.editId.hide();
            offcanvas.isEditOpen = false;
            break;
    }
};

onUnmounted(() => {
    closeOffcanvas('create');
    closeOffcanvas('edit');
    closeModal('delete');
    closeModal('deleteBulk');
});

const { isSuperAdmin, hasPermission, can } = usePermissions();

console.log('ini super Admin' + ' ' + isSuperAdmin);
// console.log('type of super Admin' + ' ' + typeof isSuperAdmin);
console.log('ini hasPermission ' + ' ' + hasPermission('delete_user'));
// console.log(
//     'type of hasPermission ' + ' ' + typeof hasPermission('create_user')
// );
// console.log('type of can ' + ' ' + typeof can('create_user'));
console.log('ini can ' + ' ' + can('delete_user'));
</script>

<template>
    <Head title="User" />
    <AuthenticatedLayout>
        <!-- Create new record -->
        <div class="card">
            <div class="card-datatable">
                <div class="dataTables_wrapper dt-bootstrap5">
                    <div class="row">
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
                                <DeleteBulk
                                    v-show="
                                        data.selectedId.length != 0 &&
                                        can('delete_user')
                                    "
                                    :show="modal.isDeleteBulkOpen"
                                    :selectedId="data.selectedId"
                                    @open="openModal('deleteBulk')"
                                    @close="closeModal('deleteBulk')"
                                />
                                <Create
                                    v-show="
                                        data.selectedId.length == 0 &&
                                        can('create_user')
                                    "
                                    :show="offcanvas.isCreateOpen"
                                    :roles="props.roles"
                                    @open="openOffcanvas('create')"
                                    @close="closeOffcanvas('create')"
                                />
                            </div>
                        </div>
                    </div>
                    <table class="dt-row-grouping table dataTable dtr-column">
                        <thead>
                            <tr>
                                <td v-show="can('delete_user')">
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
                                                    data.params.field ===
                                                        'name' &&
                                                    data.params.order === 'asc'
                                                "
                                                class="bx bx-chevron-up"
                                            ></i>
                                            <i
                                                v-show="
                                                    data.params.field ===
                                                        'name' &&
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
                                                    data.params.field ===
                                                        'email' &&
                                                    data.params.order === 'asc'
                                                "
                                                class="bx bx-chevron-up"
                                            ></i>
                                            <i
                                                v-show="
                                                    data.params.field ===
                                                        'email' &&
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
                                <td v-show="can('delete_user')">
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
                                        :class="
                                            getBadgeClasses(user.roles[0].name)
                                        "
                                        >{{ user.roles[0].name }}</span
                                    >
                                </td>
                                <td>{{ user.created_at }}</td>
                                <td class="d-flex">
                                    <Edit
                                        v-show="can('update_user')"
                                        :show="offcanvas.isEditOpen"
                                        :user="data?.user"
                                        :roles="props.roles"
                                        @open="
                                            openOffcanvas('edit'),
                                                (data.user = user)
                                        "
                                        @close="closeOffcanvas('edit')"
                                    />

                                    <Delete
                                        v-show="can('delete_user')"
                                        :show="modal.isDeleteOpen"
                                        :user="data?.user"
                                        @open="
                                            openModal(
                                                'delete',
                                                (data.user = user)
                                            )
                                        "
                                        @close="closeModal('delete')"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row px-3">
                        <Pagination
                            :links="props.users"
                            :filters="data.params"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

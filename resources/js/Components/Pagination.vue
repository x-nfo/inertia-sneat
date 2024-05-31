<script setup>
import { router } from '@inertiajs/vue3';
import { pickBy } from 'lodash';
import { reactive, watchEffect } from 'vue';

const props = defineProps({
    links: Object,
    filters: Object,
});

const data = reactive({
    params: {
        search: props.filters?.search,
        field: props.filters?.field,
        order: props.filters?.order,
        perPage: props.filters?.perPage,
    },
});

const goto = (link) => {
    let params = pickBy(data.params);
    router.get(link, params, {
        replace: true,
        preserveState: true,
        preserveScroll: true,
    });
};

watchEffect(() => {
    data.params.search = props.filters?.search;
    data.params.field = props.filters?.field;
    data.params.order = props.filters?.order;
    data.params.perPage = props.filters?.perPage;
});
</script>

<template>
    <div
        v-if="links.data.length != 0"
        class="d-flex justify-content-between perpage"
    >
        <div class="dataTables_info">
            <span class="me-3">Show</span>
            <span class="">{{ links.from }}</span>
            <span class="mx-1"> -</span>
            <span>{{ links.to }}</span>
            <span class="mx-2"> of </span>
            <span>{{ links.total }}</span>
        </div>
        <div
            v-if="links.links.length > 3"
            class="dataTables_paginate paging_simple_numbers"
        >
            <ul class="pagination">
                <li
                    class="paginate_button page-item"
                    v-for="(link, index) in links.links"
                    :key="index"
                    :class="{ active: link.active, disabled: link.url == null }"
                >
                    <a
                        class="page-link fs-6"
                        @click="goto(link.url)"
                        v-html="link.label"
                    ></a>
                </li>
            </ul>
        </div>
    </div>
    <div v-else class="text-center py-5 text-muted font-weight-bold">
        <i class="bx bx-search fs-1"></i>
        <p class="mt-3">No matching records found</p>
    </div>
</template>

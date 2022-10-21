<template>
    <Layout>
        <Head title="Cuentas" />

        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center">
                <h1 class="text-3xl">Cuentas</h1>

                <Link
                    v-if="can.createAccount"
                    href="/accounts/create"
                    class="text-blue-500 text-sm ml-3"
                >Nueva Cuenta</Link
                >
            </div>

            <input
                v-model="search"
                type="text"
                placeholder="Buscar..."
                class="border px-2 rounded-lg"
            />
        </div>

        <Table>
            <tr v-for="account in accounts.data" :key="account.id">
                <TableItem>
                    <Link :href="'/accounts/' + account.id">
                        {{ account.description }}
                    </Link>
                </TableItem>
                <TableItem>
                    {{ account.alias }}
                </TableItem>
                <TableItem>
                    {{ account.cbu }}
                </TableItem>
                <TableItem>
                    <Link
                        v-if="account.can.edit"
                        :href="`/accounts/${account.id}/edit`"
                        class="text-indigo-600 hover:text-indigo-900"
                    >
                        Editar
                    </Link>
                </TableItem>
            </tr>
        </Table>
        <Pagination :links="accounts.links" class="mt-6" />

    </Layout>
</template>

<script setup>

import Layout from "../../Shared/Layout";
import Pagination from "../../Shared/Pagination";
import Table from "../../Shared/Table";
import TableItem from "../../Shared/TableItem";
import {ref, watch} from "vue";
import {debounce} from "lodash";
import {Inertia} from "@inertiajs/inertia";

let props = defineProps({
    accounts: Object,
    filters: Object,
    can: Object,
});

let search = ref(props.filters.search);

watch(
    search,
    debounce(function (value) {
        Inertia.get(
            "/accounts",
            { search: value },
            {
                preserveState: true,
                replace: true,
            }
        );
    }, 300)
);
</script>

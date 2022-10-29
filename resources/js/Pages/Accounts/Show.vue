<template>
    <Layout>
        <Head title="Cuenta" />

        <div class="flex justify-between items-center mb-6">
            <div class="flex items-baseline">
                <h1 class="text-3xl">Cuenta</h1>

                <Link :href="'/accounts/' + account.id + '?mes=' + this.prevMonth() + '&anio=' + this.prevYear()" class="text-sm ml-4">&laquo;</Link>
                <span class="text-sm ml-2">Período {{ month }}/{{ year }}</span>
                <Link :href="'/accounts/' + account.id + '?mes=' + this.nextMonth() + '&anio=' + this.nextYear()" class="text-sm ml-2">&raquo;</Link>
            </div>
        </div>

        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ account.description }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Alias</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ account.alias }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">CBU</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ account.cbu }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Banco</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ bank.name }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tipo de Cuenta</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ accountType.name }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Moneda</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ currency.name }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="flex items-baseline my-6">
            <h1 class="text-3xl">Movimientos</h1>

            <Link
                :href="'/accounts/' + account.id + '/spends/create'"
                class="text-blue-500 text-sm ml-3"
            >Nuevo Movimiento</Link
            >

        </div>

        <Table>
            <tr v-for="accountSpend in spends.data" :key="accountSpend.id">
                <TableItem>
                    {{ accountSpend.description }}
                </TableItem>
                <TableItem>
                    <span :class="(accountSpend.movement_id === 2) ? 'text-red-500' : 'text-green-700'">{{ currency.sign }} {{ accountSpend.movement_id === 2 ? '-' : '' }}{{ accountSpend.amount }}</span>
                </TableItem>
            </tr>
        </Table>

        <Pagination :links="spends.links" class="mt-6" />
    </Layout>
</template>

<script setup>
import Pagination from "../../Shared/Pagination";
import Layout from "../../Shared/Layout";
import Table from "../../Shared/Table";
import TableItem from "../../Shared/TableItem";

let props = defineProps({
    account: Object,
    bank: Object,
    currency: Object,
    accountType: Object,
    spends: Object,
    month: Number,
    year: Number,
    filters: Object
});

let nextMonth = () => {
    if (props.month < 12){
        let next = props.month;
        next ++;
        return next;
    } else {
        return 1
    }
}

let prevMonth = () => {
    if (props.month > 1){
        let prev = props.month;
        prev --;
        return prev;
    } else {
        return 12
    }
}

let nextYear = () => {
    if (props.month < 12){
        return props.year;
    } else {
        let next = props.year;
        next ++;
        return next;
    }
}

let prevYear = () => {
    if (props.month > 1){
        return props.year;
    } else {
        let prev = props.year;
        prev --;
        return prev;
    }
}

</script>

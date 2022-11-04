<template>
    <Layout>
        <Head title="Cuenta" />

        <div class="flex justify-between items-center mb-6">
            <div class="flex items-baseline sm:-mx-2">
                <h1 class="text-3xl">{{ account.description }}</h1>

                <Link
                    :href="'/account_cycle/' + prevAccountCycle.id"
                    class="text-sm ml-4"
                >&laquo;</Link>
                <span class="text-sm ml-2">Período {{ accountCycle.month }}/{{ accountCycle.year }}</span>
                <Link
                    :href="'/account_cycle/' + nextAccountCycle.id"
                    class="text-sm ml-2"
                >&raquo;</Link
                >
            </div>
        </div>

        <View>
            <ViewItem title="Nombre">{{ account.description }}</ViewItem>
            <ViewItem title="Alias">{{ account.alias }}</ViewItem>
            <ViewItem title="CBU">{{ account.cbu }}</ViewItem>
            <ViewItem title="Banco">{{ bank.name }}</ViewItem>
            <ViewItem title="Tipo de Cuenta">{{ accountType.name }}</ViewItem>
            <ViewItem title="Moneda">{{ currency.name }}</ViewItem>
            <ViewItem title="Totales">
                {{ currency.sign }} <span :class="(props.total < 0) ? 'text-red-500 font-bold' : 'text-green-700'">
                    {{ props.total.toLocaleString('es-AR', {style: 'decimal', minimumFractionDigits: 2}) }}
                </span>
            </ViewItem>
        </View>

        <div class="flex items-baseline my-6">
            <h1 class="text-3xl">Movimientos</h1>

            <Link :href="'/account_spends/' + props.accountCycle.id + '/create'"
                  class="text-blue-500 text-sm ml-3">Nuevo Movimiento
            </Link>

        </div>

        <ViewDetail>
            <tr v-for="accountSpend in spends.data"
                :key="accountSpend.id"
            >
                <ViewDetailItem>{{ accountSpend.description }}</ViewDetailItem>
                <ViewDetailItem>
                    <span :class="(accountSpend.movement_id === 2) ? 'text-red-500' : 'text-green-700'">
                        {{ currency.sign }} {{ accountSpend.amount }}
                    </span>
                </ViewDetailItem>
                <ViewDetailItem>
                    <span class="bg-blue-300 rounded-full px-3 py-1">
                        {{ accountSpend.tag }}
                    </span>
                </ViewDetailItem>
            </tr>
        </ViewDetail>

        <Pagination :links="spends.links" class="mt-6" />
    </Layout>
</template>

<script setup>
import Pagination from "../../Shared/Pagination";
import Layout from "../../Shared/Layout";
import Table from "../../Shared/Table";
import TableItem from "../../Shared/TableItem";
import View from "../../Shared/View";
import ViewItem from "../../Shared/ViewItem";
import _ from "lodash";
import ViewDetail from "../../Shared/ViewDetail";
import ViewDetailItem from "../../Shared/ViewDetailItem";

let props = defineProps({
    account: Object,
    bank: Object,
    currency: Object,
    accountType: Object,
    spends: Object,
    accountCycle: Object,
    nextAccountCycle: Object,
    prevAccountCycle: Object,
    total: Number,
    filters: Object
});

</script>

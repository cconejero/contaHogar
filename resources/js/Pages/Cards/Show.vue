<template>
    <Layout>
        <Head title="Tarjetas" />

        <div class="flex justify-between items-center mb-6">
            <div class="flex items-baseline">
                <h1 class="text-3xl ml-2">{{ card.name }}</h1>

                <Link
                    :href="'/billing_cycle/' + prevBillingCycle.id"
                    class="text-sm ml-4"
                    >&laquo;</Link
                >
                <span class="text-sm ml-2">Período {{ billingCycle.month }}/{{ billingCycle.year }}</span>
                <Link
                    :href="'/billing_cycle/' + nextBillingCycle.id"
                    class="text-sm ml-2 mr-2"
                    >&raquo;</Link
                >
            </div>
        </div>

        <View>
            <ViewItem title="Banco">{{ bank.name }}</ViewItem>
            <ViewItem title="Emisor">{{ brand.name }}</ViewItem>
            <ViewItem title="Fecha de cierre">{{ billingCycle.generation_date }}</ViewItem>
            <ViewItem title="Fecha de vencimiento">{{ billingCycle.due_date }}</ViewItem>
            <ViewItem title="Totales">
                <div v-for="(value, sign) in totals">
                    {{ sign }} {{ value.toLocaleString('es-AR', {style: 'decimal', minimumFractionDigits: 2}) }}
                </div>
            </ViewItem>
        </View>

        <div class="flex justify-between items-center my-6">
            <div class="flex items-center">
                <h1 class="text-3xl">Gastos</h1>

                <Link :href="'/card_spends/' + props.billingCycle.id + '/create'"
                      class="text-blue-500 text-sm ml-3">Nuevo Gasto
                </Link>
            </div>
        </div>

        <ViewDetail>
            <tr v-for="cardSpend in spends.data"
                :key="cardSpend.id"
            >
                <ViewDetailItem>{{ cardSpend.description }}</ViewDetailItem>
                <ViewDetailItem>{{ cardSpend.sign }} {{ cardSpend.amount }}</ViewDetailItem>
                <ViewDetailItem>
                    <span class="bg-blue-300 rounded-full px-3 py-1">
                        {{ cardSpend.tag }}
                    </span>
                </ViewDetailItem>
                <ViewDetailItem>
                    <span v-if="cardSpend.fixed">Gasto Fijo</span>
                    <span v-else-if="cardSpend.tax">Impuesto</span>
                    <span v-else>Cuota: {{ cardSpend.actual_due }} de {{ cardSpend.total_due }}</span>
                </ViewDetailItem>
            </tr>
        </ViewDetail>

        <Pagination :links="spends.links" class="mt-6" />
    </Layout>
</template>

<script setup>
import Pagination from "../../Shared/Pagination";
import { Link } from "@inertiajs/inertia-vue3";
import Layout from "../../Shared/Layout";
import _ from "lodash";
import View from "../../Shared/View";
import ViewItem from "../../Shared/ViewItem";
import ViewDetail from "../../Shared/ViewDetail";
import ViewDetailItem from "../../Shared/ViewDetailItem";

const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

let props = defineProps({
    card: Object,
    bank: Object,
    brand: Object,
    spends: Object,
    billingCycle: Object,
    nextBillingCycle: Object,
    prevBillingCycle: Object,
    totals: Array,
    filters: Object,
});

</script>

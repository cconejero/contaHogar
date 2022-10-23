<template>
    <Layout>
        <Head title="Tarjetas" />

        <div class="flex justify-between items-center mb-6">
            <div class="flex items-baseline">
                <h1 class="text-3xl">Tarjeta</h1>

                <Link
                    :href="'/cards/' + card.id + '?mes=' + this.prevMonth() + '&anio=' + this.prevYear()"
                    class="text-sm ml-4"
                    >&laquo;</Link
                >
                <span class="text-sm ml-2">Período {{ month }}/{{ year }}</span>
                <Link
                    :href="'/cards/' + card.id + '?mes=' + this.nextMonth() + '&anio=' + this.nextYear()"
                    class="text-sm ml-2"
                    >&raquo;</Link
                >
            </div>
        </div>

        <View>
            <ViewItem title="Nombre">{{ card.name }}</ViewItem>
            <ViewItem title="Marca">{{ brand.name }}</ViewItem>
            <ViewItem title="Banco">{{ bank.name }}</ViewItem>
            <ViewItem title="Totales">
                <div v-for="item in total">
                    {{ item.currency }} {{ item.amount.toLocaleString('es-AR', {style: 'decimal', minimumFractionDigits: 2}) }}
                </div>
            </ViewItem>
            <ViewItem title="Importar">
                <Link
                    class="text-blue-500"
                    :href="'/cards/' + card.id + '/import?prevMonth=' + this.prevMonth() + '&prevYear=' + this.prevYear() + '&actualMonth=' + month + '&actualYear=' + year"
                    method="post"
                >
                    Importar gasto del período anterior.
                </Link>
            </ViewItem>
        </View>

        <div class="flex justify-between items-center my-6">
            <div class="flex items-center">
                <h1 class="text-3xl">Gastos</h1>

                <Link :href="'/cards/' + card.id + '/spends/create?mes=' + month + '&anio=' + year"
                      class="text-blue-500 text-sm ml-3">Nuevo Gasto
                </Link
                >
            </div>
        </div>

        <ViewDetail>
            <tr v-for="cardSpend in spends.data"
                :key="cardSpend.id"
            >
                <ViewDetailItem>{{ cardSpend.description }}</ViewDetailItem>
                <ViewDetailItem>{{ cardSpend.sign }} {{ cardSpend.amount }}</ViewDetailItem>
                <ViewDetailItem>
                    <span v-if="cardSpend.fixed">Gasto Fijo</span>
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

let props = defineProps({
    card: Object,
    bank: Object,
    brand: Object,
    spends: Object,
    month: Number,
    year: Number,
    filters: Object,
});

let total = _(props.spends.data)
    .groupBy("sign")
    .map((objs, key) => {
        return {
            currency: key,
            amount: _.sumBy(objs, function (o) {
                return Number(o.amount);
            }),
        };
    })
    .value();

let nextMonth = () => {
    if (props.month < 12) {
        let next = props.month;
        next++;
        return next;
    } else {
        return 1;
    }
};

let prevMonth = () => {
    if (props.month > 1) {
        let prev = props.month;
        prev--;
        return prev;
    } else {
        return 12;
    }
};

let nextYear = () => {
    if (props.month < 12) {
        return props.year;
    } else {
        let next = props.year;
        next++;
        return next;
    }
};

let prevYear = () => {
    if (props.month > 1) {
        return props.year;
    } else {
        let prev = props.year;
        prev--;
        return prev;
    }
};
</script>

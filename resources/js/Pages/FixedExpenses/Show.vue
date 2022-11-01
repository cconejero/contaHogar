<template>
    <Layout>
        <Head title="Gasto Fijo" />

        <div class="flex justify-between items-center mb-6">
            <div class="flex items-baseline">
                <h1 class="text-3xl ml-2">{{ fixedExpense.description }}</h1>
                <Link :href="'/fixed_expenses/' + fixedExpense.id + '/edit'">
                    <img src="/img/edit.svg" class="h-5 ml-4 cursor-pointer" alt="Editar">
                </Link>
            </div>
        </div>

        <View>
            <ViewItem title="Monto">{{ fixedExpense.amount }}</ViewItem>
            <ViewItem title="Moneda">{{ fixedExpense.currency.name }}</ViewItem>
            <ViewItem title="Vence">{{ fixedExpense.due_date }} del mes</ViewItem>
            <ViewItem title="Tipo de gasto"><span class="bg-blue-300 px-3 py-2 rounded-full">{{ fixedExpense.tag }}</span></ViewItem>
            <ViewItem title="Debito Automático">{{ fixedExpense.account }}</ViewItem>
        </View>

        <div class="flex justify-between items-center my-6">
            <div class="flex items-center">
                <h1 class="text-3xl">Vencimientos</h1>
            </div>
        </div>

        <ViewDetail>
            <tr v-for="dets in fixedExpenseDets.data"
                :key="dets.id"
            >
                <ViewDetailItem>{{ dets.date }}</ViewDetailItem>
                <ViewDetailItem>
                    <span v-if="dets.paid">Pago</span>
                    <span v-else>Sin Pagar</span>
                </ViewDetailItem>
            </tr>
        </ViewDetail>

        <Pagination :links="fixedExpenseDets.links" class="mt-6" />
    </Layout>
</template>

<script setup>

import Pagination from "../../Shared/Pagination";
import Layout from "../../Shared/Layout";
import View from "../../Shared/View";
import ViewItem from "../../Shared/ViewItem";
import ViewDetail from "../../Shared/ViewDetail";
import ViewDetailItem from "../../Shared/ViewDetailItem";


let props = defineProps({
    fixedExpense: Object,
    fixedExpenseDets: Object,
});

</script>

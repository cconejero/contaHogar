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
            <ViewItem title="Dolar oficial al cierre"><span v-if="dolar?.value">AR$</span> {{ dolar?.value }}</ViewItem>
            <ViewItem title="Fecha de vencimiento">{{ billingCycle.due_date }}</ViewItem>
            <ViewItem title="Totales">
                <div class="flex items-center">
                    <div>
                        <p v-for="total in totals">{{ total.sign }} {{ total.amount.toLocaleString('es-AR', {style: 'decimal', minimumFractionDigits: 2}) }}</p>
                    </div>
                    <Link v-if="calcularCierre"
                          class="text-blue-500 cursor-pointer ml-4"
                          :href="'/billing_cycle/' + billingCycle.id + '/close_cycle'"
                    >Calcular cierre</Link>
                </div>
            </ViewItem>
            <ViewItem title="Pagar">
                <Link v-if="accounts.length < 1"
                      href="/accounts"
                      class="text-blue-500 cursor-pointer"
                >Crear una cuenta</Link>
                <form @submit.prevent="submit" class="flex items-baseline" v-else-if="viewFormPagar && totals.length === 1">
                    <select v-model="form.account_id"
                            class="border rounded border-gray-400 p-2 w-full bg-white">
                        <option v-for="account in accounts"
                                :value="account.id"
                                :key="account.id"
                        >{{ account.description }}</option>
                    </select>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="ml-4 inline-flex justify-center rounded-md border border-transparent bg-red-400 px-4 py-2 text-sm font-medium text-white hover:bg-red-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2"
                    >
                        Pagar
                    </button>
                </form>
                <span v-else-if="viewFormPagar && totals.length > 1">No cerró la tarjeta</span>
                <span v-else-if="viewNotYet">No llegó la fecha de cierre</span>
                <Paid v-else :paid="true" />
            </ViewItem>
        </View>

        <div class="flex justify-between items-center my-6">
            <div class="flex items-center">
                <h1 class="text-3xl">Gastos</h1>

                <Link :href="'/card_spends/' + props.billingCycle.id + '/create'"
                      v-if="!billingCycle.paid"
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
import { ref } from 'vue'
import Pagination from "../../Shared/Pagination";
import {Link, useForm} from "@inertiajs/inertia-vue3";
import Layout from "../../Shared/Layout";
import View from "../../Shared/View";
import ViewItem from "../../Shared/ViewItem";
import ViewDetail from "../../Shared/ViewDetail";
import ViewDetailItem from "../../Shared/ViewDetailItem";
import Paid from "../../Shared/Paid";

const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

let props = defineProps({
    card: Object,
    bank: Object,
    brand: Object,
    spends: Object,
    billingCycle: Object,
    nextBillingCycle: Object,
    prevBillingCycle: Object,
    dolar: Object,
    totals: Array,
    accounts: Object,
    filters: Object,
});

let form = useForm({
    card_billing_cycle_id: props.billingCycle.id,
    account_id: 1,
});

let viewFormPagar = (!props.billingCycle.paid && Date.now() > Date.parse(props.billingCycle.generation_date));

let viewNotYet = (!props.billingCycle.paid && Date.now() <= Date.parse(props.billingCycle.generation_date));

let calcularCierre = (viewFormPagar && props.dolar !== null && props.totals.length > 1);

let submit = () => {
    form.get('/billing_cycle/' + form.card_billing_cycle_id + '/paywithaccount/' + form.account_id );
};

</script>

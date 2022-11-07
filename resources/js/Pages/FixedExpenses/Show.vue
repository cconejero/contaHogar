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
            <ViewItem title="Vence">{{ fixedExpense.due_date }} del mes</ViewItem>
            <ViewItem title="Tipo de gasto"><span class="bg-blue-300 px-3 py-2 rounded-full">{{ fixedExpense.tag }}</span></ViewItem>
            <ViewItem title="Debito Automático">{{ fixedExpense.account }}</ViewItem>
            <ViewItem title="Fecha límite">{{ dayjs(fixedExpenseCycle.due_date).format('DD/MM/YY') }}</ViewItem>
            <ViewItem title="Total a pagar">
                <Amount :spend="true" :value="total" :sign="fixedExpense.currency.sign" />
            </ViewItem>
            <ViewItem title="Pagar">
                <Link v-if="accounts.length < 1"
                      href="/accounts"
                      class="text-blue-500 cursor-pointer"
                >Crear una cuenta</Link>
                <form @submit.prevent="submit" class="flex items-baseline" v-else-if="viewFormPagar && total !== null">
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
                <span v-else-if="viewFormPagar && totals.length > 1">No hay gasto a pagar</span>
                <span v-else-if="viewNotYet">No llegó la fecha de cierre</span>
                <Paid v-else :paid="true" />
            </ViewItem>
        </View>

        <div class="flex justify-between items-center my-6">
            <div class="flex items-center">
                <h1 class="text-3xl">Conceptos</h1>
            </div>
        </div>

        <ViewDetail>
            <tr v-for="spend in spends"
                :key="spend.fixed_expense_cycle_id"
            >
                <ViewDetailItem>{{ spend.description }}</ViewDetailItem>
                <ViewDetailItem>
                    <Amount :sign="fixedExpense.currency.sign" :value="spend.amount" :spend="true" />
                </ViewDetailItem>
                <ViewDetailItem>
                    <span class="bg-blue-300 rounded-full px-3 py-1">
                        {{ spend.tag_name }}
                    </span>
                </ViewDetailItem>
            </tr>
        </ViewDetail>

    </Layout>
</template>

<script setup>
import Layout from "../../Shared/Layout";
import View from "../../Shared/View";
import ViewItem from "../../Shared/ViewItem";
import ViewDetail from "../../Shared/ViewDetail";
import ViewDetailItem from "../../Shared/ViewDetailItem";
import {useForm} from "@inertiajs/inertia-vue3";
import dayjs from "dayjs";
import Amount from "../../Shared/Amount";
import Paid from "../../Shared/Paid"


let props = defineProps({
    fixedExpense: Object,
    fixedExpenseCycle: Object,
    accounts: Object,
    total: Number,
    spends: Object
});

let form = useForm({
    fixed_expense_cycle_id: props.fixedExpenseCycle.id,
    account_id: props.fixedExpense.account_id,
});


let viewFormPagar = (!props.fixedExpenseCycle.paid && props.fixedExpenseCycle.due_date !== null );

let viewNotYet = (!props.fixedExpenseCycle.paid && props.fixedExpenseCycle.due_date === null);

let calcularCierre = (viewFormPagar && props.total !== null);

let submit = () => {
    form.get('/fixed_expense_cycles/' + form.fixed_expense_cycle_id + '/paywithaccount/' + form.account_id );
};


</script>

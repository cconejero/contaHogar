<template>
    <Layout>
        <Head title="Dashboard" />

        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center">
                <h1 class="text-3xl">Dashboard</h1>
            </div>
        </div>


        <div>
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center">
                    <h1 class="text-2xl">Cuentas</h1>
                    <span v-for="total in totalAccounts" class="ml-4">
                        <Amount :sign="total.sign" :value="total.amount" />
                    </span>
                </div>
            </div>

            <Table>
                <tr v-for="account in accounts">
                    <table-item>
                        <Link :href="'/account_cycle/' + account.actualCycleId"
                              class="cursor-pointer text-blue-500"
                        >
                            {{ account.description }}
                        </Link>
                    </table-item>
                    <table-item>
                        <Amount :sign="account.sign"
                                :value="account.actualCycleTotal"
                        />
                    </table-item>
                </tr>
            </Table>
        </div>

        <div class="mt-6">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center">
                    <h1 class="text-2xl">Tarjetas</h1>
                </div>
            </div>

            <Table>
                <tr v-for="card in cards">
                    <table-item>
                        <Link :href="'/billing_cycle/' + card.actualBillingCycleId"
                              class="text-blue-500 cursor-pointer"
                        >
                            {{ card.name }}
                        </Link>
                    </table-item>
                    <table-item>
                        <Amount v-for="total in card.totals" class="ml-4" :sign="total?.sign" :value="total?.amount" :spend="true" />
                    </table-item>
                    <table-item>
                        <span>Vence: {{ dayjs(card.due_date).format('DD/MM/YY') }}</span>
                        <Paid :paid="card.paid" class="ml-4" />
                    </table-item>
                </tr>
            </Table>
        </div>

        <div class="mt-6">
            <div class="flex justify-between items-center mb-6">
                <div class="flex items-center">
                    <h1 class="text-2xl">Gastos Fijos</h1>
                </div>
            </div>

            <Table>
                <tr v-for="fixedExpense in fixedExpenses">
                    <table-item>
                        <Link :href="'/fixed_expense_cycles/' + fixedExpense.current_cycle_id"
                              class="text-blue-500 cursor-pointer"
                        >
                            {{ fixedExpense.description }}
                        </Link>
                    </table-item>
                    <table-item>
                        <Amount class="ml-4" sign="AR$" :value="fixedExpense.amount" :spend="true" />
                    </table-item>
                    <table-item>
                        <span>Vence: {{ dayjs(fixedExpense.due_date).format('DD/MM/YY') }}</span>
                        <Paid :paid="fixedExpense.paid" class="ml-4" />
                    </table-item>
                </tr>
            </Table>
        </div>

    </Layout>
</template>

<script setup>

import Layout from "../../Shared/Layout";
import Table from "../../Shared/Table";
import TableItem from "../../Shared/TableItem";
import Amount from "../../Shared/Amount";
import {computed} from "vue";
import Paid from "../../Shared/Paid";
import dayjs from 'dayjs';

let props = defineProps({
    accounts: Object,
    cards: Object,
    fixedExpenses: Object
});

const totalAccounts = computed(() => {
    let result = [];
    props.accounts.reduce((res, account) => {
        if (!res[account.currency_name]){
            res[account.currency_name] =  {sign: account.sign, amount: account.actualCycleTotal};
            result.push(res[account.currency_name]);
        } else {
            res[account.currency_name].amount += account.actualCycleTotal;
        }
        return res;
    }, {});

    return result;
});

</script>

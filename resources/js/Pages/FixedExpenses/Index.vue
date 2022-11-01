<template>
    <Layout>
        <Head title="Gastos Fijos" />

        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center">
                <h1 class="text-3xl">Gastos Fijos</h1>

                <Link
                    v-if="can.createFixedExpense"
                    href="/fixed_expenses/create"
                    class="text-blue-500 text-sm ml-3"
                >Nuevo Gasto Fijo</Link
                >
            </div>

            <input
                v-model="search"
                type="text"
                placeholder="Buscar..."
                class="border px-2 rounded-lg"
            />
        </div>

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                >
                    <div
                        class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                    >
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="fixedExpense in fixedExpenses.data" :key="fixedExpense.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div
                                                class="text-sm font-medium text-gray-900 flex items-center"
                                            >
                                                <Link v-if="fixedExpense.can.view"
                                                      :href="`/fixed_expenses/${fixedExpense.id}`"
                                                      class="text-indigo-600 hover:text-indigo-900"
                                                >{{ fixedExpense.description }}</Link>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                >
                                    <div>Día {{ fixedExpense.dueDate }} del mes</div>
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                >
                                    <div>{{ fixedExpense.currencySign }} {{ fixedExpense.amount }}</div>
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                                >
                                    <div>
                                        <span class="bg-blue-300 px-3 py-2 rounded-full">
                                            {{ fixedExpense.tag }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <Pagination :links="fixedExpenses.links" class="mt-6" />
    </Layout>
</template>

<script setup>
import Pagination from "../../Shared/Pagination";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { debounce } from "lodash";
import Layout from "../../Shared/Layout";

let props = defineProps({
    fixedExpenses: Object,
    filters: Object,
    can: Object,
});

let search = ref(props.filters.search);

watch(
    search,
    debounce(function (value) {
        Inertia.get(
            "/fixed_expenses",
            { search: value },
            {
                preserveState: true,
                replace: true,
            }
        );
    }, 300)
);

</script>

<style scoped>

</style>

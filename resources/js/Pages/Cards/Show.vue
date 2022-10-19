<template>
    <Layout>
    <Head title="Tarjetas" />

    <div class="flex justify-between items-center mb-6">
        <div class="flex items-baseline">
            <h1 class="text-3xl">Tarjeta</h1>
            <span class="text-sm ml-4">Período {{ month }}/{{ year }}</span>
        </div>
        <div>
            <Link :href="'/cards/' + card.id + '?mes=' + this.prevMonth() + '&anio=' + this.prevYear()" class="text-sm ml-4">Anterior</Link>
            <Link :href="'/cards/' + card.id + '?mes=' + this.nextMonth() + '&anio=' + this.nextYear()" class="text-sm ml-4">Siguiente</Link>
        </div>
    </div>

    <div class="overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="border-t border-gray-200">
            <dl>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ card.name }}</dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Marca</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ brand.name }}</dd>
                </div>
                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">Banco</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ bank.name }}</dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="flex justify-between items-center my-6">
        <div class="flex items-center">
            <h1 class="text-3xl">Gastos</h1>

            <Link
                :href="'/cards/' + card.id + '/spends/create'"
                class="text-blue-500 text-sm ml-3"
            >Nuevo Gasto</Link
            >
        </div>
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
                        <tr v-for="cardSpend in spends.data" :key="cardSpend.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div>
                                        <div
                                            class="text-sm font-medium text-gray-900"
                                        >
                                            {{ cardSpend.description }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div>
                                        <div
                                            class="text-sm font-medium text-gray-900"
                                        >
                                            {{ cardSpend.amount }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div>
                                        <div
                                            class="text-sm font-medium text-gray-900"
                                        >
                                            Cuota: {{ cardSpend.actual_due }} de {{ cardSpend.total_due }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <Pagination :links="spends.links" class="mt-6" />
    </Layout>
</template>

<script setup>
import Pagination from "../../Shared/Pagination";
import Layout from "../../Shared/Layout";

let props = defineProps({
    card: Object,
    bank: Object,
    brand: Object,
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

<script setup>
import { onMounted, ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia'
import FlashMessage from '@/Components/FlashMessage.vue';
import Pagination from '@/Components/Pagination.vue';
import dayjs from 'dayjs';



const props = defineProps({
  orders: Object,
  errors: Object
})

onMounted(() => {
  console.log(props.orders.data)
})

const search = ref('')

const searchCustomers = () => {
  Inertia.get(route('purchases.index', { search: search.value }))
}

</script>
<template>
  <Head title="取引履歴" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">契約履歴一覧</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:pr-4 sm:pl-60 lg:pr-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <section class="text-gray-600 body-font">
              <div class="container px-5 py-24 mx-auto">
                <FlashMessage />
                <div class="flex flex-col text-center w-full mb-20">
                  <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">契約履歴データ</h1>
                </div>
                <div class="mb-6 xl:w-4/5 w-full mx-auto">
                  <input type="text" name="search" v-model="search">
                  <button class="bg-teal-500 hover:bg-teal-400 text-white py-2 px-2" @click="searchCustomers">検索</button>
                </div>
                <div class="xl:w-4/5 w-full mx-auto overflow-auto">
                  <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                      <tr>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                          企業名
                        </th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                          売上(見込み)
                        </th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                          ステータス
                        </th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                          最新取引日
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in props.orders.data" :key="order.id">
                        <td class="px-4 py-3 border-b-2 border-gray-200">
                          <Link class="text-blue-600" :href="route('purchases.show', { purchase: order.id })">
                          {{ order.customer_name }}
                          </Link>
                        </td>
                        <td class="px-4 py-3 border-b-2 border-gray-200">{{ order.total }}</td>
                        <td v-if="order.status == true" class="px-4 py-3 border-b-2 border-gray-200 text-red-500">
                          稼働終了
                        </td>
                        <td v-if="order.status == false" class="px-4 py-3 border-b-2 border-gray-200">
                          稼働中
                        </td>
                        <td class="px-4 py-3 border-b-2 border-gray-200">
                          {{ dayjs(order.created_at).format('YYYY-MM-DD HH:mm:ss') }}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <Pagination :links="props.orders.links"></Pagination>
            </section>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
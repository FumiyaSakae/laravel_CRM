<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia'
import FlashMessage from '@/Components/FlashMessage.vue';
import Pagination from '@/Components/Pagination.vue';

defineProps({
  customers: Object
})

const search = ref('');

const searchCustomers = () => {
  Inertia.get(route('customers.index', { search: search.value }))
}

</script>

<template>
  <Head title="取引先一覧" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">取引先一覧</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <section class="text-gray-600 body-font">
              <div class="container px-5 py-24 mx-auto">
                <FlashMessage />
                <div class="flex flex-col text-center w-full mb-20">
                  <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Pricing</h1>
                  <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Banh mi cornhole echo park skateboard authentic
                    crucifix neutra tilde lyft biodiesel artisan direct trade mumblecore 3 wolf moon twee</p>
                </div>
                <div class="mb-6">
                  <input type="text" name="search" v-model="search">
                  <button class="bg-blue-300 text-white py-2 px-2" @click="searchCustomers">検索</button>
                </div>
                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                  <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                      <tr>
                        <th
                          class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                          No</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                          企業名</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                          担当者名</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                          担当者名(フリガナ)</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                          電話番号</th>
                        <th
                          class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="customer in customers.data" :key="customer.id">
                        <td class="px-4 py-3 border-b-2 border-gray-200">
                          <Link class="text-blue-400" :href="route('customers.show', { customer: customer.id })">{{
                            customer.id
                          }}</Link>
                        </td>
                        <td class="px-4 py-3 border-b-2 border-gray-200">{{ customer.company_name }}</td>
                        <td class="px-4 py-3 border-b-2 border-gray-200">{{ customer.pic_name }}</td>
                        <td class="px-4 py-3 border-b-2 border-gray-200">{{ customer.pic_kana }}</td>
                        <td class="px-4 py-3 border-b-2 border-gray-200">{{ customer.tel }}</td>
                        <td class="w-10 text-center border-b-2 border-gray-200">
                          <input name=" plan" type="radio">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">
                  <a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">Learn More
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                      <path d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                  </a>
                  <Link as="button" :href="route('customers.create')"
                    class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">
                  取引先登録
                  </Link>
                </div>
              </div>
              <Pagination :links="customers.links"></Pagination>
            </section>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

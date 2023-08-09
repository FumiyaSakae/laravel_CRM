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
      <div class="max-w-7xl mx-auto sm:pr-4 sm:pl-60 lg:pr-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <FlashMessage />
            <section class="text-gray-600 body-font">
              <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-20">
                  <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">取引先企業一覧</h1>
                </div>
                <div class="mb-6 lg:w-3/4 w-full">
                  <input type="text" name="search" v-model="search">
                  <button class="bg-teal-500 hover:bg-teal-400 text-white py-2 px-2" @click="searchCustomers">検索</button>
                </div>
                <div class="lg:w-full w-full mx-auto overflow-auto">
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
                          担当者名<br>
                          (フリガナ)</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                          電話番号</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="customer in customers.data" :key="customer.id">
                        <td class="px-4 py-3 border-b-2 border-gray-200">
                          {{ customer.id }}
                        </td>
                        <td class="px-4 py-3 border-b-2 border-gray-200">{{ customer.company_name }}</td>
                        <td class="px-4 py-3 border-b-2 border-gray-200">{{ customer.pic_name }}</td>
                        <td class="px-4 py-3 border-b-2 border-gray-200">{{ customer.pic_kana }}</td>
                        <td class="px-4 py-3 border-b-2 border-gray-200">{{ customer.tel }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="pl-4 mt-4 lg:w-full w-full mx-auto">
                  <Link as="button" :href="route('customers.create')"
                    class="flex ml-auto text-white bg-teal-500 border-0 py-2 px-6 focus:outline-none hover:bg-teal-400 rounded">
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

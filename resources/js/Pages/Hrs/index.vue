<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import FlashMessage from '@/Components/FlashMessage.vue';

defineProps({
  hrs: Array
})
</script>

<template>
  <Head title="人材一覧" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">人材一覧</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:pr-4 sm:pl-60 lg:pr-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <FlashMessage />
            <section class="text-gray-600 body-font">
              <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-20">
                  <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">登録人材一覧</h1>
                  <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                    登録された人材情報の一覧です。
                  </p>
                </div>
                <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                  <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                      <tr>
                        <th
                          class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                          No</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                          名前</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                          最低単価</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                          現在単価</th>
                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                          ステータス</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="hr in hrs" :key="hr.id">
                        <td class="px-4 py-3 border-b-2 border-gray-200">
                          <Link class="text-blue-400" :href="route('hrs.show', { hr: hr.id })">{{ hr.id }}</Link>
                        </td>
                        <td class="px-4 py-3 border-b-2 border-gray-200">{{ hr.name }}</td>
                        <td class="px-4 py-3 border-b-2 border-gray-200">{{ hr.min_price }}</td>
                        <td class="px-4 py-3 border-b-2 border-gray-200">{{ hr.current_price }}</td>
                        <td class="px-4 py-3 border-b-2 border-gray-200">
                          <span v-if="hr.is_selling === 0">待機中</span>
                          <span v-if="hr.is_selling === 1">稼働中</span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">
                  <Link as="button" :href="route('hrs.create')"
                    class="flex ml-auto text-white bg-teal-500 border-0 py-2 px-6 focus:outline-none hover:bg-teal-600 rounded">
                  登録
                  </Link>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { getToday } from '@/common'
import { onMounted, reactive, ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import dayjs from 'dayjs';

const props = defineProps({
  'hrs': Array,
  'order': Array,
  errors: Object
})

onMounted(() => {
  console.log(props.hrs)
  console.log(props.order[0].customer_name)

})


</script>

<template>
  <Head title="契約履歴詳細画面" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">契約履歴詳細画面</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:pr-4 sm:pl-60 lg:pr-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <section class="text-gray-600 body-font relative">
              <form @submit.prevent="storePurchase">
                <div class="container px-5 py-24 mx-auto">
                  <div class="flex flex-col text-center w-full mb-12">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">
                      契約履歴の詳細情報
                    </h1>
                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
                      過去に登録した契約情報の詳細画面です。
                    </p>
                  </div>
                  <!-- <div class="p-2 w-1/2">
                      <div class="relative">
                        <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                        <input type="email" id="email" name="email"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>
                    </div> -->
                  <div class="sm:w-full xl:w-4/5 mx-auto">
                    <div class="">
                      <label for="customer" class="leading-7 text-sm text-gray-600">取引先名</label>
                      <div id="date" name="date"
                        class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        {{ props.order[0].customer_name }}
                      </div>
                    </div>
                  </div>
                  <div class="sm:w-full xl:w-4/5 mx-auto">
                    <div class="w-full mt-4 mx-auto overflow-auto">
                      <table class="table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                          <tr>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                              作業者名</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                              単金</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                              稼働開始日</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                              契約月数</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                              ステータス</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                              稼働終了日</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="hr in props.hrs" :key="hr.id">
                            <td class="px-4 py-3 border-b-2 border-gray-200">{{ hr.hr_name }}</td>
                            <td class="px-4 py-3 border-b-2 border-gray-200">
                              {{ hr.store_price }}</td>
                            <td class="px-4 py-3 border-b-2 border-gray-200">{{
                              dayjs(props.order[0].startDate).format('YYYY-MM-DD') }}</td>
                            <td class="px-4 py-3 border-b-2 border-gray-200">
                              {{ hr.quantity }}ヶ月</td>
                            <td v-if="props.order[0].status == true"
                              class="px-4 py-3 border-b-2 border-gray-200 text-red-500">
                              稼働終了
                            </td>
                            <td v-if="props.order[0].status == false" class="px-4 py-3 border-b-2 border-gray-200">
                              稼働中
                            </td>
                            <td v-if="props.order[0].endDate" class="px-4 py-3 border-b-2 border-gray-200">
                              {{ props.order[0].endDate }}</td>
                            <td v-if="!props.order[0].endDate" class="px-4 py-3 border-b-2 border-gray-200">
                              未入力</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="p-2 w-full">
                      <div class="">
                        <label for="total" class="leading-7 text-gray-600">合計金額</label>
                        <div class="text-sm text-red-600">{{ props.order[0].total }}円</div>
                      </div>
                    </div>

                    <div class="p-2 w-full">
                      <Link as="button" :href="route('purchases.edit', { purchase: props.order[0].id })"
                        class="flex ml-auto text-white bg-teal-500 border-0 py-2 px-6 focus:outline-none hover:bg-teal-400 rounded">
                      編集
                      </Link>
                    </div>
                    <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">
                      <a class="text-indigo-500">example@email.com</a>
                      <p class="leading-normal my-5">49 Smith St.
                        <br>Saint Cloud, MN 56301
                      </p>
                      <span class="inline-flex">
                        <a class="text-gray-500">
                          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                          </svg>
                        </a>
                        <a class="ml-4 text-gray-500">
                          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            class="w-5 h-5" viewBox="0 0 24 24">
                            <path
                              d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                            </path>
                          </svg>
                        </a>
                        <a class="ml-4 text-gray-500">
                          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                          </svg>
                        </a>
                        <a class="ml-4 text-gray-500">
                          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            class="w-5 h-5" viewBox="0 0 24 24">
                            <path
                              d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z">
                            </path>
                          </svg>
                        </a>
                      </span>
                    </div>
                  </div>
                </div>
              </form>
            </section>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

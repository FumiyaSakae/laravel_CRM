<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { getToday } from '@/common'
import { n12br } from '@/common';
import { onMounted, reactive, ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import MicroModalCustomers from '@/components/MicroModal_customers.vue';
import MicroModalHrs from '@/components/MicroModal_hrs.vue';

const props = defineProps({
  'hrs': Array,
  errors: Object
})

onMounted(() => {
  form.startDate = getToday();
})

const quantity = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12',]

const useProcess = ['要件定義', '基本設計', '詳細設計', '開発', 'テスト', '保守・運用',]


const hrList = ref([]);
const processList = ref([]);

const form = reactive({
  startDate: null,
  endDate: null,
  customer_id: null,
  hrs: [],
  start_process: null,
  end_process: null,
  current_price: null,
  quantity: null,
  hr_id: null,
  contr_detail: '案件概要：\n技術要素：\n作業場所：',
})


const totalPrice = computed(() => {
  let total = 0
  hrList.value.forEach(hr => {
    total += hr.current_price * hr.quantity
  })
  return total
})

const storePurchase = () => {
  hrList.value.forEach(hr => {
    if (hr.quantity > 0) {
      form.hrs.push({
        id: hr.id,
        current_price: hr.current_price,
        store_price: hr.current_price,
        quantity: hr.quantity
      })
    }
    form.current_price = hr.current_price
    form.quantity = hr.quantity
  })
  Inertia.post(route('purchases.store'), form)
}

const setCustomerId = (id) => {
  form.customer_id = id
}

const setHrData = (id, name) => {
  form.hr_id = id,
    hrList.value.push({
      id: id,
      name: name
    })
  console.log(id)
}

const setProcess = (value) => {
  console.log(value);
}


</script>

<template>
  <Head title="契約登録画面" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">契約登録画面</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:pr-4 sm:pl-60 lg:pr-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <section class="text-gray-600 body-font relative">
              <form @submit.prevent="storePurchase">
                <div class="container px-5 py-24 mx-auto">
                  <div class="flex flex-col text-center w-full mb-12">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">新規契約登録</h1>
                  </div>
                  <div class="lg:w-3/4 md:w-3/4 mx-auto">
                    <div class="p-2 w-full">
                      <div class="relative">
                        <label for="startDate" class="leading-7 text-sm text-gray-600">契約開始日</label>
                        <input type="date" id="startDate" name="startDate" v-model="form.startDate"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>
                    </div>
                    <div class="p-2 w-full">
                      <div class="relative">
                        <label for="endDate" class="leading-7 text-sm text-gray-600">契約終了日</label>
                        <input type="date" id="endDate" name="endDate" v-model="form.endDate"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>
                    </div>
                    <!-- <div class="p-2 w-1/2">
                      <div class="relative">
                        <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                        <input type="email" id="email" name="email"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                      </div>
                    </div> -->
                    <div class="p-2 w-full">
                      <div class="">
                        <label for="customer" class="leading-7 text-sm text-gray-600">取引先名</label>
                        <div class="text-sm text-red-600" v-if="errors.customer_id">{{ errors.customer_id }}</div>
                        <MicroModalCustomers @update:customerId="setCustomerId" />
                      </div>
                    </div>
                    <div class="lg:w-full mx-auto overflow-auto mt-8">
                      <div class="p-2 w-full">
                        <div class="">
                          <label for="pic_name" class="leading-7 text-sm text-gray-600">作業者名</label>
                          <div class="text-sm text-red-600" v-if="errors.hr_id">{{ errors.hr_id }}</div>
                          <div class="text-sm text-red-600" v-if="errors.current_price">{{ errors.current_price }}</div>
                          <div class="text-sm text-red-600" v-if="errors.quantity">{{ errors.quantity }}</div>
                          <MicroModalHrs @update:hrData="setHrData" />
                        </div>
                      </div>
                      <table v-if="hrList.length !== 0" class="table-auto w-full text-left whitespace-no-wrap mt-4">
                        <thead>
                          <tr>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                              No</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                              作業者名</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                              単価</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                              契約予定月数</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="hr in hrList">
                            <td class="px-4 py-3 border-b-2 border-gray-200">{{ hr.id }}</td>
                            <td class="px-4 py-3 border-b-2 border-gray-200">{{ hr.name }}</td>
                            <td class="px-4 py-3 border-b-2 border-gray-200">
                              <input type="number" id="current_price" name="current_price" v-model="hr.current_price"
                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </td>
                            <td class="px-4 py-3 border-b-2 border-gray-200">
                              <select name="quantity" v-model="hr.quantity"
                                class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                <option v-for=" q  in  quantity " :value="q">{{ q }}ヶ月</option>
                              </select>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="p-2 w-2/3 ml-auto">
                      <div class="flex flex-col text-end">
                        <label for="totalPrice" class="ml-auto leading-7 text-sm text-gray-600">売上小計</label>
                        <div
                          class="pr-3 ml-auto w-1/2 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 pl-3 pr-18 leading-8 transition-colors duration-200 ease-in-out"
                          v-if="isNaN(totalPrice)">計算中...</div>
                        <div
                          class="pr-3 ml-auto w-1/2 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-red-500 py-1 pl-3 pr-18 leading-8 transition-colors duration-200 ease-in-out"
                          v-else>{{ totalPrice }}円</div>
                      </div>
                    </div>
                    <div class="p-2 flex mt-10">
                      <div class="flex flex-col">
                        <label for="process" class="leading-7 text-sm text-gray-600">開始工程</label>
                        <select name="process" v-model="form.start_process"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 pl-3 pr-18 leading-8 transition-colors duration-200 ease-in-out">
                          <option type="text" v-for="start_pro in useProcess">
                            {{ start_pro }}
                          </option>
                        </select>
                      </div>
                      <p class="flex pt-5 items-center mr-10 ml-10">〜</p>
                      <div class="flex flex-col">
                        <label for="process" class="leading-7 text-sm text-gray-600">終了工程</label>
                        <select name="process" v-model="form.end_process"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 pl-3 pr-18 leading-8 transition-colors duration-200 ease-in-out">
                          <option type="text" v-for=" end_pro in useProcess">
                            {{ end_pro }}
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="text-sm text-red-600" v-if="errors.start_process">
                      {{ errors.start_process }}
                    </div>
                    <div class="p-2 w-full mt-10">
                      <div class="flex flex-col">
                        <label for="contr_detail" class="leading-7 text-sm text-gray-600">契約詳細</label>
                        <textarea id="contr_detail" name="contr_detail" v-model="form.contr_detail"
                          class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">
                        </textarea>
                      </div>
                    </div>
                    <div class="p-2 w-full">
                      <button
                        class="flex mx-auto text-white bg-teal-500 border-0 py-2 px-8 focus:outline-none hover:bg-teal-600 rounded text-lg">登録</button>
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

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { Core as YubinBangoCore } from 'yubinbango-core2';

defineProps({
  errors: Object
});

const form = reactive({
  company_name: null,
  pic_name: null,
  pic_kana: null,
  gender: null,
  tel: null,
  email: null,
  postcode: null,
  address: null,
  startDate: null,
  memo: null,
})

const storeCustomer = () => {
  Inertia.post('/customers', form);
}

const fetchAddress = () => {
  new YubinBangoCore(String(form.postcode), (value) => {
    form.address = value.region + value.locality + value.street
  })
}

</script>

<template>
  <Head title="取引先登録" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">取引先登録</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:pr-4 sm:pl-60 lg:pr-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <section class="text-gray-600 body-font relative">
              <form @submit.prevent="storeCustomer">
                <div class="container px-5 py-24 mx-auto">
                  <div class="flex flex-col text-center w-full mb-12">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">取引先情報の入力</h1>
                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">新規に契約を開始する取引先情報の入力ができます。</p>
                  </div>
                  <div class="lg:w-1/2 md:w-2/3 mx-auto">
                    <div class="flex flex-wrap -m-2">
                      <div class="p-2 w-full">
                        <div class="flex flex-col">
                          <label for="company_name" class="leading-7 text-sm text-gray-600">会社名</label>
                          <input type="text" id="company_name" name="company_name" v-model="form.company_name"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <div class="text-sm text-red-600" v-if="errors.company_name">{{ errors.company_name }}</div>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="flex flex-col">
                          <label for="pic_name" class="leading-7 text-sm text-gray-600">担当者名</label>
                          <input type="text" id="pic_name" name="pic_name" v-model="form.pic_name"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <div class="text-sm text-red-600" v-if="errors.pic_name">{{ errors.pic_name }}</div>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="flex flex-col">
                          <label for="pic_kana" class="leading-7 text-sm text-gray-600">担当者名(フリガナ)</label>
                          <input type="text" id="pic_kana" name="pic_kana" v-model="form.pic_kana"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <div class="text-sm text-red-600" v-if="errors.pic_kana">{{ errors.pic_kana }}</div>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="relative">
                          <label class="leading-7 text-sm text-gray-600">性別</label>
                          <input type="radio" id="gender" name="gender" v-model="form.gender" value="0">
                          <label for="gender0" class="ml-2 mr-4">男性</label>
                          <input type="radio" id="gender" name="gender" v-model="form.gender" value="1">
                          <label for="gender1" class="ml-2 mr-4">女性</label>
                          <input type="radio" id="gender" name="gender" v-model="form.gender" value="2">
                          <label for="gender2" class="ml-2 mr-4">その他</label>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="flex flex-col">
                          <label for="tel" class="leading-7 text-sm text-gray-600">電話番号</label>
                          <input type="tel" id="tel" name="tel" v-model="form.tel"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <div class="text-sm text-red-600" v-if="errors.tel">{{ errors.tel }}</div>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="flex flex-col">
                          <label for="email" class="leading-7 text-sm text-gray-600">メールアドレス</label>
                          <input type="email" id="email" name="email" v-model="form.email"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <div class="text-sm text-red-600" v-if="errors.email">{{ errors.email }}</div>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="flex flex-col">
                          <label for="postcode" class="leading-7 text-sm text-gray-600">郵便番号</label>
                          <input type="number" id="postcode" name="postcode" @change="fetchAddress"
                            v-model="form.postcode"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <div class="text-sm text-red-600" v-if="errors.postcode">{{ errors.postcode }}</div>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="flex flex-col">
                          <label for="address" class="leading-7 text-sm text-gray-600">住所</label>
                          <input type="text" id="address" name="address" v-model="form.address"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <div class="text-sm text-red-600" v-if="errors.address">{{ errors.address }}</div>
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
                        <div class="flex flex-col">
                          <label for="startDate" class="leading-7 text-sm text-gray-600">取引開始日</label>
                          <input type="date" id="startDate" name="startDate" v-model="form.startDate"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          <div class="text-sm text-red-600" v-if="errors.startDate">{{ errors.startDate }}</div>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="flex flex-col">
                          <label for="memo" class="leading-7 text-sm text-gray-600">備考</label>
                          <textarea id="memo" name="memo" v-model="form.memo"
                            class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                        </div>
                      </div>

                      <div class="p-2 w-full">
                        <button
                          class="flex mx-auto text-white bg-teal-500 border-0 py-2 px-8 focus:outline-none hover:bg-teal-400 rounded text-lg">登録</button>
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
                </div>
              </form>
            </section>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

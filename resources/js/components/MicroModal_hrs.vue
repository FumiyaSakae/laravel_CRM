<script setup>
import axios from 'axios';
import { ref, reactive } from 'vue';

const search = ref('')
const hrs = reactive({})

const isShow = ref(false)
const toggleStatus = () => { isShow.value = !isShow.value }

const searchHrs = async () => {
  try {
    await axios.get(`/api/searchHrs/?search=${search.value}`)
      .then(res => {
        console.log(res.data)
        hrs.value = res.data
      })
    toggleStatus();
  } catch (e) {
    console.log(e)
  }
}

const emit = defineEmits(['update:hrId'])

const setHr = e => {
  search.value = e.name
  emit('update:hrId', e.id)
  toggleStatus()
}
</script>
<template>
  <div v-show="isShow" class="modal" id="modal-1" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container w-2/3" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal__header">
          <h2 class="modal__title" id="modal-1-title">
            Micromodal
          </h2>
          <button @click="toggleStatus" type="button" class="modal__close" aria-label="Close modal"
            data-micromodal-close></button>
        </header>
        <main class="modal__content" id="modal-1-content">
          <div v-if="hrs.value" class="lg:w-2/3 w-full mx-auto overflow-auto">
            <table class="table-auto w-full text-left whitespace-no-wrap">
              <thead>
                <tr>
                  <th
                    class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                    No</th>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                    名前</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="hr in hrs.value" :key="hr.id">
                  <td class="px-4 text-blue-500 py-3 border-b-2 border-gray-200">
                    <button type="button" @click="setHr({ id: hr.id, name: hr.name })"
                      class="border-b-2 border-gray-200 px-4 py-3">
                      {{ hr.id }}
                    </button>
                  </td>
                  <td class="px-4 py-3 border-b-2 border-gray-200">{{ hr.name }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </main>
        <footer class="modal__footer">
          <button @click="toggleStatus" type="button" class="modal__btn" data-micromodal-close
            aria-label="Close this dialog window">閉じる</button>
        </footer>
      </div>
    </div>
  </div>
  <input
    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-ou"
    name="name" v-model="search">
  <button class=" flex mx-auto text-white bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-500 rounded
  text-lg" @click="searchHrs" type="button" data-micromodal-trigger="modal-1">検索する</button>
</template>
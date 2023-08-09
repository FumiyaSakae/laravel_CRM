<script setup>
import { getToday } from '@/common'
import { onMounted, reactive, ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  'customers': Array,
  'hrs': Array
})

onMounted(() => {
  form.date = getToday();
  props.hrs.forEach(hr => {
    hrList.value.push({
      id: hr.id,
      name: hr.name,
      price: hr.price,
      quantity: 0
    })
  })
})

const quantity = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12',]

const hrList = ref([]);

const form = reactive({
  date: null,
  customer_id: null,
  status: true,
  hrs: []
})

const totalPrice = computed(() => {
  let total = 0
  hrList.value.forEach(hr => {
    total += hr.price * hr.quantity
  })
  return total
})

const storePurchase = () => {
  hrList.value.forEach(hr => {
    if (hr.quantity > 0) {
      form.hrs.push({
        id: hr.id,
        quantity: hr.quantity
      })
    }
  })
  Inertia.post(route('purchases.store'), form)
}

</script>
<template>
  <form @submit.prevent="storePurchase">
    日付<br>
    <input type="date" name="date" v-model="form.date"><br>

    取引社名<br>
    <select name="customer" v-model="form.customer_id">
      <option v-for="customer in customers" :value="customer.id" :key="customer.id">
        {{ customer.id }} : {{ customer.company_name }}
      </option>
    </select><br>

    人材・業務内容<br>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>作業者</th>
          <th>単金</th>
          <th>契約予定月数</th>
          <th>売上小計</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="hr in hrList">
          <td>{{ hr.id }}</td>
          <td>{{ hr.name }}</td>
          <td>{{ hr.price }}</td>
          <td>
            <select name="quantity" v-model="hr.quantity">
              <option v-for="q in quantity" :value="q">{{ q }}</option>
            </select>
          </td>
          <td>
            {{ hr.price * hr.quantity }}
          </td>
        </tr>
      </tbody><br>
    </table>
    合計： {{ totalPrice }}<br>
    <button>登録する</button>
  </form>
</template>
<script setup>
import CustomerDetails from "../components/customer/details/index.vue";

//----- Get Selected Customer
import { storeToRefs } from 'pinia'
import { useCustomersStore } from '../stores/customers'
const store = useCustomersStore()
const { selectedCustomer } = storeToRefs(store)
</script>

<template>
    <!--        Selected Customer Details-->
    <div v-if="selectedCustomer!=null" class="w-[820px] border shadow-sm rounded-md p-2  z-20 bg-gray-50 shadow-lg">
        <div class="relative">
            <!-- close button-->
            <div @click="$router.back()" class="absolute top-2 right-2 ">
                    <span class="flex items-center justify-center w-7 h-7 bg-gray-100 rounded-full text-gray-900 hover:bg-gray-200 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20" fill="currentColor"
                             class="w-6 h-6">
                            <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                        </svg>
                    </span>

            </div>

            <!-- Customers table-->
            <CustomerDetails/>
        </div>
    </div>
</template>

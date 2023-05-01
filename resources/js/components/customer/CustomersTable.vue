<script setup>
// ----- Components
import AddNewCustomer from "../AddButton.vue";
import SearchCustomer from "../SearchInput.vue";
import {useRouter} from 'vue-router'
import {watch, onMounted} from 'vue'

// ---- Pinia customers store
import { storeToRefs } from 'pinia'
import { useCustomersStore } from '../../stores/customers'
const store = useCustomersStore()
// Destruct to get methods to fetch, delete customer and customers
const {fetchCustomers, deleteCustomer, fetchCustomer} = store
// Get Customers, pagination, searchTerm values in interactive way.
const { customers, pagination, searchTerm } = storeToRefs(store)

// ----- Use router in order to make push requests in the createCustomer method
const router = useRouter()
const createCustomer = async ()=>{
    await router.push({ name: 'new-customer'})
}
// Initial fetch of the Customers when the application starts.
onMounted(async() => {
    await fetchCustomers();
});

// watch if anything is typed in the search input.
watch(searchTerm, async (newValue) => {
    await fetchCustomers(1, newValue);
})

</script>

<template>
    <div class="flex justify-between">
        <SearchCustomer placeholder="Search Customer by name" v-model="searchTerm"/>
        <AddNewCustomer @click="createCustomer" button-name="New Customer"/>
    </div>

    <div class=" relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
            <tr>
                <th class="px-6 py-3 bg-gray-200">
                    Customer name
                </th>
                <th class="px-6 py-3 bg-gray-200 text-center">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-white border-b" v-for="(customer,i) in customers" :key="i">
                <td class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap">
                    <label for="apple" class="pl-4 w-full">{{customer.name}}</label>
                </td>
                <td class="flex justify-center items-center py-4">
                  <span
                      class="flex justify-center items-center h-9 w-9 p-1 border rounded-full cursor-pointer hover:bg-gray-100"
                      @click="deleteCustomer(customer.id)"
                  >
                    <svg class="h-5 w-5 text-red-600 flex items-center justify-center" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                  </span>

                    <div class="w-4"></div>
                    <span
                        class="flex justify-center items-center h-9 w-9 p-1 border rounded-full cursor-pointer hover:bg-gray-100"
                        @click="fetchCustomer(customer.id)"
                    >
                        <svg class="h-5 w-5 text-green-600 flex items-center justify-center" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>

                   </span>
                </td>
            </tr>
            </tbody>
        </table>

<!--        Pagination-->
        <div class="py-4 flex justify-center" v-if="pagination.last_page > 1">
            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                <button
                    :disabled="pagination.current_page === 1"
                    :class="[pagination.current_page === 1?'bg-gray-100 hover:bg-gray-100 cursor-default':'cursor-pointer ']"
                    @click.prevent="fetchCustomers(pagination.current_page - 1)"
                    class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                    <span class="sr-only">Previous</span>
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                    </svg>
                </button>
                <span  aria-current="page" class="relative z-10 inline-flex items-center bg-blue-500 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500">
                    {{ pagination.current_page }} / {{pagination.last_page}}
                </span>
                <button
                    :disabled="pagination.current_page === pagination.last_page"
                    :class="[pagination.current_page === pagination.last_page?'bg-gray-100 hover:bg-gray-100 cursor-default':'cursor-pointer']"
                    @click.prevent="fetchCustomers(pagination.current_page + 1)"
                    class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                    <span class="sr-only">Next</span>
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                    </svg>
                </button>
            </nav>

        </div>
<!--        End of Pagination-->
    </div>

</template>

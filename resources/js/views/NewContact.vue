<script setup>
import { useRouter } from 'vue-router'
const router = useRouter()
import {onMounted, ref} from "vue";
import {storeToRefs} from "pinia";

import AddButton from "../components/AddButton.vue";

// ----
import { useContactsStore } from '../stores/contacts'
const store = useContactsStore()
const {createContact, fetchAllCustomers} = store
const { newContact, all_customers } = storeToRefs(store)

// ---- select Customer
function onChange(event){
    const selectElement = event.target;
    const id= selectElement.value;
    const selectedIndex = selectElement.selectedIndex;
    const name = selectElement.options[selectedIndex].text;

    newContact.value.customer_id= id;
    newContact.value.customer_name=name;
}

onMounted(async() => {
    await fetchAllCustomers();

    // if we come from contact than we need to be able to change the customer that's why we make fromCustomer to false
    if (router.options.history.state.back===`\/contacts`){
        newContact.value.fromCustomer=false
    }
});

</script>
<template>
    <div class="relative flex flex-col items-center justify-center w-[400px] bg-gray-50 border rounded-md p-4">

        <div @click="$router.back()" class="absolute top-2 right-2 ">
                <span class="flex items-center justify-center w-7 h-7 bg-gray-100 rounded-full text-gray-900 hover:bg-gray-200 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20" fill="currentColor"
                         class="w-6 h-6">
                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                    </svg>
                </span>
        </div>

        <div class="inline-block px-6 py-3 bg-gray-200 rounded-t-md">
            <h3 class="h3-kj">Create new Contact</h3>
        </div>

        <div class="flex flex-col w-[300px] justify-around pt-4 gap-y-2">

            <div>
                <label class="label-kj" for="first-name">First name</label>
                <input v-model="newContact.first_name" type="text" id="first-name" class="input-kj" >
            </div>
            <div>
                <label class="label-kj" for="last-name">Last name:</label>
                <input v-model="newContact.last_name" type="text" id="last-name" class="input-kj">
            </div>

            <div v-if="!newContact.customer_id || !newContact.fromCustomer">
                <label class="label-kj" for="related-customer">Related Customer:</label>
                <select class="input-kj" name="cars" id="related-customer" @change="onChange($event)">
                    <option></option>
                    <option v-for="customer in all_customers" :key="customer" :value="customer.id">{{ customer.name }}</option>
                </select>
            </div>
            <div v-else>
                <label class="label-kj" for="related-customer">Related Customer:</label>
                <input disabled :value="newContact.customer_name" type="text" id="related-customer" class="disabled-input-kj">
            </div>

            <div>
                <label class="label-kj" for="telephone">Telephone:</label>
                <input v-model="newContact.telephone" type="text" id="telephone" class="input-kj">
            </div>
            <div>
                <label class="label-kj" for="email">Email:</label>
                <input v-model="newContact.email" type="email" id="email" class="input-kj">
            </div>

        </div>

        <div class="pt-4 flex justify-center">
            <AddButton @click="createContact" button-name="Create Contact" />
        </div>

    </div>
</template>

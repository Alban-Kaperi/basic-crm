<script setup>
import {storeToRefs} from "pinia";
import AddNewContact from "../../AddButton.vue";
import {useRouter} from 'vue-router'
import {ref, onMounted} from "vue";
const router = useRouter()

// ----- Import the contacts store
import { useContactsStore } from '../../../stores/contacts'
const store = useContactsStore()
const {deleteContact, fetchContact, createContactFromCustomers} = store
const {newContact}= storeToRefs(store)

// ----- Import the customer store
import { useCustomersStore } from '../../../stores/customers'
import CreateContact from "../../AddButton.vue";
const customerStore = useCustomersStore()
const {fetchCustomer} = customerStore
const { selectedCustomer } = storeToRefs(customerStore)

/*
 * First we mount the customer_id to the newContact property in contacts store, it will be needed when creating new contact
 * so that we disable the customer field and make it clickable for the user
 */
onMounted(()=>{
    newContact.value.customer_id = selectedCustomer.value.id
})

// ----- Open create new contact panel
const createContactIsOpen= ref(false)

// ----- Delete selected Contact from table and from database
const deleteSelectedContact=async (index,id)=>{
    selectedCustomer.value.contacts.splice(index, 1)
    await deleteContact(id)
}

// ---- Create new contact for the selected customer
async function createContact(){
    const response = await createContactFromCustomers();

    // check if the deletion was successful
    if (response ===true){

        // close the web-form to create new contact
        createContactIsOpen.value=false

        // ---- refresh the view
        await fetchCustomer(selectedCustomer.value.id)

        // reset the newContact in contacts store to empty values
        newContact.value={
            first_name: "",
            last_name: "",
            telephone: "",
            customer_id: "",
            customer_name:"",
            fromCustomer:false,
            email: "",
        }
    }
}
</script>

<template>

    <div>
<!--    Add new Contact, this button opens the web-form to create new a contact -->
        <div class="flex justify-end">
            <AddNewContact @click="createContactIsOpen=true" button-name="New Contact"/>
        </div>
<!--    Contacts Table-->
        <div v-if="selectedCustomer.contacts.length>0" class="flex overflow-y-hidden relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="flex overflow-y-auto h-[400px] w-full">
                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th class="px-6 py-3 bg-gray-200">
                            Contact name
                        </th>
                        <th class="px-6 py-3 bg-gray-200 text-center">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-white border-b" v-for="(contact,i) in selectedCustomer.contacts" :key="contact">
                        <td class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <label for="apple" class="pl-4 w-full">{{contact.first_name}}</label>
                        </td>
                        <td class="py-4">
                            <div class="flex justify-center items-center">
                            <span
                                class="flex justify-center items-center h-7 w-7 p-1 border rounded-full cursor-pointer hover:bg-gray-100"
                                @click="deleteSelectedContact(i,contact.id)"
                            >
                            <svg class="h-4 w-4 text-red-600 flex items-center justify-center" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </span>

                                <div class="w-4"></div>
                                <span
                                    class="flex justify-center items-center h-7 w-7 p-1 border rounded-full cursor-pointer hover:bg-gray-100"
                                    @click="fetchContact(contact.id)"
                                >
                            <svg class="h-4 w-4 text-green-600 flex items-center justify-center" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>

                        </span>
                            </div>

                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>


<!--    Create new contact for the customer-->
        <div v-if="createContactIsOpen" class="absolute top-0 left-0 w-full h-full bg-black z-30">
            <div @click="createContactIsOpen=false" class="absolute top-2 right-2 ">
                <span class="flex items-center justify-center w-7 h-7 bg-gray-100 rounded-full text-gray-900 hover:bg-gray-200 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20" fill="currentColor"
                         class="w-6 h-6">
                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                    </svg>
                </span>
            </div>

            <div class="flex flex-col h-full justify-center items-center bg-gray-100">

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

                    <div>
                        <label class="label-kj" for="related-customer">Related Customer:</label>
                        <input disabled :value="selectedCustomer.name" type="text" id="related-customer" class="disabled-input-kj">
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

<!--            create the contact-->
                <div class="pt-4 flex justify-center">
                    <CreateContact @click="createContact()" button-name="Create Contact" />
                </div>
            </div>


        </div>

    </div>
</template>

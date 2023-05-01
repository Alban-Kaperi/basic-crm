<script setup>
import SaveContactButton from "../SaveButton.vue";

// ----- Pinia functions
import { storeToRefs } from 'pinia'
import { useContactsStore } from '../../stores/contacts'
const store = useContactsStore()
const {updateContact} = store

// ----- Get Customers, pagination, searchTerm values in interactive way.
const { selectedContact } = storeToRefs(store)
</script>
<template>
    <div class="w-[420px] p-2 px-6">
        <div class="inline-block px-6 py-3 bg-gray-200 rounded-t-md">
            <h3 class="h3-kj">Edit Contact Details</h3>
        </div>

        <div class="flex flex-col justify-around pt-4 gap-y-4">

            <div>
                <label class="label-kj" for="first_name">First Name</label>
                <input v-model="selectedContact.first_name" type="text" id="first_name" class="input-kj">
            </div>
            <div>
                <label class="label-kj" for="last_name">Last Name:</label>
                <input v-model="selectedContact.last_name" type="text" id="last_name" class="input-kj">
            </div>
            <div>
                <label class="label-kj" for="related-customer">Related Customer:</label>
                <input disabled :value="selectedContact.customer.name" type="text" id="related-customer" class="disabled-input-kj">
            </div>
            <div>
                <label class="label-kj" for="telephone">Telephone:</label>
                <input v-model="selectedContact.telephone" type="text" id="telephone" class="input-kj">
            </div>
            <div>
                <label class="label-kj" for="email">Email:</label>
                <input v-model="selectedContact.email" type="email" id="email" class="input-kj">
            </div>

        </div>

        <div class="pt-4 flex justify-center">
            <SaveContactButton button-name="Update Contact" @click="updateContact(selectedContact.id)" />
        </div>

    </div>
</template>

<script setup>
import CustomerContactsTable from "./CustomerContactsTable.vue";
import SaveCustomerButton from "../../SaveButton.vue";

// ---- Use Pinia customer store
import { storeToRefs } from 'pinia'
import { useCustomersStore } from '../../../stores/customers'
const store = useCustomersStore()
// Get updateCustomer method
const {updateCustomer} = store
// ----- Get Customers, pagination, searchTerm values in interactive way.
const { selectedCustomer } = storeToRefs(store)

</script>
<template>
    <div class="">

        <div class="inline-block px-6 py-3 bg-gray-200 rounded-t-md">
            <h3 class="h3-kj">Edit Customer Details</h3>
        </div>

        <div class="flex gap-x-8 pt-6 px-4">
            <!-- first Column Personal Details-->
            <div class="flex flex-col w-5/12 gap-y-4">
                <h3 class="h3-kj">Personal Details</h3>

                <div class="pt-2">
                    <label class="label-kj" for="name">Name</label>
                    <input type="text" id="name" class="input-kj" v-model="selectedCustomer.name"></div>
                <div>
                    <label class="label-kj" for="address">Address:</label>
                    <input v-model="selectedCustomer.address" type="text" id="address" class="input-kj">
                </div>
                <div>
                    <label class="label-kj" for="postal_code">Postal code:</label>
                    <input v-model="selectedCustomer.postal_code" type="text" id="postal_code" class="input-kj">
                </div>
                <div>
                    <label class="label-kj" for="place">Place:</label>
                    <input v-model="selectedCustomer.place" type="text" id="place" class="input-kj">
                </div>
                <div>
                    <label class="label-kj" for="telephone">Telephone:</label>
                    <input v-model="selectedCustomer.telephone" type="text" id="telephone" class="input-kj">
                </div>
                <div>
                    <label class="label-kj" for="email">Email:</label>
                    <input v-model="selectedCustomer.email" type="email" id="email" class="input-kj">
                </div>

            </div>

            <!-- second column Contacts Table-->
            <div class="flex flex-col w-7/12">
                <h3 class="h3-kj">Contacts List</h3>
                <CustomerContactsTable/>
            </div>

        </div>

    </div>

    <!--            Gray Divider-->
    <div class="h-0.5 my-2 bg-gray-100"></div>

    <!--Update Customer-->
    <div class="pt-4 flex justify-center">
        <SaveCustomerButton button-name="Update Customer" @click="updateCustomer(selectedCustomer.id)" />
    </div>
</template>

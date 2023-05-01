import { defineStore } from 'pinia'
import axios from "axios";
import router from '../router';
import { notify } from "@kyvg/vue3-notification";
import { handleErrors } from "../utils/utils";

const baseURL= "api/customers";
export const useCustomersStore = defineStore('customers', {
    state: () => ({
        customers:[],
        searchTerm:'',
        pagination:{},
        selectedCustomer: null,
        newCustomer: {
            name: "",
            address: "",
            postal_code: "",
            place: "",
            telephone: "",
            email: "",
        },
        deletedCustomer:null,
        updatedCustomer:null,
        createdCustomer:null,
    }),
    getters: {
        //
    },
    actions: {
        async fetchCustomers(page = 1, search=''){
            const url= baseURL+`/search/?page=${page}&&search=${search}`
            try {
                const response = await axios.get(url);
                // load customers
                this.customers = response.data.data;
                // load pagination
                this.pagination = response.data;
            } catch (error) {
                handleErrors(error);
            }
        },

        async fetchCustomer(customerId=1){
            const url= baseURL+`/${customerId}`
            try {
                const response = await axios.get(url);
                this.selectedCustomer = response.data;
                await router.push({name: "edit-customer"});
            } catch (error) {
                handleErrors(error);
            }
        },

        async createCustomer() {

            try {
                await axios.post(baseURL, this.newCustomer);

                notify({
                    title: "Success",
                    text: "Customer successfully created!",
                    type: "success",
                });

                this.newCustomer={}
                router.back();

            } catch (error) {
                handleErrors(error);
            }
        },

        async updateCustomer(customerId=1){
            const url = baseURL+`/${customerId}`

            try {
                const response = await axios({
                    method:'put',
                    url:url,
                    data:{
                        name: this.selectedCustomer.name,
                        address: this.selectedCustomer.address,
                        postal_code: this.selectedCustomer.postal_code,
                        place: this.selectedCustomer.place,
                        telephone: this.selectedCustomer.telephone,
                        email: this.selectedCustomer.email
                    },
                });

                await this.fetchCustomers()
                notify({
                    title: "Success",
                    text: "Customer successfully updated!",
                    type: "success",
                });
                router.back();
            } catch (error) {
                handleErrors(error);
            }
        },

        async deleteCustomer(customerId=1){
            const url = baseURL+`/${customerId}`
            try {
                const response = await axios.delete(url)
                await this.fetchCustomers()

                notify({
                    title: "Success",
                    text: "Customer successfully deleted!",
                    type:"success",
                });

            } catch (error) {
                handleErrors(error);
            }
        }

    },
})

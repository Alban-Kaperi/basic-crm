import { defineStore } from 'pinia'
import axios from "axios";
import router from '../router';
import { notify } from "@kyvg/vue3-notification";
import { handleErrors } from "../utils/utils";

const baseURL= "api/contacts";
export const useContactsStore = defineStore('contacts', {
    state: () => ({
        all_customers:[],
        contacts:[],
        searchTerm:'',
        pagination:{},
        selectedContact: null,
        newContact: {
            first_name: "",
            last_name: "",
            telephone: "",
            customer_id: "",
            customer_name:"",
            fromCustomer:false,
            email: "",
        },
    }),
    getters: {
        //
    },
    actions: {
        async fetchContacts(page = 1, search=''){
            const url= baseURL+`/search/?page=${page}&&search=${search}`
            try {
                const response = await axios.get(url);
                // load contacts
                this.contacts = response.data.data;
                // load pagination
                this.pagination = response.data;
            } catch (error) {
                handleErrors(error);
            }
        },

        async fetchAllCustomers(){
            const url= 'api/customers'
            try {
                const response = await axios.get(url);
                this.all_customers = response.data
            } catch (error) {
                handleErrors(error);
            }
        },

        async fetchContact(contactId=1){
            const url= baseURL+`/${contactId}`
            try {
                const response = await axios.get(url);
                this.selectedContact = response.data;
                await router.push({name: "edit-contact"});
            } catch (error) {
                handleErrors(error);
            }
        },

        async createContact() {

            try {
                console.log(this.newContact)
                const response = await axios.post(baseURL, this.newContact);

                notify({
                    title: "Success",
                    text: "Contact successfully created!",
                    type: "success",
                });
                this.newContact={}

                router.back();
            } catch (error) {
                handleErrors(error);
            }
        },

        async updateContact(contactId=1){
            const url = baseURL+`/${contactId}`

            try {
                const response = await axios({
                    method:'put',
                    url:url,
                    data:{
                        first_name: this.selectedContact.first_name,
                        last_name: this.selectedContact.last_name,
                        customer_id:this.selectedContact.customer_id,
                        telephone: this.selectedContact.telephone,
                        email: this.selectedContact.email
                    },
                });

                await this.fetchContacts()
                notify({
                    title: "Success",
                    text: "Contact successfully updated!",
                    type: "success",
                });

                router.back();
            } catch (error) {
                handleErrors(error);
            }
        },
        async deleteContact(contactId=1){
            const url = baseURL+`/${contactId}`

            try {
                const response = await axios.delete(url)

                await this.fetchContacts()
                notify({
                    title: "Success",
                    text: "Contact successfully deleted!",
                    type:"success",
                });
            } catch (error) {
                handleErrors(error);
            }
        },

        // this method will be used when we are inside edit-customer, and we are creating new contacts
        async createContactFromCustomers() {
            try {
                await axios.post(baseURL, this.newContact);

                notify({
                    title: "Success",
                    text: "Contact successfully created!",
                    type: "success",
                });

                return true

            } catch (error) {
                handleErrors(error);
                return false
            }
        },

    },
})

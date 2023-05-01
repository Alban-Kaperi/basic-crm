<script setup>
import SideBar from "./components/layout/SideBar.vue"
import NavBar from "./components/layout/NavBar.vue";
</script>

<template>
    <div class="flex w-full h-screen">
        <side-bar></side-bar>

        <div class="w-full flex-col">
            <nav-bar></nav-bar>
            <!-- Here goes the Content-->
            <div class="flex justify-center items-center h-forCustomerDetails">
                <router-view > </router-view>
            </div>

        </div>
        <notifications position="bottom right" />
    </div>
</template>

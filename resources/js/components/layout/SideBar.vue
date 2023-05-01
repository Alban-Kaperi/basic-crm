<template>
    <div class="flex flex-col w-80 bg-gray-100 shadow-md border-r border-gray-100">
        <div class="flex w-full h-16 items-center justify-center bg-gray-300">
            <img src="../../assets/images/logoKJ.png" class="h-8" alt="">
        </div>

        <div class="flex flex-col pt-4 px-2 gap-y-2">
            <router-link
                :to="{ name: 'customers'}"
                class="flex items-center text-gray-600 py-3 px-4 w-full rounded-md"
                exact-active-class="bg-gray-200 text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor"
                     class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>

                <span class="pl-3 text-xs uppercase">Customers</span>
            </router-link>

            <router-link
                :to="{ name: 'contacts'}"
                class="flex items-center text-gray-600 py-3 px-4 w-full rounded-md"
                exact-active-class="bg-gray-200 text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor"
                     class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>

                <span class="pl-3 text-xs uppercase text-gray-600">Contacts</span>
            </router-link>

<!--            <router-link-->
<!--                :to="{ name: 'new-customer'}"-->
<!--                class="flex items-center text-gray-600 py-3 px-4 w-full rounded-md"-->
<!--                exact-active-class="bg-gray-200 text-gray-800">-->
<!--                <svg xmlns="http://www.w3.org/2000/svg" fill="none"-->
<!--                     viewBox="0 0 24 24"-->
<!--                     stroke-width="1.5"-->
<!--                     stroke="currentColor"-->
<!--                     class="w-4 h-4">-->
<!--                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />-->
<!--                </svg>-->

<!--                <span class="pl-3 text-xs uppercase text-gray-600">new customer</span>-->
<!--            </router-link>-->

<!--            <router-link-->
<!--                :to="{ name: 'new-contact'}"-->
<!--                class="flex items-center text-gray-600 py-3 px-4 w-full rounded-md"-->
<!--                exact-active-class="bg-gray-200 text-gray-800">-->
<!--                <svg xmlns="http://www.w3.org/2000/svg" fill="none"-->
<!--                     viewBox="0 0 24 24"-->
<!--                     stroke-width="1.5"-->
<!--                     stroke="currentColor"-->
<!--                     class="w-4 h-4">-->
<!--                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />-->
<!--                </svg>-->

<!--                <span class="pl-3 text-xs uppercase text-gray-600">new contact</span>-->
<!--            </router-link>-->

        </div>

    </div>
</template>

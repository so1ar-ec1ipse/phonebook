<template>
    <div class="min-w-full overflow-hidden overflow-x-auto align-middle sm:rounded-md">
        <div class="flex mb-4 place-content-end">
            <div class="px-4 py-2 text-white bg-indigo-600 rounded-md cursor-pointer hover:bg-indigo-700">
                <router-link :to="{ name: 'contacts.create' }" class="text-sm font-medium">Create contact</router-link>
            </div>
        </div>

        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">#</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">First name</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Last name</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Middle name</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Email</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Title</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Number</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Created</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                <tr class="bg-white">
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap"></td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        <input type="text"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="criteria.first_name">
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        <input type="text"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="criteria.last_name">
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        <input type="text"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="criteria.middle_name">
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        <input type="text"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="criteria.email">
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        <input type="text"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="criteria.title">
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        <input type="text"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            v-model="criteria.number">
                    </td>
                    <td></td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                        <button @click.prevent="searchContact()"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
                            Search
                        </button>
                    </td>
                </tr>
                <template v-for="item in contacts" :key="item.id">
                    <tr class="bg-white">
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ item.id }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ item.first_name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ item.last_name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ item.middle_name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ item.email }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ item.title }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ item.default_phone_number }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ convertISOFormat2Date(item.created_at) }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            <router-link :to="{ name: 'contacts.edit', params: { id: item.id } }"
                                         class="inline-flex items-center px-4 py-2 mr-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
                                Edit
                            </router-link>
                            <button @click="deleteContact(item.id)"
                                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
                                Delete
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import useContacts from "@/composables/contacts";
import { onMounted } from "vue";
import { convertISOFormat2Date } from '../../utils/datetime.js'

const { contacts, getContacts, destroyContact, searchContact, criteria } = useContacts();

onMounted(() => {
    getContacts();
})

const deleteContact = async (id) => {
    if (!window.confirm('Are you sure?')) {
        return
    }
    await destroyContact(id);
    await getContacts();
}
</script>

<template>
    <div v-if="errors">
        <div v-for="(v, k) in errors" :key="k" class="px-4 py-2 pr-0 mb-4 font-bold text-white bg-red-400 rounded shadow-lg">
            <p v-for="error in v" :key="error" class="text-sm">
                {{ error }}
            </p>
        </div>
    </div>

    <form class="space-y-6" v-on:submit.prevent="saveContact">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
                <div class="mt-1">
                    <input type="text" name="first_name" id="first_name"
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="contact.first_name">
                </div>
            </div>

            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
                <div class="mt-1">
                    <input type="text" name="last_name" id="last_name"
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="contact.last_name">
                </div>
            </div>

            <div>
                <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle name</label>
                <div class="mt-1">
                    <input type="text" name="middle_name" id="middle_name"
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="contact.middle_name">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="mt-1">
                    <input type="text" name="email" id="email"
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="contact.email">
                </div>
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <div class="mt-1">
                    <input type="text" name="title" id="title"
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="contact.title">
                </div>
            </div>

            <div>
                <label for="prefix" class="block text-sm font-medium text-gray-700">Prefix</label>
                <div class="mt-1">
                    <select v-model="contact.prefix">
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Ms">Ms</option>
                        <option value="Miss">Miss</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="suffix" class="block text-sm font-medium text-gray-700">Suffix</label>
                <div class="mt-1">
                    <select v-model="contact.suffix">
                        <option value="Jr">Jr</option>
                        <option value="Sr">Sr</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                    </select>
                </div>
            </div>

            <table class="min-w-full border divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50">
                            <span class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Phone Number</span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50">
                            <span class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Phone Type</span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50">
                            <span class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Default</span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50">
                            <span class="text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase">Added</span>
                        </th>
                        <th class="px-6 py-3 bg-gray-50">
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                    <template v-for="(item, idx) in contact.phone_numbers">
                        <tr class="bg-white">
                            <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                <input type="text"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    v-model="item.number">
                            </td>
                            <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                <select v-model="item.phone_type">
                                    <option value="Home">Home</option>
                                    <option value="Office">Office</option>
                                    <option value="Mobile">Mobile</option>
                                    <option value="Fax">Fax</option>
                                </select>
                            </td>
                            <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                <input type="checkbox"
                                    class="block mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    v-model="item.is_default">
                            </td>
                            <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                {{ convertISOFormat2Date(item.created_at) }}
                            </td>
                            <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                <!-- <router-link :to="{ name: 'contacts.edit', params: { id: item.id } }"
                                            class="inline-flex items-center px-4 py-2 mr-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
                                    Edit
                                </router-link> -->
                                <button @click.prevent="deletePhoneNumber(idx)"
                                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25"
                                        :disabled="contact.phone_numbers.length <= 1">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    </template>
                    <tr class="bg-white">
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            <button @click.prevent="addPhoneNumber"
                                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25">
                                Create
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md ring-gray-300 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Save
        </button>
    </form>
</template>

<script setup>
import useContacts from "@/composables/contacts";
import { onMounted } from "vue";
import { convertISOFormat2Date } from '../../utils/datetime.js'

const { errors, contact, getContact, updateContact, addPhoneNumber, deletePhoneNumber } = useContacts()
const props = defineProps({
    id: {
        required: true,
        type: String
    }
})

onMounted(() => {
    getContact(props.id)
})

const saveContact = async () => {
    await updateContact(props.id)
}
</script>

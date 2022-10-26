<template>
    <div v-if="errors">
        <div v-for="(v, k) in errors" :key="k" class="px-4 py-2 pr-0 mb-4 font-bold text-white bg-red-400 rounded shadow-lg">
            <p v-for="error in v" :key="error" class="text-sm">
                {{ error }}
            </p>
        </div>
    </div>

    <form class="space-y-6" @submit.prevent="saveContact">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First name *</label>
                <div class="mt-1">
                    <input type="text" name="first_name" id="first_name"
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.first_name">
                </div>
            </div>

            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last name *</label>
                <div class="mt-1">
                    <input type="text" name="last_name" id="last_name"
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.last_name">
                </div>
            </div>

            <div>
                <label for="middle_name" class="block text-sm font-medium text-gray-700">Middle name</label>
                <div class="mt-1">
                    <input type="text" name="middle_name" id="middle_name"
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.middle_name">
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                <div class="mt-1">
                    <input type="text" name="email" id="email"
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.email">
                </div>
            </div>

            <div>
                <label for="middle_name" class="block text-sm font-medium text-gray-700">Title</label>
                <div class="mt-1">
                    <input type="text" name="title" id="title"
                           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.title">
                </div>
            </div>

            <div>
                <label for="prefix" class="block text-sm font-medium text-gray-700">Prefix</label>
                <div class="mt-1">
                    <select v-model="form.prefix">
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
                    <select v-model="form.suffix">
                        <option value="Jr">Jr</option>
                        <option value="Sr">Sr</option>
                        <option value="I">I</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                    </select>
                </div>
            </div>

            <div class="flex gap-5 mt-40">
                <div>
                    <label for="number" class="block text-sm font-medium text-gray-700">Phone Number *</label>
                    <div class="mt-1">
                        <input type="text" name="number" id="number"
                               class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               v-model="form.default_phone_number.number">
                    </div>
                </div>
                <div>
                    <label for="phone_type" class="block text-sm font-medium text-gray-700">Phone Type *</label>
                    <div class="mt-1">
                        <select v-model="form.default_phone_number.phone_type">
                            <option value="Home">Home</option>
                            <option value="Office">Office</option>
                            <option value="Mobile">Mobile</option>
                            <option value="Fax">Fax</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col">
                    <label for="is_default" class="block text-sm font-medium text-gray-700">Set as default</label>
                    <div class="flex items-center justify-center mt-1 grow">
                        <input type="checkbox" name="is_default" id="is_default"
                               class="block mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                               v-model="form.default_phone_number.is_default">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md ring-gray-300 hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Create
        </button>
    </form>
</template>

<script setup>
import { reactive } from "vue";
import useContacts from "@/composables/contacts";

const form = reactive({
    'first_name': '',
    'last_name': '',
    'email': '',
    'middle_name': '',
    'title': '',
    'prefix': '',
    'suffix': '',
    'default_phone_number': {
        'number': '',
        'phone_type': 'Home',
        'is_default': true,
    },
})
const { errors, storeContact } = useContacts()
const saveContact = async () => {
    await storeContact({ ...form });
}
</script>

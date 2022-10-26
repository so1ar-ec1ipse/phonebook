import { ref, watch } from 'vue'
import axios from "axios";
import { useRouter } from 'vue-router';

export default function useContacts() {
    const contacts = ref([])
    const contact = ref([])
    const router = useRouter()
    const errors = ref('')
    const criteria = ref({
        first_name: '',
        last_name: '',
        middle_name: '',
        email: '',
        title: '',
        number: '',
    })

    const getContacts = async () => {
        let response = await axios.get('/api/contacts')
        contacts.value = response.data.data;
    }

    const searchContact = async () => {
        let response = await axios.get('/api/contacts/search' +
                '?first_name=' + criteria.value.first_name +
                '&last_name=' + criteria.value.last_name +
                '&middle_name=' + criteria.value.middle_name +
                '&email=' + criteria.value.email +
                '&title=' + criteria.value.title +
                '&number=' + criteria.value.number
            );

        contacts.value = response.data.data;
    }

    const getContact = async (id) => {
        let response = await axios.get('/api/contacts/' + id)
        contact.value = response.data.data;
    }

    const storeContact = async (data) => {
        errors.value = ''
        try {
            await axios.post('/api/contacts/', data)
            await router.push({name: 'contacts.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const updateContact = async (id) => {
        errors.value = ''

        const numberOfDefault = contact.value.phone_numbers.reduce((prev, curr, idx) => {
            if (curr.is_default) return prev + 1;
            return prev;
        }, 0);
        if (numberOfDefault !== 1) {
            errors.value = { is_default: ['There must be only one default number']};
            return
        }

        try {
            await axios.put('/api/contacts/' + id, contact.value)
            await router.push({name: 'contacts.index'})
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    const destroyContact = async (id) => {
        await axios.delete('/api/contacts/' + id)
    }

    const addPhoneNumber = () => {
        contact.value.phone_numbers.push({
            'number': '',
            'phone_type': 'Home',
            'is_default': false,
        });
    }

    const deletePhoneNumber = (idx) => {
        // const idx = contact.value.phone_numbers.findIndex((phoneNumber) => (phoneNumber.id === phoneNumberId))
        contact.value.phone_numbers.splice(idx, 1);
    }

    // watch(() => contact.value.phone_numbers, (first, second) => {
    //     console.log(
    //         first,
    //         second
    //     );
    // }, {deep: true});
    
    return {
        contacts,
        contact,
        errors,
        criteria,
        getContacts,
        searchContact,
        getContact,
        storeContact,
        updateContact,
        destroyContact,

        addPhoneNumber,
        deletePhoneNumber,
    }
}

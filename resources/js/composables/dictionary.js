import {ref} from 'vue';
import axios from 'axios';

export default function useDictionary(language = 'vi-en') {

    const WORD_URI = () => {
        switch (language) {
            case 'en-vi':
                return '/api/english'
            case 'vi-en':
                return '/api/vietnamese'
            default:
                return '/api/vietnamese'
        }
    };

    const words = ref([])
    const word = ref([])

    const getWords = async () => {
        let response = await axios.get(WORD_URI())
        words.value = response.data.data
    }

    const getWord = async (id) => {
        let response = await axios.get(WORD_URI() + id)
        word.value = response.data.data
    }

    const lookUpFromDictionary = async (text) => {
        let url = WORD_URI() + `?text=${text}`
        let response = await axios.get(url)
        words.value = response.data.data
    }

    return {
        words,
        word,
        getWords,
        getWord,
        lookUpFromDictionary
    }
}

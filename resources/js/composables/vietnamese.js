import {ref} from 'vue';
import axios from 'axios';

export default function useVietnameseWord() {

    const VIET_WORD_URI = '/api/vietnamese/';

    const words = ref([]);
    const word = ref([]);

    const getWords = async () => {
        let response = await axios.get(VIET_WORD_URI);
        words.value = response.data.data;
    }

    const getWord = async (id) => {
        let response = await axios.get(VIET_WORD_URI + id);
        word.value = response.data.data;
    }

    return {
        words,
        word,
        getWords,
        getWord
    }
}

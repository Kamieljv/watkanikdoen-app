import {v4 as uuidFunc} from 'uuid';

export const uuid = {
  data() {
    return {
      id: '',
    };
  },
  mounted() {
    this.id = uuidFunc();
  },
};
import streamlineWorker from '../utils/streamlineWorker';
// import AsyncStorage from '@react-native-community/async-storage';

const HEADERS = {
  DEFAULT_HEADER: {
    // 'Content-Type': 'application/json; charset=UTF-8',
    // RefreshToken: bviWorker.getRefreshToken(),
  },
  header: () => {
    return {
      'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
      Authorization: 'Bearer ' + streamlineWorker.getToken(),
    };
  },
  FORM_DATA: {
    // Accept: 'application/json',
    'Content-Type': 'multipart/form-data',
  },
  FORM_DATA_AUDIO: {
    // Accept: 'application/json',
    'Content-Type': 'audio/mp3',
  },
};

export const API_URLS = {
  LOGIN: {
    createUser: () => ({
      endPoint: '/v2/registerUser',
      method: 'POST',
      headers: HEADERS.DEFAULT_HEADER,
    }),
  },
  TREATLET: {
    getListTrealet: token => ({
      endPoint: '/v2/stepquest/user?user_id=190',
      method: 'GET',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
        Authorization: 'Bearer ' + token,
      },
    }),
  },
  STREAMLINE: {
    uploadImage: () => ({
      endPoint: '/v2/uploadImage',
      method: 'POST',
      headers: HEADERS.FORM_DATA,
    }),
    uploadAudio: () => ({
      endPoint: '/v2/uploadAudio',
      method: 'POST',
      headers: HEADERS.FORM_DATA,
    }),
    postData: () => ({
      endPoint: '/v2/input/play/data',
      method: 'POST',
      headers: HEADERS.FORM_DATA,
    }),
  },
};

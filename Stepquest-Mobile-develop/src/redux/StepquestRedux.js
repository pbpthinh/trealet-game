import {API_URLS} from '../config/api';
import {apiCall} from '../config/apiCall';
import {showMessage, hideMessage} from 'react-native-flash-message';

const types = {
  PLAY_STREAMLINE: 'PLAY_STREAMLINE',
  CREATE_LIST: 'CREATE_LIST',
  UPADTE_LIST: 'UPADTE_LIST',

  UPLOAD_IMAGE: 'UPLOAD_IMAGE',
  UPLOAD_AUDIO: 'UPLOAD_AUDIO',
  POST_DATA: 'POST_DATA',

  CLEAN_DATA: 'CLEAN_DATA',

  END_PLAY: 'END_PLAY',

  CLEAN_PLAY: 'CLEAN_PLAY',
};

export const actions = {
  CreateListPlay: list => async dispatch => {
    console.log('okeokeoke');
    console.log(list);
    const listPlay = list.map(item => {
      const play = item.json.trealet.items.map(item => ({
        isPlay: false,
        isScore: 0,
        data: null,
      }));
      return {
        id: item.id,
        isPlay: false,
        score: 0,
        isDone: false,
        play,
      };
    });
    dispatch({
      type: types.CREATE_LIST,
      payload: listPlay,
    });
  },
  updateList: (id, index, score, data) => async dispatch => {
    dispatch({
      type: types.UPADTE_LIST,
      payload: {
        id: id,
        index: index,
        score,
        data,
      },
    });
  },
  playStreamline: streamline => async dispatch => {
    dispatch({
      type: types.PLAY_STREAMLINE,
      payload: streamline,
    });
  },
  uploadImage: (id, index, score, image) => async dispatch => {
    console.log(image);
    const api = API_URLS.STREAMLINE.uploadImage();
    const payload = image;
    showMessage({
      message: 'Upload Image Pending',
      type: 'info',
      autoHide: false,
    });
    const {response, error} = await apiCall({...api, payload});
    dispatch({
      type: types.UPLOAD_IMAGE,
      // payload: image,
    });
    if (response.status === 200) {
      await showMessage({
        message: 'Upload Image Done',
        type: 'success',
      });
      dispatch(actions.updateList(id, index, score, response.data.data));
    } else {
      showMessage({
        message: 'Upload Image Failed',
        type: 'danger',
      });
    }
    // dispatch({type: types.CREATE_USER_PENDING
  },
  uploadAudio: (id, index, score, audio) => async dispatch => {
    const api = API_URLS.STREAMLINE.uploadAudio();
    const payload = audio;
    console.log(payload);
    showMessage({
      message: 'Upload Audio Pending',
      type: 'info',
      autoHide: false,
    });
    const {response, error} = await apiCall({...api, payload});
    dispatch({
      type: types.UPLOAD_AUDIO,
    });
    if (response.status === 200) {
      await showMessage({
        message: 'Upload Audio Done',
        type: 'success',
      });
      dispatch(actions.updateList(id, index, score, response.data.data));
    } else {
      showMessage({
        message: 'Upload Audio Failed',
        type: 'danger',
      });
    }
  },
  postData: (id, index, score, data) => async dispatch => {
    dispatch(actions.updateList(id, index, score, data));
  },
  cleanData: () => async dispatch => {
    console.log('clean Data Play');
    dispatch({
      type: types.CLEAN_DATA,
    });
  },

  endPlay: id => async dispatch => {
    dispatch({
      type: types.END_PLAY,
      payload: id,
    });
  },
  cleanPlay: id => async dispatch => {
    console.log(id);
    dispatch({
      type: types.CLEAN_PLAY,
      payload: id,
    });
  },
};

const initialState = {
  dataPlay: null,
  listPlay: null,
};

export const reducer = (state = initialState, action) => {
  switch (action.type) {
    case types.PLAY_STREAMLINE:
      return {
        ...state,
        dataPlay: action.payload,
      };
    case types.CREATE_LIST:
      return {
        ...state,
        listPlay: action.payload,
      };
    case types.UPADTE_LIST:
      const newData = state.listPlay;
      console.log(action.payload);
      newData.forEach(element => {
        if (element.id === action.payload.id) {
          if (
            action.payload.score > 0 &&
            !element.play[action.payload.index].isPlay
          ) {
            element.score = element.score + action.payload.score;
          }
          element.play[action.payload.index].isPlay = true;
          element.play[action.payload.index].data = action.payload.data;
          element.play[action.payload.index].score = action.payload.score;
          console.log(action.payload.index);
          console.log(
            '12321',
            action.payload.index === element.play.length - 1,
          );

          if (action.payload.index === element.play.length - 1) {
            element.isDone = true;
          }
        }
      });
      return {
        ...state,
        listPlay: newData,
      };
    case types.END_PLAY:
      let data = state.listPlay;
      data.forEach(element => {
        element.play[element.play.length - 1].isPlay === true;
        if (
          element.id === action.payload
          // element.play[element.play.length - 1].isPlay === true
        ) {
          console.log(element.play[element.play.length - 1]);
          element.isDone = true;
        }
      });
      return {
        ...state,
        listPlay: data,
      };

    case types.CLEAN_PLAY:
      let data1 = state.listPlay;
      let dataPlayNew = state.dataPlay;
      data1.forEach(item => {
        if (item.id === action.payload) {
          const play = dataPlayNew.json.trealet.items.map(item => ({
            isPlay: false,
            isScore: 0,
            data: null,
          }));

          item.play = play;
          item.isDone = false;
          item.isScore = 0;
          item.score = 0;
        }
      });
      return {
        ...state,
        listPlay: data1,
      };
    case types.CLEAN_DATA:
      return {
        listPlay: null,
        dataPlay: null,
      };
    default:
      return state;
  }
};

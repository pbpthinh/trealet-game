import {API_URLS} from '../config/api';
import {apiCall} from '../config/apiCall';
import {actions as StepquestAction} from './StepquestRedux';
const types = {
  GET_LIST_TREALET_PENDING: 'GET_LIST_TREALET_PENDING',
  GET_LIST_TREALET_SUCCESS: 'GET_LIST_TREALET_SUCCESS',
  GET_LIST_TREALET_FAILURE: 'GET_LIST_TREALET_FAILURE',
  CLEAN_LIST: 'CLEAN_LIST',
};

export const actions = {
  getListTrealet: (token, language, listPlay) => async dispatch => {
    const api = API_URLS.TREATLET.getListTrealet(token);
    dispatch({type: types.GET_LIST_TREALET_PENDING});
    const {response, error} = await apiCall({...api});

    if (response.status === 200) {
      console.log('call api get list success');
      const listData = [];

      response.data.data.forEach(item => {
        item.json = JSON.parse(item.json);
        if (item.json.trealet.language === language) {
          listData.push(item);
        }
        // listData.push(item);
      });
      // console.log(response.data.data);
      dispatch({
        type: types.GET_LIST_TREALET_SUCCESS,
        payload: {
          data: listData,
        },
      });
      const arr = [];
      if (listPlay !== null) {
        listPlay.forEach((item, index) => {
          if (item.id === listData[index].id) {
            arr.push(listData[index]);
          }
        });
      } else {
        dispatch(StepquestAction.CreateListPlay(listData));
      }

      if (
        arr.length !== listData.length &&
        arr.length > 0 &&
        listData.length > 0
      ) {
        if (arr[0].id === listData[0].id) {
          dispatch(StepquestAction.CreateListPlay(listData));
        }
      }
    } else {
      dispatch({type: types.GET_LIST_TREALET_FAILURE});
    }
    // dispatch({type: types.CREATE_USER_PENDING});
  },
  cleanList: () => async dispatch => {
    console.log('clean List');
    dispatch({
      type: types.CLEAN_LIST,
    });
  },
};

const initialState = {
  isFetching: false,
  listTrealet: [],
};

export const reducer = (state = initialState, action) => {
  switch (action.type) {
    case types.GET_LIST_TREALET_PENDING:
      return {
        ...state,
        listTrealet: [],
        isFetching: true,
      };
    case types.GET_LIST_TREALET_SUCCESS:
      return {
        ...state,
        listTrealet: action.payload.data,
        isFetching: false,
      };
    case types.GET_LIST_TREALET_FAILURE:
      return {
        ...state,
        listTrealet: [],
        isFetching: false,
      };
    case types.CLEAN_LIST:
      return {
        listTrealet: [],
        isFetching: false,
      };

    default:
      return state;
  }
};

import {constants} from 'buffer';
import {API_URLS} from '../config/api';
import {apiCall} from '../config/apiCall';
import streamlineWorker from '../utils/streamlineWorker';
import {actions as TrealetAction} from './TrealetRedux';
import {actions as StepquestAction} from './StepquestRedux';
import {showMessage, hideMessage} from 'react-native-flash-message';

const types = {
  CREATE_USER_PENDING: 'CREATE_USER_PENDING',
  CREATE_USER_SUCCESS: 'CREATE_USER_SUCCESS',
  CREATE_USER_FAILURE: 'CREATE_USER_FAILURE',

  LOGOUT_PENDING: 'LOGOUT_PENDING',
  LOGOUT_SUCCESS: 'LOGOUT_SUCCESS',
  LOGOUT_FAILURE: 'LOGOUT_FAILURE',

  CHANGE_LANGUAGE: 'CHANGE_LANGUAGE',
};

export const actions = {
  login: name => async dispatch => {
    console.log(12313);
    const params = {
      username:
        name + '-' + Math.random().toString().substr(2, 5) + '-btvhcdtvn',
      password: '123',
      role: 2,
      email:
        name +
        '-' +
        Math.random().toString().substr(2, 8) +
        '-btvhcdtvn@gmail.com',
    };
    const api = API_URLS.LOGIN.createUser();
    console.log('call api');

    dispatch({type: types.CREATE_USER_PENDING});
    const {response, error} = await apiCall({...api, params});

    if (response.status === 201) {
      console.log('call api succers');
      streamlineWorker.setToken(response.data.token);
      dispatch({
        type: types.CREATE_USER_SUCCESS,
        payload: {
          name,
          token: response.data.token,
        },
      });
    } else {
      showMessage({
        message: 'Login Failed. Connect network',
        type: 'danger',
      });
      dispatch({type: types.CREATE_USER_FAILURE});
    }
    // dispatch({type: types.CREATE_USER_PENDING});
  },
  logout: () => async dispatch => {
    dispatch({type: types.LOGOUT_PENDING});
    dispatch({
      type: types.LOGOUT_SUCCESS,
    });
    dispatch(TrealetAction.cleanList());

    dispatch(StepquestAction.cleanData());
    streamlineWorker.clearToken();
  },
  changeLanguage: language => async dispatch => {
    dispatch({
      type: types.CHANGE_LANGUAGE,
      payload: language,
    });
  },
};

const initialState = {
  name: '',
  isAuth: false,
  token: null,
  language: 'vn',
  isFetching: false,
};

export const reducer = (state = initialState, action) => {
  switch (action.type) {
    case types.CREATE_USER_PENDING:
      return {
        ...state,
        isFetching: true,
      };
    case types.CREATE_USER_SUCCESS:
      return {
        ...state,
        isAuth: true,
        token: action.payload.token,
        name: action.payload.name,
        isFetching: false,
      };
    case types.CREATE_USER_FAILURE:
      return {
        ...state,
        isAuth: false,

        isFetching: false,
      };
    case types.LOGOUT_SUCCESS:
      return {
        ...state,
        name: '',
        isAuth: false,
        token: null,
        isFetching: false,
      };
    case types.CHANGE_LANGUAGE:
      return {
        ...state,
        language: action.payload,
      };
    default:
      return state;
  }
};

import {persistCombineReducers} from 'redux-persist';
import AsyncStorage from '@react-native-async-storage/async-storage';
import {createBlacklistFilter} from 'redux-persist-transform-filter';

import {reducer as LoginReducer} from './LoginRedux';
import {reducer as TrealetReducer} from './TrealetRedux';
import {reducer as StepquestReducer} from './StepquestRedux';

const loginBlacklistFilter = createBlacklistFilter('login', ['isFetching']);
const trealetBlacklistFilter = createBlacklistFilter('trealet', ['isFetching']);
const stepquestBlacklistFilter = createBlacklistFilter('stepquest', [
  'isFetching',
]);

const config = {
  key: 'root',
  storage: AsyncStorage,
  // blacklist: ['netInfo', 'toast'],
  transforms: [
    loginBlacklistFilter,
    trealetBlacklistFilter,
    stepquestBlacklistFilter,
  ],
};
export default persistCombineReducers(config, {
  login: LoginReducer,
  trealet: TrealetReducer,
  stepquest: StepquestReducer,
});

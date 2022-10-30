/* eslint-disable react-hooks/rules-of-hooks */
import Reactotron from 'reactotron-react-native';
import {reactotronRedux as reduxPlugin} from 'reactotron-redux';

Reactotron.configure({name: 'Streamline'});

Reactotron.useReactNative({
  asyncStorage: {ignore: ['secret']},
});

Reactotron.use(reduxPlugin());

if (__DEV__) {
  Reactotron.connect();
  Reactotron.clear();
}

console.tron = Reactotron;

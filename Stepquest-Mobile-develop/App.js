import {
  StyleSheet,
  Text,
  StatusBar,
  LogBox,
  PermissionsAndroid,
} from 'react-native';
import React, {useEffect} from 'react';
import SplashScreen from 'react-native-splash-screen';

import {createNativeStackNavigator} from '@react-navigation/native-stack';
import {enableScreens} from 'react-native-screens';
import {Provider} from 'react-redux';
import {PersistGate} from 'redux-persist/es/integration/react';
import {persistStore} from 'redux-persist';
import Toast from 'react-native-toast-message';

import Router from './src/Router';
import store from './src/configureStore';

enableScreens(false);

LogBox.ignoreLogs([
  "ViewPropTypes will be removed from React Native. Migrate to ViewPropTypes exported from 'deprecated-react-native-prop-types'.",
]);
LogBox.ignoreLogs(['new NativeEventEmitter']);
LogBox.ignoreLogs(['VirtualizedLists should never be nested']);

const Stack = createNativeStackNavigator();

const App = () => {
  useEffect(() => {
    SplashScreen.hide();
  }, []);

  const persistor = persistStore(store);

  return (
    <Provider store={store}>
      <PersistGate persistor={persistor}>
        <Toast />

        <Router />
      </PersistGate>
    </Provider>
  );
};

export default App;

const styles = StyleSheet.create({});

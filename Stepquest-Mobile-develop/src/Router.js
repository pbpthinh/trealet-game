import {
  StyleSheet,
  Text,
  StatusBar,
  LogBox,
  Platform,
  ActivityIndicator,
  PermissionsAndroid,
  View,
} from 'react-native';
import React, {useEffect} from 'react';
import {NavigationContainer} from '@react-navigation/native';
import {createNativeStackNavigator} from '@react-navigation/native-stack';
import StepquestScreen from './screens/Stepquest/StepquestScreen';
import TrealetScreen from './screens/Trealet/TrealetScreen';
import CreateUserScreen from './screens/CreateUser/CreateUserScreen';
import {useSelector, useDispatch} from 'react-redux';
import Permissions from 'react-native-permissions';

const Stack = createNativeStackNavigator();

const Router = () => {
  const {isAuth, isFetching} = useSelector(state => state.login);
  const requestCameraPermission = async () => {
    try {
      const granted = await PermissionsAndroid.request(
        PermissionsAndroid.PERMISSIONS.CAMERA,
        {
          title: 'Cool Photo App Camera Permission',
          message:
            'Cool Photo App needs access to your camera ' +
            'so you can take awesome pictures.',
          buttonNeutral: 'Ask Me Later',
          buttonNegative: 'Cancel',
          buttonPositive: 'OK',
        },
      );
      if (granted === PermissionsAndroid.RESULTS.GRANTED) {
        console.log('You can use the camera');
        requestAudioPermission();
      } else {
        console.log('Camera permission denied');
      }
    } catch (err) {
      console.warn(err);
    }
  };
  const requestAudioPermission = async () => {
    try {
      const granted = await PermissionsAndroid.request(
        PermissionsAndroid.PERMISSIONS.RECORD_AUDIO,
        {
          title: 'Cool Photo App Audio Permission',
          message:
            'Cool Photo App needs access to your audio ' +
            'so you can take awesome pictures.',
          buttonNeutral: 'Ask Me Later',
          buttonNegative: 'Cancel',
          buttonPositive: 'OK',
        },
      );
      if (granted === PermissionsAndroid.RESULTS.GRANTED) {
        console.log('You can use the audio');
        requestStoragePermission();
      } else {
        console.log('Camera permission denied');
      }
    } catch (err) {
      console.warn(err);
    }
  };
  const requestStoragePermission = async () => {
    try {
      const granted = await PermissionsAndroid.request(
        PermissionsAndroid.PERMISSIONS.WRITE_EXTERNAL_STORAGE,
        {
          title: 'Cool Photo App Camera Permission',
          message:
            'Cool Photo App needs access to your camera ' +
            'so you can take awesome pictures.',
          buttonNeutral: 'Ask Me Later',
          buttonNegative: 'Cancel',
          buttonPositive: 'OK',
        },
      );
      if (granted === PermissionsAndroid.RESULTS.GRANTED) {
        console.log('You can use the WRITE_EXTERNAL_STORAGE');
      } else {
        console.log('Camera permission denied');
      }

      const granted2 = await PermissionsAndroid.request(
        PermissionsAndroid.PERMISSIONS.READ_EXTERNAL_STORAGE,
        {
          title: 'Cool Photo App Camera Permission',
          message:
            'Cool Photo App needs access to your camera ' +
            'so you can take awesome pictures.',
          buttonNeutral: 'Ask Me Later',
          buttonNegative: 'Cancel',
          buttonPositive: 'OK',
        },
      );
      if (granted2 === PermissionsAndroid.RESULTS.GRANTED) {
        console.log('You can use the READ_EXTERNAL_STORAGE');
      } else {
        console.log('Camera permission denied');
      }
    } catch (err) {
      console.warn(err);
    }
  };

  useEffect(() => {
    requestCameraPermission();
  }, []);
  return (
    <NavigationContainer>
      {isFetching ? (
        <View
          style={{
            backgroundColor: 'transparent',
            justifyContent: 'center',
            alignItems: 'center',
            height: '100%',
          }}>
          <ActivityIndicator
            style={{backgroundColor: 'transparent', zIndex: 100}}
            size="large"
            color="green"
          />
        </View>
      ) : (
        <Stack.Navigator
          // initialRouteName="CreateUser"
          // screenOptions={{
          //   gestureEnabled: true,
          //   headerShown: false,
          // }}
          screenOptions={{
            gestureEnabled: false,
            headerShown: false,
            animation: 'none',
          }}>
          {!isAuth ? (
            <Stack.Group>
              <Stack.Screen name="CreateUser" component={CreateUserScreen} />
            </Stack.Group>
          ) : (
            <Stack.Group>
              <Stack.Screen name="Trealet" component={TrealetScreen} />
              <Stack.Screen name="Streamline" component={StepquestScreen} />
            </Stack.Group>
          )}
        </Stack.Navigator>
      )}
    </NavigationContainer>
  );
};

export default Router;

const styles = StyleSheet.create({});

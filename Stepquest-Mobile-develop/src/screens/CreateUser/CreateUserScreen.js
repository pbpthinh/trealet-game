import React, {useState, useEffect} from 'react';
import {
  StyleSheet,
  Text,
  View,
  Button,
  TextInput,
  Image,
  SafeAreaView,
  TouchableOpacity,
  StatusBar,
  Alert,
} from 'react-native';
import {Picker} from '@react-native-picker/picker';
import {useSelector, useDispatch} from 'react-redux';
import FlashMessage from 'react-native-flash-message';

import {trans} from '../../language';

import {actions} from '../../redux/LoginRedux';

const CreateUserScreen = ({navigation, route}) => {
  const [name, setName] = useState('');
  const [password, setPassword] = useState('');
  const [picker, setPicker] = useState('');

  const dispatch = useDispatch();

  const {isAuth, token, language} = useSelector(state => state.login);
  // const {listPlay} = useSelector(state => state.streamline);
  // useEffect(() => {
  //   console.log(route);
  //   // if (isAuth && route.name === 'CreateUser') {
  //   //   navigation.push('Trealet');
  //   // }
  // }, [isAuth]);

  const changeLanguage = language => {
    // console.log(listPlay);
    dispatch(actions.changeLanguage(language));
  };

  const onHandleLogin = () => {
    if (name === '') {
      Alert.alert('Thông báo', 'Vui lòng nhập tên để tham gia', [
        {
          text: 'Đồng ý',
          style: 'cancel',
        },
      ]);
    } else {
      dispatch(actions.login(name));
    }
  };
  return (
    <View style={styles.container}>
      {/* <FlashMessage position="top" /> */}

      <Image
        style={styles.backImage}
        source={require('../../assets/images/bgDantoc.jpeg')}
      />
      <View style={styles.whiteSheet} />
      <SafeAreaView style={styles.form}>
        <Text style={styles.title}>
          {trans(language, "The Museum of Cultures of Vietnam's Ethnic Groups")}
        </Text>
        <Text style={styles.lable}>{trans(language, 'InputName')}</Text>
        <TextInput
          style={styles.input}
          placeholder="Xin mời nhập tên"
          autoCapitalize="none"
          keyboardType="email-address"
          textContentType="emailAddress"
          value={name}
          onChangeText={text => setName(text)}
        />
        <Text style={styles.lable}>{trans(language, 'SelectLanguage')}</Text>
        <View style={styles.picker}>
          <Picker
            selectedValue={language}
            style={styles.picker}
            onValueChange={changeLanguage}
            itemStyle={styles.picker}>
            <Picker.Item style={styles.picker} label="Tiếng Việt" value="vn" />
            {/* <Picker.Item style={styles.picker} label="English" value="en" />
            <Picker.Item style={styles.picker} label="France" value="fr" /> */}
          </Picker>
        </View>

        <TouchableOpacity style={styles.button} onPress={onHandleLogin}>
          <Text style={{fontWeight: 'bold', color: '#fff', fontSize: 17}}>
            {trans(language, 'Play')}
          </Text>
        </TouchableOpacity>
        <View
          style={{
            marginTop: 20,
            flexDirection: 'row',
            alignItems: 'center',
            alignSelf: 'center',
          }}>
          {/* <Text style={{color: 'gray', fontWeight: '600', fontSize: 14}}>
            Don't have an account?{' '}
          </Text>
          <TouchableOpacity onPress={() => navigation.navigate('Signup')}>
            <Text style={{color: '#f57c00', fontWeight: '600', fontSize: 14}}>
              {' '}
              Sign Up
            </Text>
          </TouchableOpacity> */}
        </View>
      </SafeAreaView>
      <StatusBar barStyle="light-content" />
    </View>
  );
};

export default CreateUserScreen;

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
  },
  title: {
    fontSize: 40,
    fontWeight: 'bold',
    color: 'green',
    alignSelf: 'center',
    paddingTop: 100,
    paddingBottom: 50,
    textAlign: 'center',
  },
  lable: {
    fontSize: 17,
    marginVertical: 10,
    fontWeight: 'bold',
  },
  input: {
    backgroundColor: '#F6F7FB',
    height: 58,
    marginBottom: 20,
    fontSize: 16,
    borderRadius: 10,
    padding: 12,
  },
  containerPicker: {
    backgroundColor: '#F6F7FB',
    height: 58,
    marginBottom: 20,
    fontSize: 16,
    borderRadius: 10,
    padding: 12,
  },
  picker: {
    backgroundColor: '#F6F7FB',
    height: 58,
    marginBottom: 20,
    fontSize: 16,
    borderRadius: 10,
    paddingHorizontal: 12,
  },
  backImage: {
    width: '100%',
    height: 400,
    position: 'absolute',
    top: 0,
    resizeMode: 'cover',
  },
  whiteSheet: {
    width: '100%',
    height: '80%',
    position: 'absolute',
    bottom: 0,
    backgroundColor: '#fff',
    borderTopRightRadius: 60,
  },
  form: {
    flex: 1,
    justifyContent: 'center',
    marginHorizontal: 30,
  },
  button: {
    backgroundColor: 'green',
    height: 58,
    borderRadius: 10,
    justifyContent: 'center',
    alignItems: 'center',
    marginTop: 20,
  },
});

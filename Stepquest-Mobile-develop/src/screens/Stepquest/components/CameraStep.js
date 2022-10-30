import React, {useState, useCallback} from 'react';
import {StyleSheet, View, Text, Button, Image} from 'react-native';
import * as ImagePicker from 'react-native-image-picker';

const CameraStep = ({data, uploadImage, play, index}) => {
  const [response, setResponse] = useState(null);
  const [image, setImage] = useState(null);

  console.data = data;
  const setData = data => {
    if (data.didCancel) {
      setResponse(null);
      setImage(null);
    } else {
      setResponse(data.assets[0].uri);
      setImage(data.assets[0]);
    }
  };
  const onButtonPress = useCallback((type, options) => {
    setResponse(null);
    if (type === 'capture') {
      ImagePicker.launchCamera(options, setData);
    } else {
      ImagePicker.launchImageLibrary(options, setData);
    }
  }, []);

  const OnUploadImage = async () => {
    const file = {
      uri: image.uri,
      name: image.fileName,
      type: image.type,
      size: image.fileSize,
    };
    const formData = new FormData();
    console.log(file);

    formData.append('picture_file', file);
    await uploadImage(index, parseInt(data.score), formData);
    setResponse(null);
  };
  console.log(data);
  return (
    <View
      style={{
        margin: 20,
        marginHorizontal: 200,
        marginTop: 50,
        justifyContent: 'center',
        alignItems: 'center',
      }}>
      <View>
        <Text style={{fontSize: 27, marginBottom: 30, textAlign: 'center'}}>
          {data.hint}
        </Text>
        <Button
          style={{margin: 20, width: 300, marginBottom: 30}}
          onPress={() =>
            onButtonPress('capture', {
              saveToPhotos: false,
              mediaType: 'photo',
              includeBase64: false,
              includeExtra: true,
            })
          }
          title={play?.isPlay ? 'Update Photo' : 'Capture Photo'}
          color="green"
        />
        {response ? (
          <>
            <Image
              style={{
                marginTop: 30,
                height: 600,
                marginVertical: 5,
                width: 500,
              }}
              source={{
                uri: response,
              }}
              resizeMode="contain"
            />
          </>
        ) : null}
        {play?.isPlay && !response ? (
          <>
            <Image
              style={{
                marginTop: 30,
                height: 600,
                marginVertical: 5,
                width: 500,
              }}
              source={{
                uri: 'https://trealet.com/' + play?.data,
              }}
              resizeMode="contain"
            />
          </>
        ) : null}
        {response ? (
          <>
            <Button onPress={OnUploadImage} title="upload" color="green" />
          </>
        ) : null}
      </View>
    </View>
  );
};

export default CameraStep;

const styles = StyleSheet.create({});

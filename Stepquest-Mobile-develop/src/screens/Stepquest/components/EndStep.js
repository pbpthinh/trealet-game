import {StyleSheet, Text, View, Image} from 'react-native';
import React, {useEffect} from 'react';

const EndStep = ({setSound, data, play}) => {
  // useEffect(() => {
  //   setSound(false);
  // }, []);

  return (
    <View style={styles.container}>
      <Image
        style={styles.backImage}
        source={require('../../../assets/images/EndStep.jpg')}
      />
      <Text style={styles.descText}>Bạn đã hoàn thành trò chơi</Text>
      {data ? (
        <Text style={styles.descText}>{'Điểm của bạn là : ' + play}</Text>
      ) : null}
    </View>
  );
};

export default EndStep;

const styles = StyleSheet.create({
  container: {
    // backgroundColor: 'red',
    width: '100%',
    justifyContent: 'center',
    alignItems: 'center',
  },
  backImage: {
    width: 700,
    height: 500,
  },
  descText: {
    fontWeight: '500',
    marginTop: 30,
    fontSize: 22,
    textAlign: 'center',
  },
});

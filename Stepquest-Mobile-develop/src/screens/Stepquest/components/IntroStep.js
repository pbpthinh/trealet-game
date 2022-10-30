import {StyleSheet, Text, View, Image} from 'react-native';
import React from 'react';

const IntroStep = ({des}) => {
  return (
    <View style={styles.container}>
      <Image
        style={styles.backImage}
        source={require('../../../assets/images/IntroStep.jpg')}
      />
      <Text style={styles.descText}>
        Hãy đảm bảo là bạn đang ở cụm thông tin dưới đây
      </Text>

      <Text
        style={{
          fontSize: 25,
          fontWeight: 'bold',
          margin: 'auto',
          textAlign: 'center',
          color: 'green',
        }}>
        {des}
      </Text>
    </View>
  );
};

export default IntroStep;

const styles = StyleSheet.create({
  container: {
    // backgroundColor: 'red',
    width: '100%',
    justifyContent: 'center',
    alignItems: 'center',
  },
  backImage: {
    marginTop: 80,
    width: 700,
    height: 500,
  },
  descText: {
    marginHorizontal: 50,
    marginTop: 50,
    fontSize: 24,
    marginBottom: 30,
    textAlign: 'center',
  },
});

import React, {useEffect, Fragment, useState} from 'react';
import QRCodeScanner from 'react-native-qrcode-scanner';
import {
  StyleSheet,
  TouchableOpacity,
  Text,
  StatusBar,
  Linking,
  View,
  Dimensions,
} from 'react-native';

const QrStep = ({data, uploadQR, play, index}) => {
  const [scan, setScan] = useState(false);
  const [scanResult, setScanResult] = useState(null);
  const [result, setResult] = useState(null);

  const [done, setDone] = useState(false);
  // console.log(data);

  const onSuccess = async e => {
    await setTimeout(() => console.log('Initial timeout!'), 300);
    const check = e.data;
    console.log('scanned data : ' + check);
    setScan(false);
    setScanResult(check);
    setResult(true);
    if (check === data.code) {
      uploadQR(index, parseInt(data.score), check);
    }
  };

  useEffect(() => {
    if (play.data !== null) {
      setScanResult(play.data);
      setDone(true);
    }
  }, []);

  const activeQR = () => {
    setScan(true);
  };
  const scanAgain = () => {
    setScan(true);
    setScanResult(false);
  };

  const onUploadQR = () => {
    uploadQR(index, scanResult);
    setScanResult(null);
  };
  return (
    <View
      style={{
        marginTop: -30,
        paddingBottom: scan ? 1 : 20,
        justifyContent: 'center',
        alignItems: 'center',
      }}>
      <Fragment>
        {!scan ? (
          <Text
            style={{
              fontSize: 27,
              marginBottom: 10,
              marginTop: scan ? 25 : 80,
              textAlign: 'center',
            }}>
            {data.hint}
          </Text>
        ) : null}

        {!scan && !scanResult && (
          <View
            style={{
              marginTop: 30,
              justifyContent: 'center',
              alignItems: 'center',
            }}>
            <Text
              style={{
                fontSize: 24,
                marginBottom: 10,
                textAlign: 'center',
                marginHorizontal: 40,
              }}>
              Mời bạn tìm đúng hiện vật có mã như dưới đây để bắt đầu chinh phục
              thử thách
            </Text>
            <Text
              style={{
                fontSize: 30,
                marginBottom: 20,
                textAlign: 'center',
                marginHorizontal: 40,
                color: '#FF5733',
                fontWeight: 'bold',
              }}>
              {data.code}
            </Text>
            <TouchableOpacity onPress={activeQR} style={styles.buttonTouchable}>
              <Text style={styles.buttonTextStyle}>Quét mã QR</Text>
            </TouchableOpacity>
          </View>
        )}

        {scanResult && (
          <View
            style={{
              justifyContent: 'center',
              alignItems: 'center',
              marginTop: 30,
            }}>
            <Text
              style={{
                fontSize: 24,
                marginBottom: 10,
                textAlign: 'center',
                marginHorizontal: 40,
              }}>
              Mời bạn tìm đúng hiện vật có mã như dưới đây để bắt đầu chinh phục
              thử thách
            </Text>
            <Text
              style={{
                fontSize: 30,
                marginBottom: 20,
                textAlign: 'center',
                marginHorizontal: 40,
                color: '#FF5733',
                fontWeight: 'bold',
              }}>
              {data.code}
            </Text>
            <TouchableOpacity
              disabled={play.data !== null}
              onPress={() => scanAgain()}
              style={styles.buttonTouchable}>
              <Text style={styles.buttonTextStyle}>Quét mã QR</Text>
            </TouchableOpacity>
            <Text
              // eslint-disable-next-line react-native/no-inline-styles
              style={{
                fontSize: 30,
                textAlign: 'center',
                color: '#000',
                marginVertical: 30,
              }}>
              {scanResult}
            </Text>
            {scanResult && scanResult === data?.code ? (
              <View style={{backgroundColor: 'green', borderRadius: 15}}>
                <Text
                  style={{
                    fontSize: 30,
                    textAlign: 'center',
                    marginVertical: 30,
                    marginHorizontal: 20,
                    color: '#fff',
                  }}>
                  Hãy bấm tiếp tục để chơi tiếp
                </Text>
              </View>
            ) : (
              <View style={{backgroundColor: '#d1551b', borderRadius: 15}}>
                <Text
                  style={{
                    fontSize: 26,
                    textAlign: 'center',
                    marginVertical: 30,
                    marginHorizontal: 20,
                    color: '#fff',
                    marginHorizontal: 20,
                  }}>
                  Hãy quét đúng hiện vật có mã bên trên để tiếp tục
                </Text>
              </View>
            )}
            {/* {play.isPlay ? (
              <View style={{backgroundColor: 'green', borderRadius: 15}}>
                <Text
                  style={{
                    fontSize: 30,
                    textAlign: 'center',
                    marginVertical: 30,
                    marginHorizontal: 20,
                    color: '#fff',
                  }}>
                  Chúc mừng bạn đã quét đúng mã QR
                </Text>
              </View>
            ) : (
              <View style={{backgroundColor: 'red', borderRadius: 15}}>
                <Text
                  style={{
                    fontSize: 30,
                    textAlign: 'center',
                    marginVertical: 30,
                    marginHorizontal: 20,
                    color: '#fff',
                  }}>
                  Bạn đã quét sai QR
                </Text>
              </View>
            )} */}
          </View>
        )}

        {scan && (
          <QRCodeScanner
            style={{paddingBottom: 110}}
            reactivate={true}
            showMarker={true}
            // ref={node => {
            //   this.scanner = node;
            // }}
            onRead={onSuccess}
            topContent={
              <Text style={styles.centerText}>
                <Text style={styles.textBold}>Quét mã QR</Text>
              </Text>
            }
            bottomContent={
              <View
                style={{
                  flexDirection: 'row',
                  justifyContent: 'space-around',
                  marginTop: -200,
                }}>
                <TouchableOpacity
                  style={styles.buttonTouchable}
                  onPress={() => setScan(false)}>
                  <Text style={styles.buttonTextStyle}>Dừng lại</Text>
                </TouchableOpacity>
              </View>
            }
          />
        )}
      </Fragment>
    </View>
  );
};

export default QrStep;

const styles = StyleSheet.create({
  scrollViewStyle: {
    justifyContent: 'center',
    alignItems: 'center',
  },
  textTitle: {
    fontWeight: 'bold',
    fontSize: 18,
    textAlign: 'center',
    padding: 16,
    color: 'white',
  },
  textTitle1: {
    fontWeight: 'bold',
    fontSize: 18,
    textAlign: 'center',
    padding: 16,
    color: 'black',
  },
  scanCardView: {
    width: 300,
    height: 300,
    alignSelf: 'center',
    justifyContent: 'center',
    alignItems: 'center',
    borderWidth: 1,
    borderRadius: 2,
    borderColor: '#ddd',
    borderBottomWidth: 0,
    shadowColor: '#000',
    shadowOffset: {width: 0, height: 2},
    shadowOpacity: 0.8,
    shadowRadius: 2,
    elevation: 4,
    marginLeft: 5,
    marginRight: 5,
    marginTop: 10,
    backgroundColor: 'white',
  },
  buttonScan: {
    width: 42,
  },
  descText: {
    padding: 16,
    textAlign: 'justify',
    fontSize: 16,
  },

  highlight: {
    fontWeight: '700',
  },

  centerText: {
    flex: 1,
    fontSize: 32,
    padding: 30,
    marginTop: -20,
    color: '#777',
  },
  textBold: {
    fontWeight: '500',
    color: 'white',
  },
  buttonTouchable: {
    fontSize: 21,
    backgroundColor: 'green',
    width: 140,
    justifyContent: 'center',
    alignItems: 'center',
    borderRadius: 30,
    height: 60,
  },
  buttonTextStyle: {
    textAlign: 'center',
    color: 'white',
    fontWeight: 'bold',
  },
});

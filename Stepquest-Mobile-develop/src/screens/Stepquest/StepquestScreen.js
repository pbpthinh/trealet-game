/* eslint-disable react-native/no-inline-styles */
import {
  StyleSheet,
  ScrollView,
  SafeAreaView,
  Alert,
  View,
  Text,
  TouchableOpacity,
  Dimensions,
} from 'react-native';
import React, {useState, useEffect} from 'react';
import Icon from 'react-native-vector-icons/MaterialIcons';
// import CameraModule from './components/CameraModule';
// import QrModule from './components/QrModule';
import {useSelector, useDispatch} from 'react-redux';
import IntroStep from './components/IntroStep';
import DisplayStep from './components/DisplayStep';
import CameraStep from './components/CameraStep';
import QuizzStep from './components/QuizzStep';
import AudioStep from './components/AudioStep';
import EndStep from './components/EndStep';
import {showMessage, hideMessage} from 'react-native-flash-message';
import FlashMessage from 'react-native-flash-message';
import {Bar} from 'react-native-progress';
import QrStep from './components/QrStep';
import {trans} from '../../language';
import {actions as StepquestAction} from '../../redux/StepquestRedux';
import audioFile from '../../assets/audio/audio-play.mp3';

var Sound = require('react-native-sound');

let soundPlay = null;
const load = () => {
  return new Promise((resolve, reject) => {
    if (!audioFile) {
      return reject('file path is empty');
    }
    Sound.setCategory('Playback');

    soundPlay = new Sound(audioFile, error => {
      if (error) {
        console.log('failed to load the file', error);
        return reject(error);
      }
      return resolve();
    });
  });
};

load();

const StepquestScreen = ({navigation}) => {
  const onLogout = navigation => {
    return Alert.alert('Thông báo', 'Bạn có muốn trở lại ?', [
      {
        text: 'Đồng ý',
        onPress: () => {
          if (soundPlay) {
            pause();
          }
          navigation.push('Trealet');
        },
      },
      {
        text: 'Không đồng ý',
        style: 'cancel',
      },
    ]);
  };

  const dispatch = useDispatch();

  const {name, token, language} = useSelector(state => state.login);
  const {listTrealet, isFetching} = useSelector(state => state.trealet);
  const {listPlay, dataPlay} = useSelector(state => state.stepquest);
  const stepquestPlay = dataPlay.json.trealet;

  const [step, setStep] = useState(-1);

  const [sound, setSound] = useState(true);

  const player = listPlay?.find(item => item.id === dataPlay.id) || [];
  // const player = checkPlay(dataPlay.id);

  console.log(player);
  // console.log(stepquestPlay);
  // console.log(dataPlay.id);

  useEffect(() => {
    if (player) {
      if (player?.isDone) {
        setStep(stepquestPlay.items.length);
      }
    }
    return;
  }, [player]);

  const load = () => {
    return new Promise((resolve, reject) => {
      if (!audioFile) {
        return reject('file path is empty');
      }
      Sound.setCategory('Playback');

      soundPlay = new Sound(audioFile, error => {
        if (error) {
          console.log('failed to load the file', error);
          return reject(error);
        }
        return resolve();
      });
    });
  };

  const changeSound = data => {
    console.log('cahngesound');
    if (data) {
      setSound(data);
      onPlay();
    } else {
      setSound(data);
      pause();
    }
  };

  const onPlay = async () => {
    // if (sound) {
    //   try {
    //     await load();
    //   } catch (error) {
    //     console.log(error);
    //   }
    // }

    Sound.setCategory('Playback');

    soundPlay.play(success => {
      if (success) {
        console.log('successfully finished playing');
      } else {
        console.log('playback failed due to audio decoding errors');
      }
      // this.sound.release();
    });
  };

  const pause = () => {
    soundPlay.pause();
  };

  const uploadImage = (index, score, image) => {
    dispatch(StepquestAction.uploadImage(dataPlay.id, index, score, image));
  };

  const uploadAudio = (index, score, audio) => {
    dispatch(StepquestAction.uploadAudio(dataPlay.id, index, score, audio));
  };

  const uploadQR = async (index, score, qr) => {
    await dispatch(StepquestAction.postData(dataPlay.id, index, score, qr));
  };

  const uploadQuiz = async (index, score, data) => {
    await dispatch(StepquestAction.postData(dataPlay.id, index, score, data));
  };

  const uploadDisplay = async (index, score, data) => {
    await dispatch(StepquestAction.postData(dataPlay.id, index, score, data));
  };

  const endPlay = async () => {
    await dispatch(StepquestAction.endPlay(dataPlay.id));
  };

  const cleanPlay = () => {
    return Alert.alert('Thông báo', 'Bạn có muốn chơi lại lần nữa ?', [
      {
        text: 'Đồng ý',
        onPress: async () => {
          await dispatch(StepquestAction.cleanPlay(dataPlay.id));
          setStep(-1);
        },
      },
      {
        text: 'Không đồng ý',
        style: 'cancel',
      },
    ]);
  };

  const prevStep = () => {
    setStep(step - 1);
  };

  const nextStep = () => {
    if (step === stepquestPlay.items.length) {
      setStep(step);
    } else {
      if (step >= 0) {
        if (
          (player?.play[step].isPlay &&
            player?.play[step].score ===
              parseInt(stepquestPlay.items[step].score)) ||
          player?.play[step].data?.answer ||
          typeof player?.play[step].data === 'string'
        ) {
          setStep(step + 1);
          console.log('next');
        } else {
          console.log('next false');
          showMessage({
            message: 'Hãy thực hiện yêu cầu trước khi tiếp tục ',
            type: 'warning',
          });
        }
      } else {
        setStep(step + 1);
      }
    }
  };

  const renderStep = () => {
    // console.log(step);

    // console.log(stepquestPlay.items[step]);
    if (step === -1) {
      return <IntroStep key={step} des={stepquestPlay.des} />;
    } else {
      if (stepquestPlay.items.length > step) {
        switch (stepquestPlay.items[step].type) {
          case 'Display':
            return (
              <DisplayStep
                index={step}
                data={stepquestPlay.items[step]}
                play={player?.play[step]}
                uploadDisplay={uploadDisplay}
              />
            );
          case 'Picture':
            return (
              <CameraStep
                index={step}
                data={stepquestPlay.items[step]}
                play={player?.play[step]}
                uploadImage={uploadImage}
              />
            );
          case 'Quizz':
            return (
              <QuizzStep
                index={step}
                data={stepquestPlay.items[step]}
                play={player?.play[step]}
                uploadQuiz={uploadQuiz}
              />
            );
          case 'QR':
            // console.log(stepquestPlay.items[step]);
            return (
              <QrStep
                index={step}
                data={stepquestPlay.items[step]}
                play={player?.play[step]}
                uploadQR={uploadQR}
              />
            );
          case 'Audio':
            return (
              <AudioStep
                index={step}
                data={stepquestPlay.items[step]}
                play={player?.play[step]}
                uploadAudio={uploadAudio}
              />
            );
        }
      } else {
        return (
          <EndStep
            onPlay={onPlay}
            cleanPlay={cleanPlay}
            endPlay={endPlay}
            data={stepquestPlay.minScore}
            play={player?.score}
            index={step}
            setSound={setSound}
          />
        );
      }
    }
  };

  return (
    <>
      <View style={{backgroundColor: '#fff'}}>
        <FlashMessage position="top" />
        <View style={style.header}>
          <TouchableOpacity
            style={{flexDirection: 'row', alignItems: 'center'}}
            onPress={() => onLogout(navigation)}>
            <Icon name="arrow-back-ios" size={18} />
            <Text style={{fontSize: 20, fontWeight: 'bold'}}>
              {trans(language, 'Back')}
            </Text>
          </TouchableOpacity>
          <View
            style={{
              marginLeft: 'auto',
              flexDirection: 'row',
            }}>
            <Text
              style={{
                fontSize: 20,
                fontWeight: 'bold',
                marginLeft: 'auto',
                textAlign: 'center',
                marginRight: 10,
              }}>
              {trans(language, 'Hello') + ','}
            </Text>
            <Text
              style={{
                fontSize: 20,
                fontWeight: 'bold',
                marginLeft: 'auto',
                color: 'green',
                textAlign: 'center',
              }}>
              {name}
            </Text>
          </View>
        </View>
        <View style={{marginBottom: 20, alignItems: 'center'}}>
          <View style={{flexDirection: 'row'}}>
            <Text
              style={{
                fontSize: 24,
                fontWeight: 'bold',
                margin: 'auto',
                textAlign: 'center',
              }}>
              {'Hãy check in với hiện vật có mã số sau : '}
            </Text>
            <Text
              style={{
                fontSize: 24,
                fontWeight: 'bold',
                margin: 'auto',
                textAlign: 'center',
                color: 'green',
              }}>
              {stepquestPlay.title}
            </Text>
          </View>
        </View>

        {step !== -1 ? (
          <View style={{alignItems: 'center'}}>
            <Bar
              color="green"
              style={{marginHorizontal: 30, borderRadius: 10, marginBottom: 10}}
              progress={step / stepquestPlay.items.length}
              width={740}
              height={10}
              borderWidth={2.5}
            />
            <View
              style={{
                width: 650,
                flexDirection: 'row',
                marginBottom: 10,
                justifyContent: stepquestPlay.minScore
                  ? 'space-between'
                  : 'center',
              }}>
              <View
                style={{
                  width: 40,
                  height: 40,
                  backgroundColor: '#EC770A',
                  borderRadius: 20,
                  alignItems: 'center',
                  flexDirection: 'row',
                  justifyContent: 'center',
                }}>
                <Icon
                  name={sound ? 'music-note' : 'music-off'}
                  color={'#FFF'}
                  onPress={() => changeSound(!sound)}
                  size={30}
                />
              </View>
              <View>
                {stepquestPlay.minScore ? (
                  <View style={{flexDirection: 'row'}}>
                    <Text
                      style={{
                        fontSize: 20,
                        fontWeight: '600',
                        marginLeft: 'auto',
                        textAlign: 'center',
                        marginRight: 10,
                      }}>
                      Điểm :
                    </Text>
                    <Text
                      style={{
                        fontSize: 20,
                        color: 'red',
                        fontWeight: 'bold',
                        marginLeft: 'auto',
                        textAlign: 'center',
                      }}>
                      {player ? player.score : ''}
                    </Text>
                    <Text
                      style={{
                        fontSize: 20,
                        fontWeight: 'bold',
                        marginLeft: 'auto',
                        textAlign: 'center',
                      }}>
                      {' / '}
                    </Text>
                    <Text
                      style={{
                        fontSize: 20,
                        color: 'red',
                        fontWeight: 'bold',
                        marginLeft: 'auto',
                        textAlign: 'center',
                        marginRight: 10,
                      }}>
                      {stepquestPlay.minScore}
                    </Text>
                  </View>
                ) : (
                  <View style={{marginVertical: 15}} />
                )}
              </View>
            </View>
          </View>
        ) : null}

        <View
          style={{backgroundColor: '#f5f4f9', height: step === -1 ? 980 : 910}}>
          <ScrollView style={{backgroundColor: 'white', marginVertical: 15}}>
            <View
              key={-22}
              style={{
                // backgroundColor: 'red',
                // height: 1000,
                marginVertical: 10,
              }}>
              {renderStep()}
            </View>
          </ScrollView>
        </View>

        <View style={style.bottomStep}>
          {step !== -1 ? (
            step === stepquestPlay.items.length ? (
              <>
                <TouchableOpacity
                  onPress={prevStep}
                  style={style.buttonTouchablePrev}>
                  <Text style={style.buttonTextStyle}>Trở lại</Text>
                </TouchableOpacity>
                <TouchableOpacity
                  onPress={cleanPlay}
                  style={style.buttonTouchableNext}>
                  <Text style={style.buttonTextStyle}>Chơi lại</Text>
                </TouchableOpacity>
              </>
            ) : (
              <>
                <TouchableOpacity
                  onPress={prevStep}
                  style={style.buttonTouchablePrev}>
                  <Text style={style.buttonTextStyle}>Trở lại</Text>
                </TouchableOpacity>
                <TouchableOpacity
                  onPress={nextStep}
                  style={style.buttonTouchableNext}>
                  <Text style={style.buttonTextStyle}>Tiếp tục</Text>
                </TouchableOpacity>
              </>
            )
          ) : (
            <>
              <TouchableOpacity
                onPress={() => {
                  nextStep();
                  onPlay();
                  setSound(true);
                }}
                style={style.buttonTouchableNext}>
                <Text style={style.buttonTextStyle}>Bắt đầu</Text>
              </TouchableOpacity>
            </>
          )}
        </View>
      </View>
    </>
  );
};

export default StepquestScreen;

const style = StyleSheet.create({
  header: {
    paddingVertical: 20,
    flexDirection: 'row',
    alignItems: 'center',
    marginHorizontal: 20,
  },
  Title: {
    paddingVertical: 20,
    // flexDirection: 'row',
    alignItems: 'center',
    marginHorizontal: 20,
  },
  bottomStep: {
    // backgroundColor: 'blue',
    paddingHorizontal: 100,
    flexDirection: 'row',
    justifyContent: 'space-around',
    bottom: 0,
  },
  buttonTouchableNext: {
    marginVertical: 20,
    fontSize: 21,
    backgroundColor: 'green',
    width: 280,
    borderRadius: 30,
    justifyContent: 'center',
    alignItems: 'center',
    height: 60,
  },
  buttonTouchablePrev: {
    marginVertical: 20,
    fontSize: 21,
    backgroundColor: '#ba5a1a',
    width: 280,
    borderRadius: 30,
    justifyContent: 'center',
    alignItems: 'center',
    height: 60,
  },
  buttonTextStyle: {
    color: 'white',
    fontWeight: 'bold',
  },
});

const json = {
  trealet: {
    title: 'Tiêu đề stepquest 001',
    des: 'Mô tả của stepquest 001',
    minScore: '100',
    gift: 'Phần thưởng 1',
    language: 'vn',
    items: [
      {
        type: 'Display',
        title: 'Hiển thị gợi ý',
        description: 'Mô tả hiển thị',
        youtube: 'https://www.youtube.com/embed/WxDF-Y4bZwA',
        media: 'image',
        file: 'https://trealet.com/upload/trealet-data/202208250551080.png',
        key: '1661407509027',
        score: '20',
        time: '0',
        isUnlimitedTime: 'true',
      },
      {
        type: 'QR',
        hint: 'Giợi ý QR',
        code: 'Mã QR',
        key: '1661407509028',
        score: '30',
        time: '30',
        isUnlimitedTime: null,
      },
      {
        media: 'image',
        file: 'https://trealet.com/upload/trealet-data/202208250551082.png',
        type: 'Quizz',
        question: 'Câu hỏi của câu đố 0001',
        ListOption: [
          {
            id: '1',
            text: 'Đáp án 1',
          },
          {
            id: '2',
            text: 'Đáp án 2',
          },
          {
            id: '3',
            text: 'Đáp án 3',
          },
          {
            id: '4',
            text: 'Đáp án 4',
          },
        ],
        answer: '2',
        hint: null,
        key: '1661407509029',
        score: '30',
        time: '20',
        isUnlimitedTime: null,
      },
      {
        type: 'Audio',
        hint: 'Gợi ý ghi âm',
        key: '1661407509029',
        score: '20',
        time: '0',
        isUnlimitedTime: 'true',
      },
      {
        type: 'Picture',
        hint: 'Gợi ý chụp hình',
        key: '1661407509029',
        score: '30',
        time: '0',
        isUnlimitedTime: 'true',
      },
      {
        media: 'none',
        type: 'Quizz',
        question: 'Câu hỏi của câu đố 002',
        ListOption: [
          {
            id: '1',
            text: 'đáp án 1',
          },
          {
            id: '2',
            text: 'đáp án 2',
          },
          {
            id: '3',
            text: 'đáp án 3',
          },
          {
            id: '4',
            text: 'đáp án 4',
          },
        ],
        answer: '3',
        hint: null,
        key: '1661407509029',
        score: '20',
        time: '20',
        isUnlimitedTime: null,
      },
      {
        type: 'Display',
        title: 'Giợi ý audio',
        description: 'Mô tả audio',
        youtube: null,
        media: 'audio',
        file: 'https://trealet.com/upload/trealet-data/2022081706165783.mp3',
        key: '1661407509029',
        score: null,
        time: '0',
        isUnlimitedTime: 'true',
      },
      {
        type: 'Display',
        title: 'Gợi ý video',
        description: 'Mô TẢ VIDEO',
        youtube: null,
        media: 'video',
        file: 'https://trealet.com/upload/trealet-data/2022082506123563.mp4',
        key: '1661407509030',
        score: null,
        time: '20',
        isUnlimitedTime: null,
      },
    ],
  },
};

/* eslint-disable react-hooks/exhaustive-deps */
import {
  StyleSheet,
  Text,
  View,
  Image,
  FlatList,
  SafeAreaView,
  TouchableOpacity,
  VirtualizedView,
  ScrollView,
  ImageBackground,
} from 'react-native';
import React, {useState, useEffect} from 'react';
import YoutubePlayer from 'react-native-youtube-iframe';
import {WebView} from 'react-native-webview';
import VideoPlayer from 'react-native-video-controls';
import {Pie, Bar} from 'react-native-progress';
import {showMessage, hideMessage} from 'react-native-flash-message';
import bgStep from '../../../assets/images/bgStep.jpeg';

const QuizzStep = ({data, play, uploadQuiz, index}) => {
  const [seconds, setSeconds] = useState(
    parseInt(data.time === '0' ? 10000000 : data.time),
  );
  const [answer, setAnswer] = useState(null);
  const [isFail, setIsFail] = useState(false);
  const [isTimeUp, setIsTimeUp] = useState(false);

  const CartAnswer = ({item}) => {
    return (
      <TouchableOpacity
        disabled={answer || seconds < 0 ? true : false}
        style={[
          styles.answerCart,
          // eslint-disable-next-line react-native/no-inline-styles
          {
            backgroundColor:
              answer === item.id
                ? item.id === data.answer
                  ? 'green'
                  : 'red'
                : 'white',
          },
        ]}
        onPress={() => onAddAnswer(item.id)}>
        <Text style={{textAlign: 'center', fontWeight: 'bold'}}>
          {item.text}
        </Text>
      </TouchableOpacity>
    );
  };
  // Remember the latest callback.

  const onAddAnswer = id => {
    if (id === data.answer) {
      setAnswer(id);
      uploadQuiz(index, parseInt(data.score), {
        answer: id,
      });
    } else {
      uploadQuiz(index, parseInt(data.score), {
        answer: id,
      });
      setAnswer(id);
      setIsFail(true);
    }
  };

  useEffect(() => {
    const interval = setInterval(async () => {
      if (seconds > 0) {
        await setSeconds(seconds => seconds - 1);
      }
    }, 1000);
    return () => clearInterval(interval);
  }, []);

  useEffect(() => {
    setAnswer(null);
    if (data.isUnlimitedTime === 'true') {
      setSeconds(99999999);
    } else {
      setSeconds(parseInt(data.time));
    }
    setIsTimeUp(false);
    if (play.isPlay) {
      if (play.data.answer !== 'time up') {
        setAnswer(play.data.answer);
      }
      setSeconds(0);
    }
  }, [data]);

  useEffect(() => {
    if ((seconds === 0 && answer === null) || play.data?.answer === 'time up') {
      setIsTimeUp(true);
      setAnswer(data.answer);
      uploadQuiz(index, 0, {
        answer: 'time up',
      });
    }
    if (answer) {
      setSeconds(0);
    }
  }, [seconds]);

  return (
    <ImageBackground source={bgStep} style={styles.container}>
      <View>
        {data.media === 'image' ? (
          <Image
            style={{height: 400}}
            source={{
              uri: data.file,
            }}
            resizeMode="contain"
          />
        ) : null}
        {data.media === 'audio' ? (
          <WebView
            style={{height: 100, marginTop: 50}}
            originWhitelist={['*']}
            source={{
              html: `<audio nodownload style="height: 55px; margin-left: 330px" controls autoplay><source src="${data.file}" type="audio/ogg"></audio>`,
            }}
          />
        ) : null}
        {data.media === 'video' ? (
          <VideoPlayer
            style={{height: 500, marginTop: 50}}
            source={{
              uri: data.file,
            }}
            paused
            disableFullscreen
            disableVolume
            disableBack
          />
        ) : null}
      </View>

      <View style={styles.questionContainer}>
        <Text style={styles.title}>{data.question}</Text>
      </View>
      <View
        style={{
          marginTop: 20,
          justifyContent: 'center',
          alignItems: 'center',
          // flexDirection: 'row',
        }}>
        <Text
          style={{
            fontSize: 20,
            marginTop: -15,
            marginRight: -20,
            marginBottom: 5,
            fontWeight: '500',
            color: 'white',
          }}>
          Thời gian trả lời
        </Text>
        <Bar
          color="#FAFA8B"
          style={{marginHorizontal: 30, borderRadius: 10, marginBottom: 10}}
          progress={
            seconds /
            (data.isUnlimitedTime === 'true' ? 99999999 : parseInt(data.time))
          }
          borderWidth={2}
          width={570}
          height={8}
        />
      </View>

      <ScrollView style={styles.optionContainer}>
        <FlatList
          nestedScrollEnabled={true}
          style={{margin: 5}}
          data={data.ListOption}
          numColumns={2}
          keyExtractor={(item, index) => item.id + index.toString()}
          renderItem={item => <CartAnswer item={item.item} />}
        />
      </ScrollView>
      {isTimeUp || play.data?.answer === 'time up' ? (
        <>
          <View style={styles.doneContainer}>
            <Text style={styles.title}>Hết thời gian ! Đáp án đúng là </Text>
            <Text style={[styles.title, {color: 'white'}]}>
              <Text style={[styles.title, {color: '#217526'}]}>
                {data.ListOption[parseInt(data.answer) - 1].text}
              </Text>
            </Text>
          </View>
          <View style={[styles.doneContainer, {backgroundColor: '#fff'}]}>
            <Text style={[styles.title, {}]}>Giải thích</Text>
            <Text style={[styles.title, {fontSize: 17}]}>{data?.hint}</Text>
          </View>
        </>
      ) : null}
      {answer && !isTimeUp ? (
        answer === data.answer ? (
          <>
            <View style={[styles.doneContainer, {backgroundColor: '#217526'}]}>
              <Text style={[styles.title, {color: 'white'}]}>
                Bạn đã đoán chính xác
              </Text>
            </View>
            <View style={[styles.doneContainer, {backgroundColor: '#fff'}]}>
              <Text style={[styles.title, {}]}>Giải thích</Text>
              <Text style={[styles.title, {fontSize: 17}]}>{data?.hint}</Text>
            </View>
          </>
        ) : (
          <>
            <View style={[styles.doneContainer, {backgroundColor: '#EC0A32'}]}>
              <Text style={[styles.title, {color: 'white'}]}>
                Bạn đã đoán sai ! Đáp án đúng là
              </Text>
              <Text style={[styles.title, {color: 'white'}]}>
                {data.ListOption[parseInt(data?.answer) - 1]?.text}
              </Text>
            </View>
            <View style={[styles.doneContainer, {backgroundColor: '#fff'}]}>
              <Text style={[styles.title, {}]}>Giải thích</Text>
              <Text style={[styles.title, {fontSize: 17}]}>{data?.hint}</Text>
            </View>
          </>
        )
      ) : null}
    </ImageBackground>
  );
};

export default QuizzStep;

const styles = StyleSheet.create({
  container: {
    marginTop: -10,
    minHeight: 880,
    backgroundColor: '#f5edba',
    justifyContent: 'center',
  },
  questionContainer: {
    backgroundColor: '#fff',
    marginHorizontal: 100,
    width: 600,
    borderRadius: 15,
    borderWidth: 1,
    marginTop: 20,
  },
  title: {
    fontSize: 20,
    marginVertical: 10,
    textAlign: 'center',
    fontWeight: 'bold',
  },
  optionContainer: {
    marginHorizontal: 50,
    width: 700,
    flex: 1,
    borderRadius: 15,
  },
  answerCart: {
    backgroundColor: 'white',
    margin: 23,
    minheight: 300,
    width: 300,
    // borderWidth: 0.2,
    borderRadius: 5,
    paddingVertical: 45,
    paddingHorizontal: 25,
    marginVertical: 10,
    shadowColor: '#000',
    shadowOffset: {width: 0, height: 5},
    shadowOpacity: 0.8,
    shadowRadius: 4,
    elevation: 5,
  },
  doneContainer: {
    backgroundColor: 'white',
    marginHorizontal: 100,
    borderRadius: 5,
    borderWidth: 1,
    marginBottom: 30,
  },
});

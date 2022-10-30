import {StyleSheet, Text, View, Image} from 'react-native';
import React, {useEffect} from 'react';
import YoutubePlayer from 'react-native-youtube-iframe';
import {WebView} from 'react-native-webview';
import VideoPlayer from 'react-native-video-controls';

const DisplayStep = ({data, play, uploadDisplay, index}) => {
  useEffect(() => {
    if (!play.isPlay) {
      uploadDisplay(
        index,
        parseInt(data.score) ? parseInt(data.score) : 0,
        'display',
      );
    }
  }, []);

  return (
    <View
      style={{
        justifyContent: 'center',
        // alignItems: 'center',
      }}>
      <Text style={{fontSize: 19, marginTop: 40, textAlign: 'center'}}>
        {data.title}
      </Text>

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

      {data.youtube ? (
        <YoutubePlayer
          height={460}
          play={false}
          videoId={data.youtube.slice(30)}
        />
      ) : null}

      <View
        style={{
          justifyContent: 'center',
          alignItems: 'center',
        }}>
        <Text
          style={{
            fontSize: 16,
            marginTop: 30,
            marginBottom: 40,
            marginHorizontal: 20,
            textAlign: 'center',
          }}>
          {data.description}
        </Text>
      </View>
    </View>
  );
};

export default DisplayStep;

const styles = StyleSheet.create({});

import {StyleSheet, Button, View, Text, ScrollView} from 'react-native';
import React, {useEffect, useState} from 'react';
import AudioRecord from 'react-native-audio-record';
import Sound from 'react-native-sound';
import {WebView} from 'react-native-webview';

const options = {
  sampleRate: 16000, // default 44100
  channels: 1, // 1 or 2, default 1
  bitsPerSample: 16, // 8 or 16, default 16
  audioSource: 6,
  wavFile: 'test.wav', // default 'audio.wav'
};
let sound = null;

const AudioStep = ({data, index, play, uploadAudio}) => {
  const [audioFile, setAudioFile] = useState('');
  const [recording, setRecording] = useState(false);
  const [paused, setPaused] = useState(true);
  const [loaded, setLoaded] = useState(false);

  const start = async () => {
    await AudioRecord.init(options);
    console.log('start record');
    setAudioFile('');
    setRecording(true);
    setPaused(false);
    AudioRecord.start();
  };

  const stop = async () => {
    if (!recording) {
      return;
    }
    console.log('stop record');
    console.log('stop record');

    let audioFile = await AudioRecord.stop();
    console.log('audioFile', audioFile);
    setRecording(false);
    setPaused(true);

    // wait till file is saved, else react-native-video will load incomplete file
    setTimeout(() => {
      setAudioFile(audioFile);
    }, 1000);
  };

  const load = () => {
    return new Promise((resolve, reject) => {
      if (!audioFile) {
        return reject('file path is empty');
      }

      sound = new Sound(audioFile, '', error => {
        if (error) {
          console.log('failed to load the file', error);
          return reject(error);
        }
        setLoaded(true);
        return resolve();
      });
    });
  };

  const onPlay = async () => {
    if (!loaded) {
      try {
        await load();
      } catch (error) {
        console.log(error);
      }
    }

    setPaused(false);
    Sound.setCategory('Playback');

    sound.play(success => {
      if (success) {
        console.log('successfully finished playing');
      } else {
        console.log('playback failed due to audio decoding errors');
      }
      setPaused(true);
      // this.sound.release();
    });
  };

  const pause = () => {
    sound.pause();
    setPaused(true);
  };

  const onUpload = async () => {
    const file = {
      uri: 'file://' + audioFile,
      name: 'test.wav',
      type: 'audio/wav',
    };
    const formData = new FormData();
    formData.append('audio_file', file);
    await uploadAudio(index, parseInt(data.score), formData);
    setAudioFile(null);
  };
  return (
    <View style={styles.container}>
      <Text
        style={{
          fontSize: 27,
          textAlign: 'center',
          marginTop: 20,
          marginBottom: 80,
        }}>
        {data.hint}
      </Text>
      <View style={styles.row}>
        <Button
          color="green"
          onPress={start}
          title="Record"
          disabled={recording}
        />
        <Button
          color="green"
          onPress={stop}
          title=" Stop "
          disabled={!recording}
        />
        {paused ? (
          <Button
            color="green"
            onPress={onPlay}
            title="  Play  "
            disabled={!audioFile}
          />
        ) : (
          <Button
            color="green"
            onPress={pause}
            title=" Pause "
            disabled={!audioFile}
          />
        )}
        {audioFile ? (
          <Button
            color="green"
            onPress={onUpload}
            title={play?.isPlay ? 'Update' : '  upload  '}
            disabled={!audioFile}
          />
        ) : null}
      </View>
      {play?.isPlay ? (
        <ScrollView>
          <WebView
            style={{height: 120}}
            originWhitelist={['*']}
            source={{
              html: `<audio nodownload style="height: 90px; margin-left: 330px; margin-bottom: -50px" controls autoplay><source src="https://trealet.com/${play.data}" type="audio/ogg"></audio>`,
            }}
          />
        </ScrollView>
      ) : null}
    </View>
  );
};

export default AudioStep;

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    marginTop: 200,
  },
  row: {
    flexDirection: 'row',
    marginVertical: 20,
    marginHorizontal: 200,
    justifyContent: 'space-evenly',
  },
  btn: {
    width: 50,
    margin: 30,
  },
  btnBorder: {
    width: 50,
  },
});

/* eslint-disable react-native/no-inline-styles */
import {
  StyleSheet,
  FlatList,
  SafeAreaView,
  Alert,
  View,
  TouchableOpacity,
  Text,
  ActivityIndicator,
} from 'react-native';
import React, {useEffect} from 'react';
import Icon from 'react-native-vector-icons/MaterialIcons';
import {useSelector, useDispatch} from 'react-redux';
import {actions as LoginActions} from '../../redux/LoginRedux';
import {actions as TrealetRedux} from '../../redux/TrealetRedux';
import {actions as StreamlineAction} from '../../redux/StepquestRedux';
import {trans} from '../../language';
import FlashMessage from 'react-native-flash-message';

const StreamlineScreen = ({navigation}) => {
  const onPlay = (navigation, item) => {
    return Alert.alert('Thông báo', 'Bán sẵn sàng bắt đầu khám phá ?', [
      {
        text: 'Đồng ý',
        onPress: () => {
          dispatch(StreamlineAction.playStreamline(item));
          navigation.push('Streamline');
        },
        style: {color: '#d48806'},
      },
      {
        text: 'Không đồng ý',
      },
    ]);
  };

  const dispatch = useDispatch();

  const {name, token, language} = useSelector(state => state.login);
  const {listTrealet, isFetching} = useSelector(state => state.trealet);
  const {listPlay} = useSelector(state => state.stepquest);

  // console.log(listTrealet);

  const getData = async () => {
    await dispatch(TrealetRedux.getListTrealet(token, language, listPlay));
    // if (!listPlay) {
    // await dispatch(StreamlineAction.CreateListPlay(listTrealet));
    // }
  };

  useEffect(() => {
    getData();
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, []);

  const CartCard = ({item}) => {
    const detail = item?.json || null;
    return (
      <TouchableOpacity
        style={style.cartCard}
        onPress={() => onPlay(navigation, item)}>
        {/* <Image source={item.image} style={{height: 80, width: 80}} /> */}
        <View
          style={{
            marginLeft: 10,
            paddingVertical: 10,
          }}>
          <Text
            style={{
              fontWeight: 'bold',
              fontSize: 22,
              color: 'green',
            }}>
            {item?.title}
          </Text>
          {/* <Text style={{fontSize: 18, marginVertical: 8}}>
            {`${trans(language, 'Author')} : ${detail?.trealet?.author}`}
          </Text> */}
          <Text
            numberOfLines={3}
            style={{fontSize: 18, color: 'grey', marginBottom: 10}}>
            {detail?.trealet?.des}
          </Text>
          {/* <Text style={{fontSize: 17, fontWeight: 'bold'}}>${item.price}</Text> */}
        </View>
      </TouchableOpacity>
    );
  };

  const onLogout = navigation => {
    return Alert.alert('Thông báo', 'Bạn có muốn đăng xuất ?', [
      {
        text: 'Đồng ý',
        onPress: () => dispatch(LoginActions.logout()),
      },
      {
        text: 'Không Đồng ý',
      },
    ]);
  };

  return (
    <SafeAreaView style={{backgroundColor: '#fff', flex: 1}}>
      {/* <FlashMessage position="top" /> */}
      <View style={style.header}>
        <TouchableOpacity
          style={{flexDirection: 'row', alignItems: 'center'}}
          onPress={() => onLogout(navigation)}>
          <Icon name="arrow-back-ios" size={18} />
          <Text style={{fontSize: 20, fontWeight: 'bold'}}>
            {trans(language, 'Logout')}
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
      <View
        style={{
          marginLeft: 10,
          paddingVertical: 10,
        }}>
        <Text
          style={{
            fontWeight: 'bold',
            fontSize: 22,
            marginHorizontal: 20,
            color: '#FF5733',
            textAlign: 'center',
          }}>
          Mời bạn tìm đúng hiện vật có mã như dưới đây để bắt đầu chinh phục thử
          thách
        </Text>
      </View>
      <View style={{backgroundColor: '#f5f4f9', flex: 1}}>
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
              color="#green"
            />
          </View>
        ) : (
          <FlatList
            showsVerticalScrollIndicator={false}
            contentContainerStyle={{paddingVertical: 15}}
            data={listTrealet}
            renderItem={({item, index}) => (
              <CartCard key={item.id + item.title} item={item} />
            )}
          />
        )}
      </View>
    </SafeAreaView>
  );
};

export default StreamlineScreen;

const style = StyleSheet.create({
  header: {
    paddingVertical: 20,
    flexDirection: 'row',
    alignItems: 'center',
    marginHorizontal: 20,
  },
  cartCard: {
    elevation: 5,
    borderRadius: 5,
    backgroundColor: '#FFF',
    marginVertical: 10,
    marginHorizontal: 20,
    paddingHorizontal: 10,
    flexDirection: 'row',
    alignItems: 'center',
  },
  actionBtn: {
    width: 80,
    height: 30,
    backgroundColor: '#fa8c16',
    borderRadius: 30,
    paddingHorizontal: 5,
    flexDirection: 'row',
    justifyContent: 'center',
    alignContent: 'center',
  },
});

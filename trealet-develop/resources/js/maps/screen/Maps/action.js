import { API_URLS } from "../../config/api";
import { TYPE } from "../../config/actions";
import { apiCall } from "../../utils/api";
import select from "../../utils/select";
import { message, Button } from "antd";
import { getDistanceFromLatLonInKm } from "../../utils/util";
import { lte } from "lodash";

export const getMaps = (trId) => async (dispatch, getState) => {
  dispatch({
    type: TYPE.GET_MAPS,
  });
  const params = {
    tr: trId,
  };
  const api = API_URLS.MAPS.getMaps();
  const { response, error } = await apiCall({ ...api, params });
  if (!error && response.status === 200) {
    const toPlay = JSON.parse(response.data.json);
    const mapsList = toPlay.item;
    const playedList = response.data.played;
    const my_id = response.data.user_id;
    const playedListAll = response.data.played_all;
    const usersList = [];
    const mapsInfo = {
      title: response.data.title,
      desc: JSON.parse(response.data.json).desc,
    }
    playedListAll.forEach(item => {
      if(!usersList.find(user => user.userId === item.user_id)){
        usersList.push({username: item.username, userId: item.user_id, firstName: item.first_name, lastName: item.last_name})
      }
    })
    usersList.forEach(user => {
      let count = 0;
      playedListAll.forEach(item => {
        if(item.user_id === user.userId){
          count++;
        }
      })
      user.count = count;
      count = 0;
    })
 
    mapsList.map((mapsItem,index) => {
      mapsItem.played = false;
      mapsItem.data = null;
      playedList.forEach((playedItem) => {
        if (index === playedItem.no_in_json) {
          switch (playedItem.type) {
            case "audio":
              mapsItem.data = playedItem.data;
              mapsItem.played = true;
              break;
            case "picture":
              mapsItem.data = playedItem.data;
              mapsItem.played = true;
              break;
            case "qr":
              mapsItem.data = JSON.parse(playedItem.data);
              mapsItem.played = true;
              break;
            case "form":
              mapsItem.data = JSON.parse(playedItem.data);
              mapsItem.played = true;
              break;
            default:
              break;
          }
        }

      });
    });
    let lat =0;
    let lng =0;
    mapsList.forEach((map) => {
      lat += parseFloat(map.lat);
      lng += parseFloat(map.lng);
    })
    let center = {
      lat: lat/(mapsList.length),
      lng: lng/(mapsList.length),
    }
    var myInfo = null;
    usersList.forEach(user => {
      if(user.userId === my_id){
        myInfo = user;
      }
    })
    usersList.sort(function (a, b) {
      return b.count === a.count ? a.username - b.username : b.count - a.count;
    });
    const state = getState();
    const oldmaps = select(state, "mapsReducer", "maps");
    const oldcenter = select(state, "mapsReducer", "center");
    // console.log(oldmaps.size);
    // console.log(oldcenter);
    // const HNcenter = {
    //   lat: 21.030653,
    //   lng: 105.84713,
    // };

    if(oldmaps.size === 0){
      dispatch({
        type: TYPE.GET_MAPS_SUCCES,
        payload: mapsList,
        center,
        info: myInfo,
        listPlayer: usersList,
        mapsInfo,
      });
      }else{
        dispatch({
          type: TYPE.GET_MAPS_SUCCES,
          payload: mapsList,
          center: oldcenter,
          info: myInfo,
          listPlayer: usersList,
        });
      }
    
  } else {
    dispatch({
      type: TYPE.GET_MAPS_FAIL,
    });
  }
};

export const getGeolocation = (payload) => async (dispatch) => {
  const res = await axios.get("https://61a4fe6f4c822c0017042039.mockapi.io/v1");
  console.log(res.data);
  dispatch({
    type: TYPE.GET_GEOLOCATION,
  });
  // const { response, error } = await apiCall({ ...api });
  console.log("log res", response);
  if (!error && response.status === 200 && response.data.success === true) {
    dispatch({
      type: TYPE.GET_GEOLOCATION_SUCCES,
      payload: response.data.data,
    });
  } else {
    dispatch({
      type: TYPE.GET_GEOLOCATION_FAIL,
    });
  }
};

export const getGps = (gps) => async (dispatch) => {
  dispatch({
    type: TYPE.GET_GPS,
  });
  const geolocation = await new Promise((resolve, reject) => {
    gps.geolocation.getCurrentPosition(
      (success) => {
        let payload = {
          lat: success.coords.latitude,
          lng: success.coords.longitude,
        };
        dispatch({
          type: TYPE.GET_GPS_SUCCES,
          payload,
        });
      },
      (error) => {
        console.log(error.message);
        dispatch({
          type: TYPE.GET_GPS_FAIL,
        });
      }
    );
  });
};

export const getKm = () => async (dispatch, getState) => {
  dispatch({
    type: TYPE.GET_KM,
  });
  const state = getState();
  const maps = select(state, "mapsReducer", "maps");
  const gps = select(state, "mapsReducer", "gps");
  let tmp = 200;
  let ganNhat = null;
  var indexMin = -1;
  if (gps) {
    maps.forEach((item, index) => {
      let km = getDistanceFromLatLonInKm(item.lat, item.lng, gps.lat, gps.lng);
      if (tmp > km && !item.played) {
        indexMin = index;
        tmp = km;
      }
      // console.log(item.name + "-----------" + km + "km");
    });
    const vitri = await indexMin;
    dispatch({
      type: TYPE.GET_KM_SUCCES,
      payload: {
        ganNhat: maps[vitri],
        khoangCach: tmp,
      },
    });
  }
};

export const setZooCenter = (nowZoom,nowCenter) => async (dispatch, getState) => {

  const state = getState();
  const maps = select(state, "mapsReducer", "maps");
  const gps = select(state, "mapsReducer", "gps");
  let zoom = 14;
  let lat =0;
  let lng =0;
  maps.forEach((map) => {
    lat += parseFloat(map.lat);
    lng += parseFloat(map.lng);
  })
  let center = {
    lat: lat/(maps.length),
    lng: lng/(maps.length),
  }
  dispatch({
    type: TYPE.SET_ZOOM_CENTER,
    zoom: nowZoom,
    center: nowCenter,
  });

  // let km = await getDistanceFromLatLonInKm(parseFloat(nowCenter.lat), parseFloat(nowCenter.lng), center.lat, center.lng);
  // dispatch({
  //   type: TYPE.SET_ZOOM_CENTER,
  //   zoom: nowZoom,
  //   center: nowCenter,
  // });
  // if(nowZoom < 14 || km > 6) {
  //   dispatch({
  //     type: TYPE.SET_ZOOM_CENTER_SUCCES,
  //     center,
  //     zoom: 17,
  //   });
  //   message.warning({
  //     content: "Di chuyển bản đồ ra ngoài phạm vi Trealet",
  //     style: { marginTop: 60 },
  //   })
  // }
};

export const setIsUpdating = (isUpdating) => async (dispatch) => {
  dispatch({
    type: TYPE.SET_UPDATE,
    isUpdating: isUpdating,
  });
};
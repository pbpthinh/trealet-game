import { fromJS } from "immutable";
import { TYPE } from "../../config/actions";

const mapsState = fromJS({
  isFetching: false,
  maps: [],
  gps: null,
  center: {
    lat: 21.030653,
    lng: 105.84713,
  },
  mapsInfo: null,
  listPlayer: [],
  info: null,
  isFetchingGps: false,
  isGps: false,
  ganNhat: null,
  km: 0,
  zoom: 17,
  isUpdating: false,
});

const maps = (state = mapsState, action) => {
  switch (action.type) {
    case TYPE.GET_MAPS: {
      return state.merge({
        isFetching: true,
      });
    }
    case TYPE.GET_MAPS_FAIL: {
      return state.merge({
        isFetching: false,
      });
    }
    case TYPE.GET_MAPS_SUCCES: {
      // console.log(action.payload);
      return state.merge({
        maps: action.payload,
        center: action.center,
        info: action.info,
        listPlayer: action.listPlayer,
        isFetching: false,
        mapsInfo: action.mapsInfo,
      });
    }
    case TYPE.GET_GPS: {
      return state.merge({
        isFetchingGps: true,
      });
    }
    case TYPE.GET_GPS_FAIL: {
      return state.merge({
        isFetchingGps: false,
      });
    }
    case TYPE.GET_GPS_SUCCES: {
      if (action.payload !== state.gps) {
        return state.merge({
          gps: action.payload,
          isFetching: false,
          isGps: true,
        });
      } else {
        return state.merge({
          isFetching: false,
          isGps: true,
        });
      }
    }
    case TYPE.GET_KM:
      return state.merge({
        isFetching: false,
      });
    case TYPE.GET_KM_FAIL:
      return state.merge({
        isFetching: false,
      });
    case TYPE.GET_KM_SUCCES:
      return state.merge({
        isFetching: false,
        ganNhat: action.payload.ganNhat,
        km: action.payload.khoangCach,
      });
    case TYPE.SET_ZOOM_CENTER: {
      return state.merge({
        zoom: action.zoom,
        center: action.center,
      });
    }
    case TYPE.SET_ZOOM_CENTER_FAIL:
    case TYPE.SET_ZOOM_CENTER_SUCCES: {
      return state.merge({
        zoom: action.zoom,
        center: action.center,
      });
    }
    case TYPE.SET_UPDATE: {
      return state.merge({
        isUpdating: action.isUpdating,
      });
    }
    default:
      return state;
  }
};
export default maps;

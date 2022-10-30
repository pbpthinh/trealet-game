const HEADERS = {
  DEFAULT_HEADER: {
    "Content-Type": "application/json; charset=UTF-8",
  },
  header: () => ({
    "Content-Type": "application/json; charset=UTF-8",
    Authorization: localStorage.getItem("jwt"),
  }),
  jsonHeader: () => ({
    "Content-Type": "application/json; charset=UTF-8",
  }),
  file_header: () => ({
    "Content-Type": "multipart/form-data",
  }),
  scm_header: () => ({
    "Content-Type": "application/json; charset=UTF-8",
  }),
};

export const API_URLS = {
  GPS: {
    getGeolocation: () => ({
      endPoint: "https://geolocation-db.com/json",
      method: "GET",
      headers: {
        "Access-Control-Allow-Origin": "*",
        "Access-Control-Allow-Methods": "GET,PUT,POST,DELETE,PATCH,OPTIONS",
      },
    }),
  },
  MAPS: {
    getMaps: () => ({
      endPoint: `/maps-trealet`,
      method: "GET",
      headers: HEADERS.DEFAULT_HEADER,
    }),
  },
};

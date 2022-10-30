import axios from "axios";
const URL = "https://trealet.com";

export const getQuestion = (id) => {
  return axios({
    method: "post",
    url: `${URL}/api/trealet/${id}`,
  });
};

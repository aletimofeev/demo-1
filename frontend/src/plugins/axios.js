import axios from "axios";

const axiosInstance = axios.create({
  baseURL: process.env.VUE_APP_API_URL,
});

export default axiosInstance;

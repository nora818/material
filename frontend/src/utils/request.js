import axios from "axios";
import { Message } from "element-ui";
import router from "../router";

const request = axios.create({
    baseURL: "http://127.0.0.1:8000",
    timeout: 5000
})

// 请求拦截器
request.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('token')
        if (token) {
            config.headers.Authorization = `Bearer ${token}`
        }
        return config
    },
    (error) => Promise.reject(error)
)

// 响应拦截器
request.interceptors.response.use(
    (response) => response,
    (error) => {
        const { status, data } = error.response
        const { msg } = data
        Message.error(msg)
        if (status === 401) router.push({ name: "Login" })
        return Promise.reject(error)
    }
)

export default request
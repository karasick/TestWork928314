import axios from 'axios'
import { ACCESS_TOKEN_LOCAL_KEY } from './consts'

export const API_URL = 'http://localhost:8000'

const apiOptions = {
  withCredentials: true,
  baseURL: process.env.REACT_APP_API_URL || API_URL
}

const $host = axios.create(apiOptions)
const $authHost = axios.create(apiOptions)

const authInterceptor = config => {
  if (!config || !config.headers) {
    throw new Error('Config undefined.')
  }

  const token = localStorage.getItem(ACCESS_TOKEN_LOCAL_KEY)

  if (!token) {
    throw new Error('Access token undefined.')
  }

  config.headers.Authorization = `Bearer ${token}`
  return config
}

$authHost.interceptors.request.use(authInterceptor)

export {
  $host,
  $authHost
}

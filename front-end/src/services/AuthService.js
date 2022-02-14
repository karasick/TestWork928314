import { $authHost, $host } from '../http'

export default class PostService {
  static async register (registerData) {
    const payload = {
      name: registerData.name,
      email: registerData.email,
      password: registerData.password,
      password_confirmation: registerData.passwordConfirmation
    }
    const { data } = await $host.post('/api/register', payload)

    return data
  }

  static async login (loginData) {
    const payload = {
      email: loginData.email,
      password: loginData.password
    }
    const { data } = await $host.post('/api/login', payload)

    return data
  }

  static async logout () {
    const { data } = await $authHost.post('/api/logout')
    return data
  }

  static async refresh () {
    const { data } = await $host.get('/api/refresh')
    return data
  }
}

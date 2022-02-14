import { $authHost, $host } from '../http'

export default class PostService {
  static async getAll () {
    const { data } = await $host.get('/api/posts')
    return data
  }

  static async getOne (id) {
    const { data } = await $host.get('/api/posts/' + id)
    return data
  }

  static async create (post) {
    const { data } = await $authHost.post('/api/posts', post)
    return data
  }

  static async update (post) {
    const { data } = await $authHost.put('/api/posts', post)
    return data
  }

  static async delete (id) {
    const { data } = await $authHost.delete('/api/posts' + id)
    return data
  }
}

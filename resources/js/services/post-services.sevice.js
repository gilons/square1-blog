
import client from '../repositories/client';




export const getPosts = async (data) => {

    const posts = await client.get('posts', data)
    return posts.data
}

export const getPost = async (slug) => {
    const post = await client.get('posts/' + slug)
    return post.data
}

export const geRandomPost = async () => {
    const posts = await client.get('random-posts');
    return posts.data
}

export const addPost = async (data) => {
    const response = await client.post('posts',data)
    return response
}

export const getMyPost = async (data) => {
    const response = client.get('my-posts',data)
    return (await response).data
}
import axios from "axios"
import { post } from "jquery"

const baseURL = '/'


const client = {
    getURL(url) {
        return baseURL + url
    },
    get(url, data) {
        return axios.get(this.getURL(url), {params: data })
    },
    post(url, body) {
        return axios.post(this.getURL(url), body)
    }
}

export default client
import axios, { AxiosRequestConfig } from "axios";

const baseUrl = 'http://localhost'

class Apis {
    async postRegister(req: postAuthRequest, axiosonfig?: AxiosRequestConfig) {
        const data = new FormData()
        data.append('login_id', req.login_id)
        data.append('password', req.password)
        await axios.post<void>(`${baseUrl}/api/register`, data, {
            headers: { 'content-type': 'multipart/form-data' },
            ...axiosonfig
        })
    }

    async postAuth(req: postAuthRequest, axiosconfig?: AxiosRequestConfig) {
        const data = new FormData()
        data.append('login_id', req.login_id)
        data.append('password', req.password)
        await axios.post<void>(`${baseUrl}/api/auth`, data, {
            headers: { 'content-type': 'multipart/form-data' },
            ...axiosconfig
        })
    }
}

const apis = new Apis()
export default apis

export interface postAuthRequest {
    login_id: string
    password: string
}

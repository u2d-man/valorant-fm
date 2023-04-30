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
        const formData = new FormData()
        formData.append('login_id', req.login_id)
        formData.append('password', req.password)

        const data = await axios.post<authApiResponse>(`${baseUrl}/api/auth`, formData, {
            headers: { 'content-type': 'multipart/form-data' },
            ...axiosconfig
        })

        return data
    }
}

const apis = new Apis()
export default apis

export interface postAuthRequest {
    login_id: string
    password: string
}

export interface apiResponse {
    message: string
}

export interface authApiResponse {
    token: string
}

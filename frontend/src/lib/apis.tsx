import axios, { AxiosRequestConfig } from "axios";

const baseUrl = 'http://localhost'
class Apis {
    async postRegister(req: postRegisterRequest, axiosonfig?: AxiosRequestConfig) {
        const data = new FormData()
        data.append('login_id', req.login_id)
        data.append('password', req.password)
        await axios.post<void>(`${baseUrl}/api/register`, data, {
            headers: { 'content-type': 'multipart/form-data' },
            ...axiosonfig
        })
    }

    async postAuth() {
        await axios.post<void>(
            '/api/auth',
            {},
        )
    }
}

const apis = new Apis()
export default apis

export interface postRegisterRequest {
    login_id: string
    password: string
}

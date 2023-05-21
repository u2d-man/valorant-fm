import axios, { AxiosRequestConfig } from "axios";

const baseUrl = 'http://localhost'

class Apis {
    async postRegister(req: PostAuthRequest, axiosonfig?: AxiosRequestConfig) {
        const data = new FormData()
        data.append('login_id', req.login_id)
        data.append('password', req.password)
        await axios.post<void>(`${baseUrl}/api/register`, data, {
            headers: { 'content-type': 'multipart/form-data' },
            ...axiosonfig
        })
    }

    async postAuth(req: PostAuthRequest, axiosconfig?: AxiosRequestConfig) {
        const formData = new FormData()
        formData.append('login_id', req.login_id)
        formData.append('password', req.password)

        const data = await axios.post<AuthApiResponse>(`${baseUrl}/api/auth`, formData, {
            headers: { 'content-type': 'multipart/form-data' },
            ...axiosconfig
        })

        return data
    }

    async getMe(axiosconfig?: AxiosRequestConfig) {
        const { data } = await axios.get<GetMeResponse>(`${baseUrl}/api/user/me`, axiosconfig)

        return data
    }

    async postImage(req: PostImageRequest, axiosconfig?: AxiosRequestConfig) {
        const formData = new FormData()

        if (req.image) {
            formData.append('image', req.image, req.image.name)
        }
        const data = await axios.post<ApiResponse>(`${baseUrl}/api/image_upload`, formData, {
            headers: { 'content-type': 'multipart/form-data' },
            ...axiosconfig
        })

        return data
    }

    async getImageFiles(axiosconfig?: AxiosRequestConfig) {
        const { data } = await axios.get<GetimageFilesResponse>(`${baseUrl}/api/image_files`, axiosconfig)

        return data
    }
}

const apis = new Apis()
export default apis

export interface PostAuthRequest {
    login_id: string
    password: string
}

export interface PostImageRequest {
    image?: File
}

export interface ApiResponse {
    message: string
}

export interface AuthApiResponse {
    token: string
}

export interface GetimageFilesResponse {
    message: string
    data: string[]
}

export interface GetMeResponse {
    message: string
    data: string[]
}

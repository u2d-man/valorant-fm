import axios from "axios";

class Apis {
    async postRegister() {
        await axios.post<void>(
            '/api/register',
            {},
        )
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

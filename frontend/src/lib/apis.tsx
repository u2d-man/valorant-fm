import axios from "axios";

class Apis {
    async postAuth() {
        await axios.post<void>(
            '/api/auth',
            {},
        )
    }
}

const apis = new Apis()
export default apis

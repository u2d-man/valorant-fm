import ImageGrid from "components/ImageGrid"
import LoginPage from "./Login"
import Button from "components/Button"
import UploadFileButton from "components/UploadFileButton"
import { useState } from "react"
import apis, { PostImageRequest } from "lib/apis"
import { toast } from "react-hot-toast"

const Home = () => {
    const [file, setFile] = useState<File | null>(null)

    const onChangeFile = (e: React.ChangeEvent<HTMLInputElement>) => {
        const files = e.target.files
        if (files && files[0]) {
            setFile(files[0])
        }
    }

    const submit = async () => {
        if (!file) {
            return
        }
        const req: PostImageRequest = {}
        req.image = file
        try {
            const response = await apis.postImage(req)
            toast.success(response.data.message)
        } catch (e: any) {
            toast.error(e.response.data)
        }

    }

    return (
        <div>
            <LoginPage />
            <UploadFileButton onChangeFile={ onChangeFile } />
            <Button label="送信" disabled={ !file } onClick={ submit } />
            <ImageGrid />
        </div>
    )
}

export default Home

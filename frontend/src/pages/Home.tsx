import { useState } from "react"
import ImageGrid from "components/ImageGrid"
import LoginPage from "./Login"
import UplaodFileButton from "components/UploadFileButton"
import Button from "components/Button"
import apis, { PostImageRequest } from "lib/apis"
import { toast } from "react-hot-toast"

const Home = () => {
    const [file, setFile] = useState<File | null>(null)

    const submit = async () => {
        try {
            const req: PostImageRequest = {}
            if (file) {
                req.image = file
            }
            await apis.postImage(req)
        } catch (e: any) {
            toast.error(e.response.data)
        }
    }

    return (
        <div>
            <LoginPage />
            <UplaodFileButton image={ setFile } />
            <Button label="送信" onClick={ submit } />
            <ImageGrid />
        </div>
    )
}

export default Home

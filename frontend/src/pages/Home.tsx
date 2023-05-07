import ImageGrid from "components/ImageGrid"
import Button from "components/Button"
import UploadFileButton from "components/UploadFileButton"
import { ChangeEvent, useState } from "react"
import apis, { PostImageRequest } from "lib/apis"
import { toast } from "react-hot-toast"
import SignInPage from "./SignIn"

const Home = () => {
    const [file, setFile] = useState<File | null>(null)

    const onChangeFile = (e: ChangeEvent<HTMLInputElement>) => {
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
            <SignInPage />
            <UploadFileButton onChangeFile={ onChangeFile } />
            <Button
                customClass="mx-auto m-10 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                label="Submit"
                disabled={ !file }
                onClick={ submit }
            />
            <ImageGrid />
        </div>
    )
}

export default Home

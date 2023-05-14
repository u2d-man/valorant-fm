import ImageGrid from "components/ImageGrid"
import Button from "components/Button"
import UploadFileButton from "components/UploadFileButton"
import { ChangeEvent, useState } from "react"
import apis, { PostImageRequest } from "lib/apis"
import { toast } from "react-hot-toast"
import Header from "components/Header"
import SignInModal from "components/SignInModal"
import SignUpModal from "components/SignUpModal"
import ReactModal from "react-modal"

ReactModal.setAppElement('#root')

const Home = () => {
    const [show, setShow] = useState(false)
    const [regShow, regSetShow] = useState(false)
    const [file, setFile] = useState<File | null>(null)

    function openSignInModal() {
        setShow(true)
    }

    function openRegsterModal() {
        regSetShow(true)
    }

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
            <Header>
                <div className="flex justify-end mx-4">
                    <Button label="SignUp" customClass="mr-5 text-white" onClick={ openRegsterModal }/>
                    <Button label="SingIn" customClass="text-white" onClick={ openSignInModal }/>
                </div>
            </Header>
            <SignInModal show={ show } setShow={ setShow } />
            <SignUpModal show={ regShow } setShow={ regSetShow } />
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

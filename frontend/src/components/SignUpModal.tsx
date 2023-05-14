import apis, { PostAuthRequest } from "lib/apis"
import { useState } from "react"
import { toast } from "react-hot-toast"
import Modal from "react-modal"
import TextField from "components/TextField"
import MyModal from "./MyModal"
import Button from "./Button"

Modal.setAppElement('#root')

interface Props {
    show: boolean
    setShow: React.Dispatch<React.SetStateAction<boolean>>
}

const SignUpModal = ({ show, setShow }: Props) => {
    const [id, setId] = useState('')
    const [password, setPassword] = useState('')

    function closeModal() {
        setShow(false);
    }

    const submit = async () => {
        try {
            const req: PostAuthRequest = {
                login_id: id,
                password: password
            }
            const response = await apis.postRegister(req)
            if (response !== null && typeof response === "object") {
                setShow(false)
            }
            toast.success('signup success')
        } catch (e: any) {
            toast.error(e.response.data)
        }
    }

    return (
        <MyModal
            isOpen={ show }
            onRequestClose={ closeModal }
        >
            <p className="text-lg text-left">SignUp</p>
            <div className="block">
                <TextField placeholder="plase input your id" value={ id } setValue={ setId } type="text" label="Your user id" />
                <TextField placeholder="plase input your password" value={ password } setValue={ setPassword } type="password" label="Your password" />
            </div>
            <div className="flex justify-end">
                <Button label="submit" customClass="mt-5" onClick={ submit }></Button>
            </div>
        </MyModal>
    )
}

export default SignUpModal

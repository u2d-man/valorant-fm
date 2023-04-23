import Button from "components/Button"
import Header from "components/Header"
import Modal from "react-modal"
import { useState } from "react"
import TextField from "components/TextField"

Modal.setAppElement('#root')

const customStyles = {
    content: {
      top: '50%',
      left: '50%',
      right: 'auto',
      bottom: 'auto',
      marginRight: '-50%',
      transform: 'translate(-50%, -50%)',
    },
};

const LoginPage = () => {
    const [show, setShow] = useState(false)
    const [id, setId] = useState('')
    const [password, setPassword] = useState('')

    function openModal() {
        setShow(true)
    }

    function closeModal() {
        setShow(false);
    }

    return (
        <div>
            <Header>
                <div className="flex justify-end">
                    <Button label="SignUp" customClass="mr-5" onClick={ openModal }/>
                    <Button label="LogIn" onClick={ openModal }/>
                </div>
            </Header>
            <Modal
                isOpen={ show }
                onRequestClose={ closeModal }
                style={ customStyles }
                contentLabel="Example Modal"
            >
                <p className="text-lg text-left">Sign In</p>
                <div className="block">
                    <TextField placeholder="plase input your id" value={ id } setValue={ setId } type="text" label="Your user id" />
                    <TextField placeholder="plase input your password" value={ password } setValue={ setPassword } type="password" label="Your password" />
                </div>
                <div className="flex justify-end">
                    <Button label="submit" customClass="mt-5" onClick={ () => {} }></Button>
                </div>
            </Modal>
        </div>
    )
}

export default LoginPage
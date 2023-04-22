import Button from "components/Button"
import Header from "components/Header"
import Modal from "react-modal"
import { useState } from "react"
import TextField from "components/TextField"

const Home = () => {
    return <LoginPage />
}

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
                    <Button label="Login" onClick={ openModal }/>
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
                    <TextField placeholder="plase input your id" type="text" label="Your user id" />
                    <TextField placeholder="plase input your password" type="password" label="Your password" />
                </div>
                <div className="flex justify-end">
                    <Button label="submit" customClass="mt-5" onClick={ () => {} }></Button>
                </div>
            </Modal>
        </div>
    )
}

export default Home

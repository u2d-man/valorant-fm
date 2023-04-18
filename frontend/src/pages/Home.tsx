import Button from "components/Button"
import Header from "components/Header"
import Modal from "components/Modal"
import { useState } from "react"

const Home = () => {
    return <LoginPage />
}

const LoginPage = () => {
    const [show, setShow] = useState(false)

    return (
        <div>
            <Header>
                <Button label="Login" customClass="lg:flex lg:flex-1 lg:justify-end" onClick={ () => setShow(true) }/>
            </Header>
            <Modal show={ show } >
                <Button label="Close" onClick={ () => setShow(false) } />
            </Modal>
        </div>
    )
}

export default Home

import Button from "components/Button"
import Header from "components/Header"
import Modal from "components/Modal"
import TextField from "components/TextField"
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
            <Modal show={ show } modalTitle="SignIn" >
                <TextField placeholder="plase input your id" type="text"/>
                <TextField placeholder="plase input your password" type="password"/>
                <Button label="Submit" onClick={ () => setShow(false) } />
            </Modal>
        </div>
    )
}

export default Home

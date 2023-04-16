import Card from "components/Card"
import LoginButton from "components/LoginButton"

const Home = () => {
    return <LoginPage />
}

const LoginPage = () => {
    return (
        <div>
            <Card>
                <LoginButton />
            </Card>
        </div>
    )
}

export default Home

import { Route } from "react-router-dom"

const GuardedRoute = <T extends {path: string, children?: JSX.Element}>(props: T) => {
    if (props.path === '/') {
        return <Route {...props} />
    }

    return <Route {...props} />
}

export default GuardedRoute

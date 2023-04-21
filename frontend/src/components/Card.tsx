interface Props {
    children: JSX.Element
}

const Card = ({ children }: Props) => {
    return (
        <div>
            { children }
        </div>
    )
}

export default Card

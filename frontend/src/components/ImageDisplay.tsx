interface Props {
    imageName: string
}

const ImageDisplay = ({ imageName }: Props) => {
    return (
        <img className="rounded-lg shadow-md" src={ `${process.env.PUBLIC_URL}/images/${imageName}` } alt="Logo" />
    )
}

export default ImageDisplay

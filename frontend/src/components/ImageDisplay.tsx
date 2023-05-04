interface Props {
    imageName: string
}

const ImageDisplay = ({ imageName }: Props) => {
    return (
        <div className="rounded-lg shadow-md">
            <img src={ `${process.env.PUBLIC_URL}/images/${imageName}` } alt="Logo" />
        </div>
    )
}

export default ImageDisplay

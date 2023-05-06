interface Props {
    imageName: string
}

const ImageDisplay = ({ imageName }: Props) => {
    return (
        <div className="shadow-md">
            <img className="rounded-lg" src={ `${process.env.PUBLIC_URL}/images/${imageName}` } alt="Logo" />
        </div>
    )
}

export default ImageDisplay

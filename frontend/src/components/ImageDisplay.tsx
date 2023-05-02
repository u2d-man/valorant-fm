interface Props {
    imageName: string
}

const ImageDisplay = ({ imageName }: Props) => {
    return (
        <div className="">
            <img src={ `${process.env.PUBLIC_URL}/images/${imageName}` } alt="Logo" className="rounded-lg shadow-md" />
        </div>
    )
}

export default ImageDisplay

import ImageDisplay from "./ImageDisplay"

const ImageGrid = () => {
    const imageUrl = ['jett.jpg', 'jett.jpg', 'jett.jpg', 'jett.jpg', 'jett.jpg', 'jett.jpg']
    const itemList = imageUrl.map((item, index) => {
        return <ImageDisplay imageName={ item } key={ index } />
    })

    return (
        <div className="grid grid-cols-4 gap-4">
            { itemList }
        </div>
    )
}

export default ImageGrid

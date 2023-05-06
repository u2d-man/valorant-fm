import { useEffect, useState } from "react"
import ImageDisplay from "./ImageDisplay"
import apis, { GetimageFilesResponse } from "lib/apis"

const ImageGrid = () => {
    const [images, setImages] = useState<GetimageFilesResponse>()
    useEffect(() => {
        const fetchImages = async () => {
            setImages(await apis.getImageFiles())
        }
        fetchImages()
    }, [setImages])

    return (
        <div className="grid grid-cols-4 gap-4 mx-8">
            { images?.data.map((image, index) =>
                <ImageDisplay imageName={ image } key={ index } />) }
        </div>
    )
}

export default ImageGrid

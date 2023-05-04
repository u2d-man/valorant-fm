import { useEffect } from "react"
import Button from "./Button"

interface Props {
    image: (file: File) => void
}

const useImageSelect = (onSelect: (file: File) => void) => {
    const input = document.createElement('input')
    input.type = 'file'
    input.type = 'image/jpg'

    const onChange = () => {
        if (input.files && input.files[0]) {
            onSelect(input.files[0])
        }
    }

    input.addEventListener('change', onChange)

    const startSelect = () => {
        input.click()
    }

    const destloy = () => {
        input.removeEventListener('change', onChange)
    }

    return { startSelect, destloy }
}

const UplaodFileButton = ({ image }: Props) => {
    const { startSelect, destloy } = useImageSelect(image)
    useEffect(() => destloy)

    return (
        <Button
            label="upload image"
            onClick={ startSelect }
        />
    )
}

export default UplaodFileButton

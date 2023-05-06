import React from "react"

interface Props {
    onChangeFile: React.ChangeEventHandler<HTMLInputElement>
}

const UploadFileButton = ({ onChangeFile }: Props) => {
    return (
        <div>
            <input name="file" type="file" accept="image/jpg" onChange={ onChangeFile } />
        </div>
    )
}

export default UploadFileButton

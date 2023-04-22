interface Props {
    show: boolean
    modalTitle: string
    children?: JSX.Element | JSX.Element[]
}

const Modal = ({ show, modalTitle, children }: Props) => {
    if (show) {
        return (
            <div id="overlay" className="w-full h-full top-0 left-0 fixed flex items-center justify-center bg-gray-500 bg-opacity-80">
                <div className="relative w-full max-w-md max-h-full">
                    <div className="relative bg-white rounded-lg shadow">
                        <p className="text-2xl">{modalTitle}</p>
                        { children }
                    </div>
                </div>
            </div>
        )
    }

    return null
}

export default Modal

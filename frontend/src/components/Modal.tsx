interface Props {
    show: boolean
    children?: JSX.Element
}

const Modal = ({ show, children }: Props) => {
    if (show) {
        return (
            <div id="overlay" className="w-full h-full top-0 left-0 fixed flex items-center justify-center bg-gray-500 bg-opacity-80">
                <div className="z-2 w-96 h-96 p-1 rounded-lg bg-white">
                    <p>This is Modal.</p>
                    { children }
                </div>
            </div>
        )
    }

    return null
}

export default Modal

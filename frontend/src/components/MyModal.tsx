
import Modal from "react-modal"

interface Props {
    isOpen: boolean
    onRequestClose: (event: React.MouseEvent | React.KeyboardEvent) => void
    children: JSX.Element[]
}

const customStyles = {
    content: {
      top: '50%',
      left: '50%',
      right: 'auto',
      bottom: 'auto',
      marginRight: '-50%',
      transform: 'translate(-50%, -50%)',
    },
};

const MyModal = ({ isOpen, onRequestClose, children }: Props) => {
    return (
        <Modal
            isOpen={ isOpen }
            onRequestClose={ onRequestClose }
            style={ customStyles }
            contentLabel="MyModal"
        >
            { children }
        </Modal>
    )
}

export default MyModal;

import { ButtonHTMLAttributes, DetailedHTMLProps } from "react"

interface Props {
    label: string
    children?: JSX.Element
    customClass?: string
}

type ButtonProps = DetailedHTMLProps<ButtonHTMLAttributes<HTMLButtonElement>, HTMLButtonElement>

const Button = ({
    label,
    children,
    customClass,
    ...buttonProps
}: Props & ButtonProps) => {
    return (
        <button className={'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded ' + 
            customClass
            } {...buttonProps}>
            {children ? children : label}
        </button>
    )
}

export default Button

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
        <button className={'text-sm font-semibold leading-6 text-gray-900 ' +
            customClass
            } {...buttonProps}>
            {children ? children : label}
        </button>
    )
}

export default Button

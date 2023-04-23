import { DetailedHTMLProps, InputHTMLAttributes } from "react";

interface Props {
    placeholder: string
    value: string
    setValue: (newValue: string) => void
    type: string
    label: string
    inputProps?: InputProps
}

type InputProps = DetailedHTMLProps<
  InputHTMLAttributes<HTMLInputElement>,
  HTMLInputElement
>

const TextField = ({
    placeholder,
    value,
    setValue,
    type,
    label,
    inputProps
}: Props & InputProps) => {
    return (
        <div>
            <label className="block mt-5 mb-2 text-sm font-medium text-gray-900">{ label }</label>
            <input
                className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                type={ type }
                { ...inputProps }
                value={ value }
                placeholder={ placeholder }
                onChange={ e => setValue(e.target.value) }
            />
        </div>
    )
}

export default TextField

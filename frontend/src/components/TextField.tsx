import { ChangeEvent } from "react";

interface Props {
    placeholder: string
    type: string
    label: string
    onChange?:  (event: ChangeEvent<HTMLInputElement>) => void
}

const TextField = ({
    placeholder,
    type,
    label,
    onChange = (_) => undefined,
}: Props) => {
    return (
        <div>
            <label className="block mt-5 mb-2 text-sm font-medium text-gray-900">{ label }</label>
            <input
                className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                type={type}
                placeholder={placeholder}
                onChange={onChange}
            />
        </div>
    )
}

export default TextField

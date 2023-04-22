interface Props {
    children: JSX.Element
}

const Header = ({ children }: Props) => {
    return (
        <header>
            <nav className="items-center w-full p-6 lg:px-8">
                <div className="hidden lg:flex lg:flex-1 lg:justify-end">
                    { children }
                </div>
            </nav>
        </header>
    )
}

export default Header

interface Props {
    children: JSX.Element
}

const Header = ({ children }: Props) => {
    return (
        <header className="bg-sky-600">
            <nav className="items-center w-full p-4 lg:px-4">
                <div className="hidden lg:flex lg:justify-end">
                    <p className="mr-auto text-3xl text-white font-anton">VALORANT-fm</p>
                    { children }
                </div>
            </nav>
        </header>
    )
}

export default Header

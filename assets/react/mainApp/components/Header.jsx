function Header(){
    return (
        <header className="container myheader  d-flex align-items-center ">
            <div className="hearder_first_section ">
                <a href="" className="home_icon"><i className="fa-solid fa-house"></i></a>
                
            </div>
            <div className="hearder_second_section ">
                <input type="test" placeholder="search" className="search_bar"/>
                <button className="btn_search"><i className="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div className="hearder_third_section ">
                <a href="" className="login_icon"><i className="fas fa-user"></i></a>
                <a href="" className="cart_icon"><i className="fa-solid fa-cart-shopping"></i></a>
            </div>
    </header>
    )
}
export default Header
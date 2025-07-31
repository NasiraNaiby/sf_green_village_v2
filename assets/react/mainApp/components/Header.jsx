import { useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";
import { useCart } from "./CartContext";

function Header() {
  const { totalItems } = useCart();
  const navigate = useNavigate();

  const handleLoginClick = async (e) => {
    e.preventDefault();

    try {
      const response = await fetch("/api/user-status", {
        credentials: "include",
      });
      const data = await response.json();

      if (data.isAuthenticated) {
        navigate("/spaceclient"); // React page
      } else {
        window.location.href = "/login"; // Symfony page
      }
    } catch (error) {
      console.error("Could not check auth status", error);
      window.location.href = "/login";
    }
  };

  return (
    <header className="container myheader d-flex align-items-center">
      <div className="hearder_first_section">
        <img src="/images/logo1.png" alt="Logo" className="logo" />
      </div>
      <div className="hearder_second_section">
        <input type="text" placeholder="search" className="search_bar" />
        <button className="btn_search">
          <i className="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>
      <div className="hearder_third_section position-relative">
        <a href="#" onClick={handleLoginClick} className="login_icon">
          <i className="fas fa-user"></i>
        </a>

        <Link to="/panier" className="cart_icon position-relative">
          <i className="fa-solid fa-cart-shopping"></i>
          {totalItems > 0 && (
            <span className="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              {totalItems}
            </span>
          )}
        </Link>
      </div>
    </header>
  );
}

export default Header;

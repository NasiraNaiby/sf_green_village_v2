import { useParams } from "react-router-dom";
import { useEffect, useState } from "react";
import axios from "axios";

function Panier() {
  const { id } = useParams();
  const [produits, setProduits] = useState([]);
  const [cart, setCart] = useState([]);

  // Load cart from localStorage
  useEffect(() => {
    const storedCart = localStorage.getItem("cart");
    if (storedCart) {
      setCart(JSON.parse(storedCart));
    }
  }, []);

  // Save cart to localStorage
  useEffect(() => {
    localStorage.setItem("cart", JSON.stringify(cart));
  }, [cart]);

  // Fetch products
  useEffect(() => {
    axios.get("http://127.0.0.1:8000/api/produits")
      .then(response => {
        if (response.data && Array.isArray(response.data.member)) {
          setProduits(response.data.member);
        }
      })
      .catch(console.error);
  }, []);

  // Add product to cart
  useEffect(() => {
    if (!id || produits.length === 0) return;

    const productId = parseInt(id);
    const produit = produits.find(p => p.id === productId);
    if (!produit) return;

    setCart(prevCart => {
      const existingIndex = prevCart.findIndex(item => item.id === produit.id);
      if (existingIndex !== -1) {
        const newCart = [...prevCart];
        newCart[existingIndex].quantity += 1;
        return newCart;
      } else {
        return [...prevCart, { ...produit, quantity: 1 }];
      }
    });
  }, [id, produits]);

  // Quantity controls
  const increaseQuantity = (id) => {
    setCart(prevCart => prevCart.map(item => {
      if (item.id === id) return { ...item, quantity: item.quantity + 1 };
      return item;
    }));
  };

  const decreaseQuantity = (id) => {
    setCart(prevCart => prevCart.map(item => {
      if (item.id === id) return { ...item, quantity: Math.max(1, item.quantity - 1) };
      return item;
    }));
  };

  const removeFromCart = (id) => {
  setCart(prevCart => prevCart.filter(item => item.id !== id));
};


  const totalPrice = cart.reduce((acc, item) => acc + item.vent_prix * item.quantity, 0);

  // Split cart into two rows if more than 4 items
  const firstRowItems = cart.slice(0, 4);
  const secondRowItems = cart.slice(4);

 return (
  <section className="ajouter_au_panier mt-5">
    <div className="container">
      <h2 className="text-center mb-4">Votre Panier</h2>

      <div className="row marque_vedettes_card">
        {/* Form always be in left column */}
        <div className={cart.length > 4 ? "col-md-12" : "col-md-6"} checkout_section>
          <form>
            <input type="text" className="form-control form-section mb-2" placeholder="Nom et prénom" />
            <input type="email" className="form-control form-section mb-2" placeholder="Email" />
            <label className="mb-1 mt-2">Adresse</label>
            <textarea className="form-control mb-3" rows="2" placeholder="Adresse complète"></textarea>
            <input type="text" className="form-control form-section mb-2" placeholder="Ville" />
            <div className="d-flex gap-2 mb-2">
              <input type="text" className="form-control form-section w-50" placeholder="Code postal" />
              <input type="tel" className="form-control form-section w-50" placeholder="Téléphone" />
            </div>
            <button type="submit" className="btn confirm-btn w-100 mt-3 btn-primary">Confirmer</button>
          </form>
        </div>

        {/* Cart Section */}
        <div className={cart.length > 4 ? "col-md-12 mt-4" : "col-md-6"} produits_ajoutés>
          {cart.length === 0 ? (
            <p>Votre panier est vide.</p>
          ) : (
            cart.map(item => (
              <div key={item.id} className="cart-item d-flex align-items-center justify-content-between mb-4">
              <div className="d-flex align-items-center">
                <img src={item.photo} alt={item.nom_produit} height="100px" width="100px" />
                <div className="ms-3">
                  <p className="mb-1 fw-bold">{item.nom_produit}</p>
                  <div className="d-flex align-items-center gap-2 mb-1">
                    <button className="btn btn-sm btn-secondary fw-bold " onClick={() => decreaseQuantity(item.id)}>-</button>
                    <span>{item.quantity}</span>
                    <button className="btn btn-sm btn-secondary fw-bold " onClick={() => increaseQuantity(item.id)}>+</button>
                  </div>
                  <p className="mb-0 fw-bold">{Number(item.vent_prix).toFixed(2)} €</p>
                </div>
              </div>

              {/*  Remove Button */}
              <button className="btn btn-sm btn-danger ms-3" onClick={() => removeFromCart(item.id)}>
                Supprimer
              </button>
            </div>

            ))
          )}

          <div className="total-section text-end mt-4">
            <h5 className="fw-bold">Total: {totalPrice.toFixed(2)} €</h5>
          </div>
        </div>
      </div>
    </div>
  </section>
);

}

export default Panier;

// Sections.jsx

import { useEffect, useState } from "react";
import axios from "axios";
import { useParams } from "react-router-dom";
import { useCart } from "./CartContext"; 




function getCart() {
const cart = localStorage.getItem("cart");
return cart ? JSON.parse(cart) : [];
}

function saveCart(cart) {
localStorage.setItem("cart", JSON.stringify(cart));
}

export function addToCart(product) {
const cart = getCart();
const existingIndex = cart.findIndex((item) => item.id === product.id);
if (existingIndex !== -1) {
  cart[existingIndex].quantity += 1;
} else {
  cart.push({ ...product, quantity: 1 });
}
saveCart(cart);
}


export function ProduitNeuf() {
return (
  <section className="neuf_section mt-5">
    what is neww
  </section>
);
}

export function CategoireSection() {
const [categories, setCategories] = useState([]);

useEffect(() => {
  axios.get("http://127.0.0.1:8000/api/categories")
    .then(response => {
      if (response.data && Array.isArray(response.data.member)) {
        setCategories(response.data.member);
      } else {
        console.warn("Unexpected API response:", response.data);
      }
    })
    .catch(error => {
      console.error("Error fetching categories:", error);
    });
}, []);

return (
  <section className="cat_section mt-5">
    <div className="container">
      <div className="row">
        {Array.isArray(categories) && categories.map(cat => (
          <div className="col-md-3 col-sm-6 mb-4" key={cat.id}>
            <div className="card">
              <img src="/images/ins.jpg" className="card-img-top" alt={cat.nom_cat} />
              <div className="card-body">
                <h5 className="card-title">{cat.nom_cat}</h5>
                <p className="card-text">{cat.desc_cat}</p>
                <a href={`/categorie/${cat.id}`} className="btn btn-primary">Voir produits</a>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  </section>
);
}

export function ProduitsParCategorie() {
const { id } = useParams();
const [produits, setProduits] = useState([]);
const [loading, setLoading] = useState(true);

useEffect(() => {
  axios.get("http://127.0.0.1:8000/api/produits")
    .then((response) => {
      if (response.data && Array.isArray(response.data.member)) {
        const filtered = response.data.member.filter(
          (p) => p.categorie?.includes(`/categories/${id}`)
        );
        setProduits(filtered);
      } else {
        console.warn("Unexpected response:", response.data);
      }
    })
    .catch((error) => {
      console.error("Error fetching produits:", error);
    })
    .finally(() => {
      setLoading(false);
    });
}, [id]);

if (loading) return <p>Chargement des produits...</p>;

return (
  <section className="produit_section mt-5">
    <div className="container">
      <h2 className="text-center mb-4">Produits de la catégorie {id}</h2>
      <div className="row">
        {produits.length > 0 ? (
          produits.map((produit) => (
            <div className="col-md-3 col-sm-6 mb-4" key={produit.id}>
              <div className="card">
                <img src={produit.photo} className="card-img-top" alt={produit.nom_produit} />
                <div className="card-body">
                  <h5 className="card-title">{produit.nom_produit}</h5>
                  <p className="card-text">{produit.desc_produit}</p>
                  <p className="card-text">{produit.vent_prix} €</p>
                  <a href={`/panier/${produit.id}`} className="btn btn-primary">Ajouter au panier</a>
                </div>
              </div>
            </div>
          ))
        ) : (
          <p>Aucun produit trouvé pour cette catégorie.</p>
        )}
      </div>
    </div>
  </section>
);
}

export function ProduitVedettes() {
  const [produits, setProduits] = useState([]);
  const { addToCart } = useCart();

  useEffect(() => {
    axios.get("http://127.0.0.1:8000/api/produits").then((response) => {
      if (response.data && Array.isArray(response.data.member)) {
        setProduits(response.data.member);
      }
    });
  }, []);

  return (
    <section className="produit_section">
      <div className="container">
        <div className="row">
          {produits.map((produit) => (
            <div className="col-12 col-sm-6 col-md-4 col-lg-3 mb-4" key={produit.id}>
              <div className="card h-100">
                <img src={produit.photo} className="card-img-top" />
                <div className="card-body d-flex flex-column">
                  <h5 className="card-title">{produit.nom_produit}</h5>
                  <button
                    className="btn btn-primary mt-auto"
                    onClick={() => {
                      addToCart(produit);
                      alert(`${produit.nom_produit} a été ajouté au panier !`);
                    }}
                  >
                    Ajouter au panier
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}


export function MarquesVedettes() {
return (
  <section className="marque_vedettes mt-5">
    <div className="container">
      <h2 className="text-center mb-4">Marques Vedettes</h2>
      <div className="marque_vedettes_card">
        <div className="brand-image">
          <img src="/images/ins.jpg" className="img-fluid" alt="Brand 1" />
        </div>
        <div className="brand_desc">
          <p>
            Ceci est une description exemple de la marque vedette.
          </p>
        </div>
        <div className="brand_btn">
          <button className="btn_voir_plus">Voir</button>
        </div>
      </div>
    </div>
  </section>
);
}
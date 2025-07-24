
import { useEffect, useState } from "react";
import axios from "axios";
export function  ProduitNeuf(){
    return(
        <section className="neuf_section mt-5">
            what is neww
         </section>
    )
}



export function  CategoireSection(){

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
                    <a href="#" className="btn btn-primary">Voir produits</a>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    );
}


export function ProduitVedettes() {
    const [produits, setProduits] = useState([]);
  
    useEffect(() => {
      axios.get("http://127.0.0.1:8000/api/produits")
        .then(response => {
          if (response.data && Array.isArray(response.data.member)) {
            setProduits(response.data.member);
          } else {
            console.warn("Unexpected API response:", response.data);
          }
        })
        .catch(error => {
          console.error("Error fetching produits:", error);
        });
    }, []);
  
    return (
      <section className="produit_section mt-5">
        <div className="container">
          <h2 className="text-center mb-4">Produits Vedettes</h2>
          <div className="row">
            {produits.map(produit => (
              <div className="col-md-3 col-sm-6 col-md-4 mb-3" key={produit.id}>
                <div className="card">
                <img src={produit.photo} alt={produit.nom_produit} />
                  <div className="card-body">
                    <h5 className="card-title">{produit.nom_produit}</h5>
                    <p className="card-text">{produit.desc_produit}</p>
                    <p className="card-text">{produit.vent_prix} €</p>
                    <a href="#" className="btn btn-primary">Acheter</a>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    );
  }
  


export function  MarquesVedettes(){
    return(
        <section className="marque_vedettes mt-5">
        <div className="container">
            <h2 className="text-center mb-4">Marques Vedettes</h2>
            <div className=" marque_vedettes_card">
                <div className="brand-image">
                    <img src="/images/ins.jpg" className="img-fluid" alt="Brand 1" />
                </div>
                <div className="brand_desc">
                    <p>
                        ksdjhfkjdshfkjdhfksdjhfkj
                        ksdjhfkjdshfkjdhf
                        ksdjhfkjdshfkjdhf
                        ksdjhfkjdshfkjdhf
                        ksdjhfkjdshfkjdhfdshfkjdhfksdjhfkjdshf
                        kjdhfksdjhfkjdshfkjdhf
                    </p>
                </div>
                <div className="brand_btn">
                    <button className="btn_voir_plus">Voir</button>
                </div>
            </div>
        </div>
    </section>
    )
}

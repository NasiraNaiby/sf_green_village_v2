function Panier() {
    return (
      <section className="ajouter_au_panier mt-5">
        <div className="container">
          <h2 className="text-center mb-4">Votre Panier</h2>
          <div className="row marque_vedettes_card">
            {/* Form Section */}
            <div className="col-md-6 checkout_section">
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
           {/* produit List Section */}
            <div className="col-md-6 produits_ajoutés">
            <div className="w-100">
                {/* produit 1 */}
                <div className="cart-item d-flex align-items-center mb-4">
                <img src="/images/ins.jpg" alt="Guitar" height="50px"width="50px" />
                <div className="ms-3">
                    <p className="mb-1">Nom de la produit</p>
                    <input
                    type="number"
                    min="1"
                    defaultValue="1"
                    className="form-control quantity-input mb-1 w-auto"
                    style={{ width: "80px" }}
                    />
                    <p className="mb-0">$458.99</p>
                </div>
                </div>

                {/* produit 2 */}
                <div className="cart-item d-flex align-items-center mb-4">
                <img src="/images/ins.jpg" alt="Guitar" height="50px"width="50px" />
                <div className="ms-3">
                    <p className="mb-1">Nom de la produit</p>
                    <input
                    type="number"
                    min="1"
                    defaultValue="1"
                    className="form-control quantity-input mb-1 w-auto"
                    style={{ width: "80px" }}
                    />
                    <p className="mb-0">$458.99</p>
                </div>
                </div>

                {/* Total Section */}
                <div className="total-section text-end mt-4">
                <h5 className="fw-bold">Total: $917.98</h5>
                </div>
            </div>
            </div>

          </div>
        </div>
      </section>
    );
  }
  
  export default Panier;
  
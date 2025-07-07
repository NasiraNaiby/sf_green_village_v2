
function MyNav() {

    console.log("test")
    return (
      <nav className="navbar navbar-expand-lg mynavbar bg-light">
          <div className="container-fluid">  
              <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                  aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span className="navbar-toggler-icon"></span>
              </button>
              <div className="collapse navbar-collapse" id="navbarNav">
                  <ul className="navbar-nav nav_items">
                      <li className="nav-item"><a className="nav-link active" href="#">Accueil</a></li>
                      <li className="nav-item"><a className="nav-link" href="#">Categories</a></li>
                      <li className="nav-item"><a className="nav-link" href="#">Produit</a></li>
                      <li className="nav-item"><a className="nav-link" href="#">Catalog</a></li>
                      <li className="nav-item"><a className="nav-link" href="#">Fournisseurs</a></li>
                  </ul>
              </div>
              <div className="navbar_logo_section">
                  <a href="#" className="navbar-brand">Site Title</a>
              </div>
          </div>
      </nav>
    )
}

export default MyNav

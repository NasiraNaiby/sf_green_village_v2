import { Link } from "react-router-dom";
function MyNav() {

    return (
      <nav className="navbar navbar-expand-lg mynavbar bg-light">
          <div className="container-fluid">  
              <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                  aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span className="navbar-toggler-icon"></span>
              </button>
              <div className="collapse navbar-collapse" id="navbarNav">
                  <ul className="navbar-nav nav_items">
                    {/* the links i have use here instead of the acnhor tags <a href=""></a> has the same functionality like 
                    a tag but it prevents sending the request any time we clikc on the link because it matched the likn in the 
                    routes we have defined in the main.jsx file and much queicker becuqse we only expect the html data*/}
                      <li className="nav-item"><Link className="nav-link active" to="/react">Accueil</Link></li>
                      <li className="nav-item"><Link className="nav-link" to="/catgories">Catégories</Link></li>
                      <li className="nav-item"><Link className="nav-link" to="/produit">Produit</Link></li>
                      <li className="nav-item"><Link className="nav-link" to="#">Catalog</Link></li>
                      <li className="nav-item"><Link className="nav-link" to="/marque">Fournisseurs</Link></li>
                  </ul>
              </div>
              <div className="navbar_logo_section">
                  <Link to="#" className="navbar-brand">Village Green</Link>
              </div>
          </div>
      </nav>
    )
}

export default MyNav

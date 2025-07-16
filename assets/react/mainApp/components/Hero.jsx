function Hero() {
  return (
    <section className="py-lg-16 py-6 bg-light">
      <div className="container py-6">
        <div className="row d-flex align-items-center">
          {/* Section texte */}
          <div className="col-xxl-5 col-xl-6 col-lg-6 col-12">
            <div className="fist">
              <h1 className=" fw-bold mb-3 mt-3">
                Trouvez votre <u className="text-dark"><span className="text-success">son parfait</span></u>
              </h1>
              <p className="lead mb-4">
               Lorem ipsum, dolor sit amet consectetur adipisicing elit. 
               rem porro aut nulla enim quia quod dolor ex numquam voluptatum provident quasi.
              </p>
              <ul className="list-unstyled mb-5">
                {[
                  "Livraison rapide et sécurisée",
                  "Assistance client 24h/24 et 7j/7",
                  "Instruments de haute qualité",
                  "Retour facile et garantie"
                ].map((item, i) => (
                  <li className="mb-2" key={i}>
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="12"
                      height="12"
                      fill="var(--gk-success)"
                      className="bi bi-check-circle-fill"
                      viewBox="0 0 16 16"
                    >
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                    <span className="ms-2">{item}</span>
                  </li>
                ))}
              </ul>
              <a href="/produit" className="btn_hero btn btn-lg mb-5">
                Découvrir la boutique
              </a>
            </div>
          </div>

          {/* Section image */}
          <div className="col-xxl-5 offset-xxl-1 col-xl-6 col-lg-6 col-12 d-lg-flex justify-content-end">
            <div className="mt-12 mt-lg-0 position-relative">
              {/* Image décorative en haut à gauche */}
              <div className="position-absolute top-0 start-0 translate-middle d-none d-md-block">
                <img
                  src="/images/music.png"
                  alt="graphique décoratif" 
                  className="animate-float"
                  style={{
                    width: '200px',
                    height: '200px',
                    objectFit: 'contain',
                    zIndex: 1
                  }}
                />
              </div>

              {/* Image principale */}
              <img
                src="/images/greenguit.jpg"
                alt="Instruments de musique"
                className="img-fluid rounded-4 w-100 z-1 position-relative shadow-float animate-scale"
              />


              {/* Image décorative en bas à droite */}
              <div className="position-absolute top-100 start-100 translate-middle d-none d-md-block">
                <img
                  src="/images/music.png"
                  alt="graphique décoratif"
                  className="animate-float"
                  style={{ width: '200px', height: '200px' }}
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}

export default Hero;

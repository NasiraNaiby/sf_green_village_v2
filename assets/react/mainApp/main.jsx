import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import '../../styles/styles.css';
import '@fortawesome/fontawesome-free/css/all.css';
import { link } from 'react-router-dom';
import MyNav from './components/MyNav.jsx';
import Header from './components/Header.jsx';
import { ProduitNeuf, CategoireSection, ProduitVedettes, MarquesVedettes , ProduitsParCategorie} from './components/Sections.jsx';
import Footer from './components/Footer.jsx';
import Panier from './components/Panier.jsx';
import Login from './components/Login.jsx';
import Presentation from './components/Presentation.jsx';
import NotreMagasin from './components/NotreMagasin.jsx';
import Hero from './components/Hero.jsx';

createRoot(document.getElementById('root')).render(
  <Router>
    <div className="App">
      <MyNav />
      <Header />
      
      <Routes>
        <Route
          path="/react"
          element={
            <>
              <Hero />  
              <ProduitNeuf />
              <CategoireSection />
              <ProduitVedettes />
              <MarquesVedettes />
            </>
          }
        />
        <Route path="/catgories" element={<CategoireSection />} />
        <Route path="/produit" element={<ProduitVedettes />} />
        <Route path="/categorie/:id" element={<ProduitsParCategorie />} />
        <Route path="/marque" element={<MarquesVedettes />} />
        <Route path="/login" element={<Login />} />
        <Route path="/panier" element={<Panier />} />
        <Route path="/presentation" element={<Presentation />} />
        <Route path="/magasin" element={<NotreMagasin />} />
      </Routes>

      {/* Footer  appears on every page */}
      <Footer />
    </div>
  </Router>
);


import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import { BrowserRouter as Router, Route, Routes } from 'react-router-dom';
import '../../styles/styles.css';
import '@fortawesome/fontawesome-free/css/all.css';
import { link } from 'react-router-dom';
import MyNav from './components/MyNav.jsx';
import Header from './components/Header.jsx';
import HeaderSlideShow from './components/HeaderSlideShow.jsx';
import { ProduitNeuf, CategoireSection, ProduitVedettes, MarquesVedettes } from './components/Sections.jsx';
import Footer from './components/Footer.jsx';
import Panier from './components/Panier.jsx';
import Login from './components/Login.jsx';

createRoot(document.getElementById('root')).render(
  <Router>
    <div className="App">
      {/* These appear on every page */}
      <MyNav />
      <Header />
      <HeaderSlideShow />
      <Routes>
        <Route
          path="/react"
          element={
            <>
              <ProduitNeuf />
              <CategoireSection />
              <ProduitVedettes />
              <MarquesVedettes />
            </>
          }
        />

        <Route path="/catgories" element={<CategoireSection />}/>
        <Route path="/produit" element={<ProduitVedettes />} />
        <Route path="/marque" element={<MarquesVedettes />} />
        <Route path="/login" element={<Login />} />
        <Route path="/panier" element={<Panier />} />
      </Routes>

      {/* Footer also appears on every page */}
      <Footer />
    </div>
  </Router>
);

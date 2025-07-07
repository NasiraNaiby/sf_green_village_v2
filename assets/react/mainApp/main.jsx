import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import  '../../styles/styles.css'
import '@fortawesome/fontawesome-free/css/all.css';
import MyNav from './components/MyNav.jsx'
import Header from './components/Header.jsx'
import HeaderSlideShow from './components/HeaderSlideShow.jsx';
import {ProduitNeuf, CategoireSection, ProduitVedettes, MarquesVedettes} from './components/Sections.jsx'
import Footer from './components/Footer.jsx';




createRoot(document.getElementById('root')).render(

    
    <>
        <MyNav />
        <Header />
        <HeaderSlideShow />
        <ProduitNeuf />
        <CategoireSection />
        <ProduitVedettes />
        <MarquesVedettes />
        <Footer />
    </>
   
)


import { Link } from "react-router-dom";
function Footer(){
    return(
        <footer className="myfooter bg-light mt-3">
        <div className="container">  
            <div className="footer_links">
                <div className="footer_navigate_links" >
                    <p><Link to="/presentation" className="navigate_links">Qui sommes nous... </Link></p>
                    <p><Link to="/magasin" className="navigate_links">Notre Magasins ... </Link></p>
                    <p><Link to="" className="navigate_links">Information legal...</Link></p>
                    <p><Link to="" className="navigate_links"></Link></p>
                </div>
                <div className="footer_social_links">
                    <p><Link to="" className="social_media" ><i className="fa-brands fa-facebook"></i></Link></p>
                    <p><Link to="" className="social_media" ><i className="fa-brands fa-instagram"></i></Link></p>
                    <p><Link to="" className="social_media"><i className="fa-brands fa-x-twitter"></i></Link></p>
                    <p><Link to="" className="social_media" ><i className="fa-solid fa-envelope"></i></Link></p>
                </div>
            </div>             
            <p className="copyright">	&169; 2025 Village Green. Tous droits réservés. </p>
        </div>
    </footer> 
    )
}

export default Footer
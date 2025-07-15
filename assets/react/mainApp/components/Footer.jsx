function Footer(){
    return(
        <footer className="myfooter bg-light mt-3">
        <div className="container">  
            <div className="footer_links">
                <div className="footer_navigate_links" >
                    <p><a href="" className="navigate_links">Qui sommes nous... </a></p>
                    <p><a href="" className="navigate_links">Notre Magasins ... </a></p>
                    <p><a href="" className="navigate_links">Information legal...</a></p>
                    <p><a href="" className="navigate_links"></a></p>
                </div>
                <div className="footer_social_links">
                    <p><a href="#" className="social_media" ><i className="fa-brands fa-facebook"></i></a></p>
                    <p><a href="#" className="social_media" ><i className="fa-brands fa-instagram"></i></a></p>
                    <p><a href="#" className="social_media"><i className="fa-brands fa-x-twitter"></i></a></p>
                    <p><a href="#" className="social_media" ><i className="fa-solid fa-envelope"></i></a></p>
                </div>
            </div>             
            <p className="copyright">	&#169; 2025 Village Green. Tous droits réservés. </p>
        </div>
    </footer> 
    )
}

export default Footer
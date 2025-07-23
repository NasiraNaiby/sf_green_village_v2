
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
   return(

        <section className="cat_section mt-5">
        <div className="container">
            <div className="row">
                <div className="col-md-3 col-sm-6 mb-4">
                    <div className="card">
                        <img src="/images/ins.jpg" className="card-img-top" alt="#" />
                        <div className="card-body">
                            <h5 className="card-title">Card title</h5>
                            <p className="card-text">Some quick example text.</p>
                            <a href="#" className="btn btn-primary">Click</a>
                        </div> 
                    </div>
                </div>

                <div className="col-md-3 col-sm-6 mb-4">
                    <div className="card">
                        <img src="/images/ins.jpg" className="card-img-top" alt="#" />
                        <div className="card-body">
                            <h5 className="card-title">Card title</h5>
                            <p className="card-text">Some quick example text.</p>
                            <a href="#" className="btn btn-primary">Click</a>
                        </div>
                    </div>
                </div>

                <div className="col-md-3 col-sm-6 mb-4">
                    <div className="card">
                        <img src="/images/ins.jpg" className="card-img-top" alt="#" />
                        <div className="card-body">
                            <h5 className="card-title">Card title</h5>
                            <p className="card-text">Some quick example text.</p>
                            <a href="#" className="btn btn-primary">Click</a>
                        </div>
                    </div>
                </div>
                <div className="col-md-3 col-sm-6 mb-4">
                    <div className="card">
                        <img src="/images/ins.jpg" className="card-img-top" alt="#" />
                        <div className="card-body">
                            <h5 className="card-title">Card title</h5>
                            <p className="card-text">Some quick example text.</p>
                            <a href="#" className="btn btn-primary">Click</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   )
}


export function  ProduitVedettes(){
    return(
        <section className="produit_section mt-5">
        <div className="container">
            <h2 className="text-center mb-4">Produit Vedettes</h2>
            <div className="row">
                <div className="col-md-3 col-sm-6 col-md-4 mb-3">
                    <div className="card">
                        <img src="/images/ins.jpg" alt="img" className="card-img-top" />
                        <div className="card-body">
                            <h5 className="card-title">produit</h5>
                            <p className="card-text">the discripttion of the product</p>
                            <p className="card-text">29.50</p>
                            <a href="#" className="btn btn-primary">Acheter</a>
                        </div>
                    </div>
                </div>

                <div className="col-md-3 col-sm-6 col-md-4 mb-3">
                    <div className="card">
                        <img src="/images/ins.jpg" alt="" className="card-img-top" />
                        <div className="card-body">
                            <h5 className="card-title">produit</h5>
                            <p className="card-text">the discripttion of the product</p>
                            <p className="card-text">29.50</p>
                            <a href="#" className="btn btn-primary">Acheter</a>
                        </div>
                    </div>
                </div>

                <div className="col-md-3 col-sm-6 col-md-4 mb-3">
                    <div className="card">
                        <img src="/images/ins.jpg" alt="" className="card-img-top" />
                        <div className="card-body">
                            <h5 className="card-title">produit</h5>
                            <p className="card-text">the discripttion of the product</p>
                            <p className="card-text">29.50</p>
                            <a href="#" className="btn btn-primary">Acheter</a>
                        </div>
                    </div>
                </div>
                <div className="col-md-3 col-sm-6 col-md-4 mb-3">
                    <div className="card">
                        <img src="/images/ins.jpg" alt="" className="card-img-top" />
                        <div className="card-body">
                            <h5 className="card-title">produit</h5>
                            <p className="card-text">the discripttion of the product</p>
                            <p className="card-text">29.50</p>
                            <a href="#" className="btn btn-primary">Acheter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
    )
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

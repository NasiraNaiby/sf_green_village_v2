<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Panier{
    private $session;
    private $repo;

    public function __construct( ProduitsRepository $repo, RequestStack $requeststack){
        $this->repo = $repo;
        $this->requeststack = $requeststack;

    }

    public function add($id){
       
        $panier = $this->session->get('panier', []);
        $produit = $this->repo->find($id);
        if(isset($panier[$produit->getId()])){
             $panier[$produit->getId()] ++;
        }
        else{
            $panier[$produit->getId()] = 1;
        }
        $this->session->set('panier', $panier);
    }
}
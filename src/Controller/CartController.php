<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */

     public function index(){
         return $this->render('cart/cart.html.twig', []);
     }

    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function add($id, Request $request){
        $session = $request->getSession();
        // Si je n'ai pas de panier, je veux un tableau vide 
        $panier = $session->get('panier', []);
        $panier[$id]= 1;
        $session->set('panier', $panier);

        dd($session->get('panier'));

    }
}

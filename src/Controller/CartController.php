<?php


namespace App\Controller;

use App\Entity\Vol;
use App\Repository\VolRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart_")
     */

    public function index(SessionInterface $session, VolRepository $volRepository)
    {
        $panier = $session->get("panier", []);

        // On "fabrique" les données
        $dataPanier = [];
        $total = 0;

        foreach($panier as $id => $quantite){
            $vol = $volRepository->find($id);
            $dataPanier[] = [
                "vol" => $vol,
                "quantite" => $quantite
            ];
            $total += $vol->getPrix() * $quantite;
        }

        return $this->render('cart/cart.html.twig', compact("dataPanier", "total"));
    }

    /**
     * @Route("/add/{id}", name="cart_add")
     */
    public function add(VolRepository $vol, SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $vol->getId();

        if(!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id] = 1;
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute('cart/cart.html.twig', []);
    }
}

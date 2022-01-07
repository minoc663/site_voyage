<?php



namespace App\Controller;

use App\Cart;
use App\Entity\Vol;

use App\Entity\Hebergement;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/mon-panier", name="cart")
     */
    public function index(Cart $cart)
    {
        $cartComplete =[];

        foreach ($cart->get() as $id => $quantity){
            $cartComplete[] = [
                'vol' => $this->entityManager->getRepository(Vol::class)->find($id),
                'quantity' => $quantity
            ];
        }

        return $this->render('cart/cart.html.twig', [
            'cart' => $cartComplete
        ]);
    
    }

    /**
     * @Route("/cart/add/{id}", name="add_to_cart")
     */
    public function add(Cart $cart, $id)
    {
        $cart->add($id);
        
        return $this->redirectToRoute('cart');
    
    }

    //REMOVE
    /**
     * @Route("/cart/remove", name="remove_my_cart")
     */
    public function remove(Cart $cart)
    {
        $cart->remove();
        return $this->redirectToRoute('home');
    
    }
}



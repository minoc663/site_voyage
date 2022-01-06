<?php

namespace App\Service\Panier;

use App\Repository\VolRepository;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService
{

    public $session;
    public $volRepository;

    public function __construct(SessionInterface $session, VolRepository $volRepository)
    {
        $this->session = $session;
        $this->volRepository = $volRepository;

    }

    public function add(int $id)
    {
        $panier = $this->session->get('panier', []);

        if (empty($panier[$id])):
            $panier[$id] = 1;
        else:
            $panier[$id]++;
        endif;

        $this->session->set('panier', $panier);
    }

    public function remove(int $id)
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id]) && $panier[$id] !== 1):
            $panier[$id]--;
        else:
            unset($panier[$id]);
        endif;

        $this->session->set('panier', $panier);
    }

    public function delete(int $id)
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])):
            unset($panier[$id]);
        endif;

        $this->session->set('panier', $panier);
    }


    public function getFullCart(): array
    {
        $panier = $this->session->get('panier', []);

        $panierDetail = [];

        foreach ($panier as $id => $quantite):

            $panierDetail[]=[
                'vol'=>$this->volRepository->find($id),
                'quantity'=>$quantite
            ];

        endforeach;
        return $panierDetail;


    }

    public function getTotal()
    {
        $panier = $this->getFullCart();
        $total = 0;
        foreach ($panier as $item => $value):
            //dd($item, $value);

            // dd($value['product']);

            $total += $value['vol']->getPrix()*$value['quantity'];
            
        endforeach;

        // dd($total);
        return $total;

    }


}
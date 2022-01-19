<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BankAccountController extends AbstractController
{
    #[Route('/move', name: 'bank_account')]
    public function transfer(Request $request): Response
    {
        $from = $request->query->get('from');
        $to = $request->query->get('to');
        $amount = $request->query->get('amount');

        return new Response(sprintf('from %s to %s amount %s', $from, $to, $amount));
    }
}

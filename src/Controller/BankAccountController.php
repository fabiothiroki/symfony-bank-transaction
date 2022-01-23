<?php

namespace App\Controller;

use App\Repository\BankAccountRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BankAccountController extends AbstractController
{
    #[Route('/move', name: 'bank_account')]
    public function transfer(Request $request, BankAccountRepository $repository): Response
    {
        $from = $request->query->get('from');
        $to = $request->query->get('to');
        $amount = $request->query->get('amount');

        $repository->transferAmount($from, $to, $amount);

        return new Response(sprintf('from %s to %s amount %s', $from, $to, $amount));
    }

    #[Route('/move-concurrently', name: 'bank_account_concurrent')]
    public function transferConcurrently(Request $request, BankAccountRepository $repository): Response
    {
        $from = $request->query->get('from');
        $to = $request->query->get('to');
        $amount = $request->query->get('amount');

        $repository->transferAmountConcurrently($from, $to, $amount);

        return new Response(sprintf('from %s to %s amount %s', $from, $to, $amount));
    }
}

<?php

namespace App\Repository;

use App\Entity\BankAccount;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\LockMode;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BankAccount|null find($id, $lockMode = null, $lockVersion = null)
 * @method BankAccount|null findOneBy(array $criteria, array $orderBy = null)
 * @method BankAccount[]    findAll()
 * @method BankAccount[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BankAccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BankAccount::class);
    }

    public function transferAmount($from, $to, $amount): void
    {
        $fromAccount = $this->find($from);
        $toAccount = $this->find($to);

        $fromAccount->setAmount($fromAccount->getAmount() - $amount);
        $toAccount->setAmount($toAccount->getAmount() + $amount);

        $this->getEntityManager()->persist($fromAccount);
        $this->getEntityManager()->persist($toAccount);
        $this->getEntityManager()->flush();
    }

    public function transferAmountConcurrently($from, $to, $amount): void
    {
        $this->getEntityManager()->beginTransaction();
        $fromAccount = $this->find($from, LockMode::PESSIMISTIC_WRITE);
        $toAccount = $this->find($to, LockMode::PESSIMISTIC_WRITE);

        $fromAccount->setAmount($fromAccount->getAmount() - $amount);
        $toAccount->setAmount($toAccount->getAmount() + $amount);

        $this->getEntityManager()->persist($fromAccount);
        $this->getEntityManager()->persist($toAccount);
        $this->getEntityManager()->flush();
        $this->getEntityManager()->commit();
    }
}

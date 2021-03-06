<?php

declare(strict_types=1);

namespace App\Repository\User;

use App\Entity\User;
use App\Exceptions\User\UnableToDeleteUserException;
use App\Exceptions\User\UnableToSaveUserException;
use App\ValueObject\Username;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\ORMInvalidArgumentException;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function find($id, $lockMode = null, $lockVersion = null): ?User
    {
        return parent::find($id, $lockMode, $lockVersion);
    }

    public function findOneBy(array $criteria, array $orderBy = null): ?User
    {
        return parent::findOneBy($criteria, $orderBy);
    }

    public function save(User $user): void
    {
        try {
            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush();
        } catch (ORMInvalidArgumentException | ORMException $exception) {
            throw new UnableToSaveUserException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    public function remove(User $user): void
    {
        try {
            $this->getEntityManager()->remove($user);
            $this->getEntityManager()->flush();
        } catch (ORMInvalidArgumentException | ORMException $exception) {
            throw new UnableToDeleteUserException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    public function createWith(string $email, string $username): User
    {
        return UserRepositoryFactory::create($email, $username);
    }

    public function updateUserInformation(User $user, string $emailAddress = null, Username $username = null): void
    {
        if (null === $emailAddress && null === $username) {
            return;
        }

        if (null !== $emailAddress) {
            $user->updateEmailAddress($emailAddress);
        }

        if (null !== $username) {
            $user->updateUsername($username);
        }

        $this->save($user);
    }

    /** @return User[] */
    public function findAll(): array
    {
        return parent::findAll();
    }
}

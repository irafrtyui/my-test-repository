<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private ?int $login_cnt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $login_at = null;

    #[ORM\Column]
    private ?int $non_login_cnt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $non_login_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): array
    {
        return ['ROLE_ADMIN'];
    }

    public function eraseCredentials()
    {

    }

    public function getUserIdentifier(): string
    {
        return $this->login;
    }

    public function getLoginCnt(): ?int
    {
        return $this->login_cnt;
    }

    public function setLoginCnt(int $login_cnt): static
    {
        $this->login_cnt = $login_cnt;

        return $this;
    }

    public function getLoginAt(): ?\DateTimeInterface
    {
        return $this->login_at;
    }

    public function setLoginAt(\DateTimeInterface $login_at): static
    {
        $this->login_at = $login_at;

        return $this;
    }

    public function getNonLoginCnt(): ?int
    {
        return $this->non_login_cnt;
    }

    public function setNonLoginCnt(int $non_login_cnt): static
    {
        $this->non_login_cnt = $non_login_cnt;

        return $this;
    }

    public function getNonLoginAt(): ?\DateTimeInterface
    {
        return $this->non_login_at;
    }

    public function setNonLoginAt(\DateTimeInterface $non_login_at): static
    {
        $this->non_login_at = $non_login_at;

        return $this;
    }
}

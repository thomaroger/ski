<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Date $date = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Monitor $monitor = null;

    #[ORM\ManyToOne(inversedBy: 'sessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Group $Groupname = null;

    #[ORM\Column]
    private ?bool $test = null;

    #[ORM\Column]
    private ?bool $race = null;

    #[ORM\Column]
    private ?bool $additional = null;

    #[ORM\Column]
    private ?bool $cancel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDate(): ?Date
    {
        return $this->date;
    }

    public function setDate(?Date $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getMonitor(): ?Monitor
    {
        return $this->monitor;
    }

    public function setMonitor(?Monitor $monitor): static
    {
        $this->monitor = $monitor;

        return $this;
    }

    public function getGroupname(): ?Group
    {
        return $this->Groupname;
    }

    public function setGroupname(?Group $Groupname): static
    {
        $this->Groupname = $Groupname;

        return $this;
    }

    public function isTest(): ?bool
    {
        return $this->test;
    }

    public function setTest(bool $test): static
    {
        $this->test = $test;

        return $this;
    }

    public function isRace(): ?bool
    {
        return $this->race;
    }

    public function setRace(bool $race): static
    {
        $this->race = $race;

        return $this;
    }

    public function isAdditional(): ?bool
    {
        return $this->additional;
    }

    public function setAdditional(bool $additional): static
    {
        $this->additional = $additional;

        return $this;
    }

    public function isCancel(): ?bool
    {
        return $this->cancel;
    }

    public function setCancel(bool $cancel): static
    {
        $this->cancel = $cancel;

        return $this;
    }
}

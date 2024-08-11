<?php

namespace Mr\SimpleBehaviorsBundle\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

trait TimestampableEntity {

    #[ORM\Column]
    #[Groups(['mr_simple_behaviors:timestamp:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column( nullable: true)]
    #[Groups(['mr_simple_behaviors:timestamp:read'])]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}

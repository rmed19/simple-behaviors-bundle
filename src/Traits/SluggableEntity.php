<?php

namespace Mr\SimpleBehaviorsBundle\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait SluggableEntity
{
    #[ORM\Column(length: 255)]
    #[Groups(["mr_simple_behaviors:slug:read"])]
    protected ?string $slug = null;

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}

<?php

namespace Mr\SimpleBehaviorsBundle\Model;

interface SluggableInterface extends \Stringable
{
    public function getSlug(): ?string;

    public function setSlug(string $slug): self;
}

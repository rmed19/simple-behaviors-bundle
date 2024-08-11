<?php

namespace Mr\SimpleBehaviorsBundle;

use Mr\SimpleBehaviorsBundle\DependencyInjection\MrSimpleBehaviorsExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MrSimpleBehaviorsBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new MrSimpleBehaviorsExtension();
        }
        return $this->extension;
    }
}

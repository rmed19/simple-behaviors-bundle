<?php

namespace Mr\SimpleBehaviorsBundle\Tests\DependencyInjection;

use Mr\SimpleBehaviorsBundle\DependencyInjection\MrSimpleBehaviorsExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use PHPUnit\Framework\TestCase;

class MrSimpleBehaviorsExtensionTest extends TestCase
{
    public function testLoad()
    {
        $container = new ContainerBuilder();
        $extension = new MrSimpleBehaviorsExtension();
        $extension->load([], $container);

        $this->assertTrue($container->hasDefinition('mr.simple_behaviors.listener.sluggable'));
        $this->assertTrue($container->hasDefinition('mr.simple_behaviors.listener.timestampable'));
    }
}

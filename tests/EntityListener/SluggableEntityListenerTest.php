<?php

namespace Mr\SimpleBehaviorsBundle\Tests\EntityListener;

use Doctrine\ORM\EntityManagerInterface;
use Mr\SimpleBehaviorsBundle\EntityListener\SluggableEntityListener;
use Mr\SimpleBehaviorsBundle\Model\SluggableInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use PHPUnit\Framework\TestCase;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\String\UnicodeString;

class SluggableEntityListenerTest extends TestCase
{
    public function testPrePersistGeneratesSlug()
    {
        $slugger = $this->createMock(SluggerInterface::class);
        $slugger->method('slug')
            ->willReturn(new UnicodeString('test-slug'));

        $listener = new SluggableEntityListener($slugger);

        $entity = $this->createMock(SluggableInterface::class);
        $entity->method('getSlug')->willReturn(null);
        $entity->expects($this->once())->method('setSlug')->with('test-slug');

        $event = new LifecycleEventArgs($entity, $this->createMock(EntityManagerInterface::class));

        $listener->prePersist($event);
    }

    public function testPreUpdateGeneratesSlug()
    {
        $slugger = $this->createMock(SluggerInterface::class);
        $slugger->method('slug')
            ->willReturn(new UnicodeString('test-slug'));

        $listener = new SluggableEntityListener($slugger);

        $entity = $this->createMock(SluggableInterface::class);
        $entity->method('getSlug')->willReturn(null);
        $entity->expects($this->once())->method('setSlug')->with('test-slug');

        $event = new LifecycleEventArgs($entity, $this->createMock(EntityManagerInterface::class));

        $listener->preUpdate($event);
    }
}

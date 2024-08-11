<?php

namespace Mr\SimpleBehaviorsBundle\Tests\EntityListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use Mr\SimpleBehaviorsBundle\EntityListener\TimestampableEntityListener;
use Mr\SimpleBehaviorsBundle\Model\TimestampableInterface;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class TimestampableEntityListenerTest extends TestCase
{
    public function testPrePersistSetsCreatedAt()
    {
        $listener = new TimestampableEntityListener();

        $entity = $this->createMock(TimestampableInterface::class);
        $entity->expects($this->once())
            ->method('setCreatedAt')
            ->with($this->isInstanceOf(\DateTimeImmutable::class));

        $event = new LifecycleEventArgs($entity, $this->createMock(EntityManagerInterface::class));

        $listener->prePersist($event);
    }

    public function testPreUpdateSetsUpdatedAt()
    {
        $listener = new TimestampableEntityListener();

        $entity = $this->createMock(TimestampableInterface::class);
        $entity->expects($this->once())
            ->method('setUpdatedAt')
            ->with($this->isInstanceOf(\DateTimeImmutable::class));

        $event = new LifecycleEventArgs($entity, $this->createMock(EntityManagerInterface::class));

        $listener->preUpdate($event);
    }
}

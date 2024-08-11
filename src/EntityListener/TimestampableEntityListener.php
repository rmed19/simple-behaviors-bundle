<?php

namespace Mr\SimpleBehaviorsBundle\EntityListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use Mr\SimpleBehaviorsBundle\Model\TimestampableInterface;

final class TimestampableEntityListener
{
    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if ($entity instanceof TimestampableInterface) {
            $entity->setCreatedAt(new \DateTimeImmutable());
        }
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        if ($entity instanceof TimestampableInterface) {
            $entity->setUpdatedAt(new \DateTimeImmutable());
        }
    }
}

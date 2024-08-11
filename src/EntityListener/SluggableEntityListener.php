<?php

namespace Mr\SimpleBehaviorsBundle\EntityListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use Mr\SimpleBehaviorsBundle\Model\SluggableInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

final class SluggableEntityListener
{
    public function __construct(private SluggerInterface $slugger)
    {
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $object = $args->getObject();
        if ($object instanceof SluggableInterface) {
            $this->computeSlug($object);
        }
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $object = $args->getObject();
        if ($object instanceof SluggableInterface) {
            $this->computeSlug($object);
        }
    }

    private function computeSlug(object $object): void
    {
        if (!$object->getSlug() || '-' === $object->getSlug()) {
            $object->setSlug((string)  $this->slugger->slug((string) $object)->lower());
        }
    }
}

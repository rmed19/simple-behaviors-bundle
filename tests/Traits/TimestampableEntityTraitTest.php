<?php

namespace Mr\SimpleBehaviorsBundle\Tests\Traits;

use Mr\SimpleBehaviorsBundle\Traits\TimestampableEntity;
use PHPUnit\Framework\TestCase;

class TimestampableEntityTraitTest extends TestCase
{
    public function testGetSetCreatedAt()
    {
        $entity = new class {
            use TimestampableEntity;
        };

        $createdAt = new \DateTimeImmutable();

        $this->assertNull($entity->getCreatedAt());

        $entity->setCreatedAt($createdAt);
        $this->assertEquals($createdAt, $entity->getCreatedAt());
    }

    public function testGetSetUpdateAt()
    {
        $entity = new class {
            use TimestampableEntity;
        };

        $updateAt = new \DateTimeImmutable();

        $this->assertNull($entity->getUpdatedAt());

        $entity->setUpdatedAt($updateAt);
        $this->assertEquals($updateAt, $entity->getUpdatedAt());

        $entity->setUpdatedAt(null);
        $this->assertNull($entity->getUpdatedAt());
    }
}

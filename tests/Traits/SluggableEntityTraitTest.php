<?php

namespace Mr\SimpleBehaviorsBundle\Tests\Traits;

use Mr\SimpleBehaviorsBundle\Traits\SluggableEntity;
use PHPUnit\Framework\TestCase;

class SluggableEntityTraitTest extends TestCase
{
    public function testGetSetSlug()
    {
        $entity = new class {
            use SluggableEntity;
        };

        $slug = 'example-slug';

        $this->assertNull($entity->getSlug());

        $entity->setSlug($slug);
        $this->assertEquals($slug, $entity->getSlug());
    }
}

# MrSimpleBehaviorsBundle

MrSimpleBehaviorsBundle is a Symfony bundle that provides simple, reusable behaviors for Doctrine entities, such as Sluggable and Timestampable functionalities.

## Features

- **Sluggable**: Automatically generates a URL-friendly slug for your entities based on a specified field.
- **Timestampable**: Automatically manages `createdAt` and `updatedAt` fields for your entities.

## Requirements

- PHP 8.0 or higher
- Symfony 6.0 or higher
- Doctrine ORM
- Symfony String Component
- Symfony Serializer Component

## Installation

Install the bundle via Composer:

```bash
composer require rmed19/simple-behaviors-bundle
```

If you're not using Symfony Flex, you'll need to manually enable the bundle in your `config/bundles.php`:

```php
return [
    // Other bundles...
    Mr\SimpleBehaviorsBundle\MrSimpleBehaviorsBundle::class => ['all' => true],
];
```

## Usage

### Sluggable Entity

To use the Sluggable functionality in your entity, simply include the `SluggableEntity` trait and implement the `SluggableInterface`:

```php
use Doctrine\ORM\Mapping as ORM;
use Mr\SimpleBehaviorsBundle\Model\SluggableInterface;
use Mr\SimpleBehaviorsBundle\Traits\SluggableEntity;

#[ORM\Entity]
class Article implements SluggableInterface
{
    use SluggableEntity;

    #[ORM\Column(type: 'string', length: 255)]
    private string $title;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function __toString(): string
    {
        return $this->title;
    }
}
```

### Timestampable Entity

To use the Timestampable functionality in your entity, include the `TimestampableEntity` trait and implement the `TimestampableInterface`:

```php
use Doctrine\ORM\Mapping as ORM;
use Mr\SimpleBehaviorsBundle\Model\TimestampableInterface;
use Mr\SimpleBehaviorsBundle\Traits\TimestampableEntity;

#[ORM\Entity]
class Post implements TimestampableInterface
{
    use TimestampableEntity;

    #[ORM\Column(type: 'string', length: 255)]
    private string $content;

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
```

### Serialization Groups

The `MrSimpleBehaviorsBundle` provides serialization groups directly within the traits for controlling how slugs and timestamps are serialized.

- **For Slugs**: The `SluggableEntity` trait includes the group `mr_simple_behaviors:slug:read`.
- **For Timestamps**: The `TimestampableEntity` trait includes the group `mr_simple_behaviors:timestamp:read`.

These groups allow you to manage the serialization of these fields effectively in different contexts.

#### Example:

In your entity, the `SluggableEntity` trait automatically applies the `mr_simple_behaviors:slug:read` group to the `slug` field, and the `TimestampableEntity` trait applies the `mr_simple_behaviors:timestamp:read` group to the `createdAt` and `updateAt` fields.

Example usage with Symfony's Serializer component:

```php
use Symfony\Component\Serializer\SerializerInterface;

$serializedData = $serializer->serialize($article, 'json', ['groups' => ['mr_simple_behaviors:slug:read']]);
```

In the example above, only the fields associated with the `mr_simple_behaviors:slug:read` group, including the slug, will be serialized.

### Configuration

The bundle uses Doctrine event listeners to automatically handle Sluggable and Timestampable behaviors. No additional configuration is required out of the box.

However, if you need to customize the behavior, you can override the default services by modifying the `services.xml` file located in your project:

```xml
<services>
    <service id="mr.simple_behaviors.listener.sluggable" class="Mr\SimpleBehaviorsBundle\EntityListener\SluggableEntityListener">
        <argument type="service" id="slugger"/>
        <tag name="doctrine.event_listener" event="prePersist"/>
        <tag name="doctrine.event_listener" event="preUpdate"/>
    </service>

    <service id="mr.simple_behaviors.listener.timestampable" class="Mr\SimpleBehaviorsBundle\EntityListener\TimestampableEntityListener">
        <tag name="doctrine.event_listener" event="prePersist"/>
        <tag name="doctrine.event_listener" event="preUpdate"/>
    </service>
</services>
```

### Testing

To run the test suite, use PHPUnit:

```bash
vendor/bin/phpunit
```

Make sure you have PHPUnit installed and configured.

### Contributing

Contributions are welcome! Please submit a pull request or open an issue to discuss your ideas.

### License

This bundle is licensed under the MIT license. See the [LICENSE](LICENSE) file for more details.

### Credits

MrSimpleBehaviorsBundle is developed and maintained by Mohamed RHAMNIA. Special thanks to the Symfony and Doctrine communities for their amazing tools and documentation.


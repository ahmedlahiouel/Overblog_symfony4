<?php


namespace App\GraphQL\Query\Post;

use App\GraphQL\Type\PostType;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\AbstractType;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;
use App\Entity\Post;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Config\Field\FieldConfig;

class PostsField extends AbstractContainerAwareField
{
    function __construct(array $config = [])
    {
        parent::__construct($config);
    }

    public function build(FieldConfig $config)
    {
        $config->addArguments(
            [
               'title'  => new StringType(),
               'description'  => new StringType(),
               'author'  => new StringType(),
            ]
        );
    }

    public function resolve($value, array $args, ResolveInfo $info)
    {
            return $this->container
                ->get('doctrine.orm.entity_manager')
                ->getRepository(Post::class)
                ->findBy($args);
    }

    /**
     * @return AbstractObjectType|AbstractType
     */
    public function getType()
    {
        return new ListType(new PostType());
    }
}

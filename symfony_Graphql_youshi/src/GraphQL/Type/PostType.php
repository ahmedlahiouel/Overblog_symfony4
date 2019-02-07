<?php

namespace App\GraphQL\Type;

use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\FloatType;

/**
 * Class PostType
 *
 * @package App\GraphQL\Type
 */
class PostType extends AbstractObjectType
{

    /**
     * @param ObjectTypeConfig $config
     *
     * @return mixed
     */
    public function build($config)
    {
        $config->addFields(
            [
            'id'        => new NonNullType(new IdType()),
            'title'     => new StringType(),
            'description'     => new StringType(),
            'author'     => new StringType(),
            //'year'     => new StringType(),
            //'price'     => new FloatType(),
            //'is_published' => new BooleanType()
            ]
        );
    }
}

<?php

namespace App\GraphQL\Query;

use App\GraphQL\Query\Config\Config;
use App\GraphQL\Query\Home\Home;
use App\GraphQL\Query\Home\RefreshContent;
use App\GraphQL\Query\Post\PostsField;
use App\GraphQL\Query\User\CheckUser;
use App\GraphQL\Query\User\User;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\Object\AbstractObjectType;

class QueryType extends AbstractObjectType
{

    /**
     * @param ObjectTypeConfig $config
     *
     *
     */
    public function build($config)
    {
        $config->addFields([

            new PostsField()
        ]);
    }
}

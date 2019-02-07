<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 06/02/19
 * Time: 02:41 م
 */

namespace AppBundle\GraphQL\Types\Country\Fields;
use AppBundle\Entity\Country;
use AppBundle\GraphQL\Types\AbstractField;
use AppBundle\GraphQL\Types\Country\CountryType;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\StringType;


class CountryAddField extends AbstractField {
    public function __construct( array $config = [] ) {
        $config["args"]= [
            'code' => new StringType(),
            'name' => new StringType(),
            'isActive' => new BooleanType(),
                ];

        parent::__construct( $config );
    }

    public function getType() {
        return  new CountryType();
    }

    public function resolve($value, array $args, ResolveInfo $info ) {
        $c=new Country();
        $c->setCode($args['code']);
        $c->setIsActive($args['isActive']);
        $c->setName($args['name']);

        $this->getEntityManager()->persist($c);
        $this->getEntityManager()->flush();
        $this->getEntityManager()->refresh($c);


        return $c;
    }
}
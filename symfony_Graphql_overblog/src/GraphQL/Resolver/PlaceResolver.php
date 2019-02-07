<?php
namespace App\GraphQL\Resolver;

use Doctrine\ORM\EntityManager;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

/**
 * Created by PhpStorm.
 * User: support
 * Date: 05/02/19
 * Time: 08:50 م
 */

class PlaceResolver implements ResolverInterface,AliasedInterface

{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function resolve($id){
$place=$this->em->getRepository('App:Place')->find($id);
return $place;

}
    /**
     * Returns methods aliases.
     *
     * For instance:
     * array('myMethod' => 'myAlias')
     *
     * @return array
     */
    public static function getAliases()
    {
return ['resolve'=>'Place'];
    }
}
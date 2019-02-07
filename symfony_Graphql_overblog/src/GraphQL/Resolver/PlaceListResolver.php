<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 05/02/19
 * Time: 10:10 م
 */

namespace App\GraphQL\Resolver;
use Doctrine\ORM\EntityManager;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class PlaceListResolver implements ResolverInterface,AliasedInterface

{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
{
    $this->em = $em;
}


    /**
     * @param $themes_id
     * @return array
     */
    public function resolve(){
    $places=$this->em->getRepository('App:Place')->findAll();





            return ["places"=>$places];

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
    return ['resolve'=>'PlaceList'];
}
}
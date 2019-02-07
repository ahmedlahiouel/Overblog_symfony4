<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 05/02/19
 * Time: 09:34 م
 */

namespace App\GraphQL\Resolver;


use Doctrine\ORM\EntityManager;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class ThemeResolver implements ResolverInterface,AliasedInterface

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
    $theme=$this->em->getRepository('App:Theme')->find($id);
    return $theme;

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
    return ['resolve'=>'Theme'];
}
}
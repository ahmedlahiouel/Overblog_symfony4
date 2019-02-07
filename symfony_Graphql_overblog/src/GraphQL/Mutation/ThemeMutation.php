<?php

namespace App\GraphQL\Mutation;

use App\Entity\Place;
use App\Entity\Theme;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class ThemeMutation implements MutationInterface , AliasedInterface
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
     * {@inheritdoc}
     */public static function getAliases(): array{
    return [
        'placeTheme' => 'theme_create' ,
    ];
}

    /**
     * @param array $input
     * @return Theme
     */public function placeTheme(array $input){
    $theme = new Theme();

    $theme->setName($input['name']);


    $this->em->persist($theme);
    $this->em->flush();

    return $theme;
}

}
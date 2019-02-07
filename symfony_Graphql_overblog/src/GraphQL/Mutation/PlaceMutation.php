<?php

namespace App\GraphQL\Mutation;

use App\Entity\Place;
use App\Entity\Theme;
use Doctrine\ORM\EntityManager;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class PlaceMutation implements MutationInterface , AliasedInterface
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
        'new' => 'placeNew' ,
        'placeLinkTheme' => 'placeLinkTheme' ,
    ];
}

    public function new(array $input){
        $place = new Place();
        $place->setName($input['name']);

        $this->em->persist($place);
        $this->em->flush();

        return $place;
    } /**
 * @param string $placeId
 * @param string $themeId
 * @return null|object
 */public function placeLinkTheme( $placeId ,  $themeId){
    $place=$this->em->getRepository(Place::class)->find($placeId);

    $theme = $this->em->getRepository(Theme::class)->find($themeId);

    $theme->addPlace($place);
    $place->setThemes($theme);


    $this->em->persist($place);
    $this->em->flush();

    $this->em->refresh($place);

    return $place;
}


}
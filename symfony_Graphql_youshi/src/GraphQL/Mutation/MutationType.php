<?php
namespace App\GraphQL\Mutation;

use App\GraphQL\Mutation\Content\Contents;
use App\GraphQL\Mutation\onBoarding\EditMail;
use App\GraphQL\Mutation\onBoarding\OnBoarding;
use App\GraphQL\Mutation\Profile\Cgu;
use App\GraphQL\Mutation\Quiz\PostQuiz;
use App\GraphQL\Mutation\Survey\SatisfactionQuestion;
use App\GraphQL\Mutation\Survey\WelcomeSurvey;
use App\GraphQL\Mutation\Token\ForgotPassword;
use App\GraphQL\Mutation\Token\PostDevice;
use App\GraphQL\Mutation\Token\ResetPassword;
use App\GraphQL\Mutation\User\SaveUser;
use App\GraphQL\Mutation\Token\PostToken;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\Object\AbstractObjectType;

class MutationType extends AbstractObjectType
{

    /**
     * @param ObjectTypeConfig $config
     *
     *
     */
    public function build($config)
    {
        $config->addFields(
            [

            ]
        );
    }
}

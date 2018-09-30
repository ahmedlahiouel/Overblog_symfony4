<?php
/**
 * Created by PhpStorm.
 * User: support
 * Date: 24/07/18
 * Time: 10:08 ص
 */
namespace App\Redirection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{
    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        // Get list of roles for current user
        $roles = $token->getRoles();
        // Tranform this list in array
        $rolesTab = array_map(function($role){
            return $role->getRole();
        }, $roles);
        // If is a admin or super admin we redirect to the backoffice area
        if (in_array('ROLE_RH', $rolesTab, true) || in_array('ROLE_SUPER_ADMIN', $rolesTab, true))
        {$redirection = new RedirectResponse($this->router->generate('gestionuser'));

return $redirection;}

        else{
            $user = $token->getUser();
        $etape=$user->getEtape();
if($etape == '0'){
        $redirection = new RedirectResponse($this->router->generate('etape1'));
        return $redirection;}
        elseif($etape == '1'){  $redirection = new RedirectResponse($this->router->generate('etape2'));
            return $redirection;
} elseif ($etape=='2'){  $redirection = new RedirectResponse($this->router->generate('etape3'));
    return $redirection;

} elseif ($etape=='2'){  $redirection = new RedirectResponse($this->router->generate('etape3'));
    return $redirection;

} elseif ($etape=='3'){  $redirection = new RedirectResponse($this->router->generate('etape4'));
    return $redirection;

} elseif ($etape=='4'){  $redirection = new RedirectResponse($this->router->generate('etape5'));
    return $redirection;

} elseif ($etape=='5'){  $redirection = new RedirectResponse($this->router->generate('etape6'));
    return $redirection;

} elseif ($etape=='6'){  $redirection = new RedirectResponse($this->router->generate('etape7'));
    return $redirection;

} elseif ($etape=='7'){  $redirection = new RedirectResponse($this->router->generate('showinformation'));
    return $redirection;

}
    }}

}
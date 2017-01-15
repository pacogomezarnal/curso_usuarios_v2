<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BlogBundle:Default:index.html.twig');
    }
    public function adminAction()
    {
            return $this->render('BlogBundle:Default:index.html.twig');
    }
    /**
    * @Security("has_role('ROLE_SUPER_ADMIN')")
    */
    public function confAction()
    {
            return $this->render('BlogBundle:Default:index.html.twig');
    }
    public function userAction()
    {
      // whatever *your* User object is
      $user = new Usuario();
      $plainPassword = '1234';
      $encoder = $this->container->get('security.password_encoder');
      $encoded = $encoder->encodePassword($user, $plainPassword);

      $user->setPassword($encoded);
      $user->setUserName("admin");
      $roles = '{"ROLE_ADMIN","ROLE_SUPER_ADMIN"}';

      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();
      return $this->render('BlogBundle:Default:usuario.html.twig');
    }
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('BlogBundle:Default:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
}

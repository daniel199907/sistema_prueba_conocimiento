<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\Visita;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        if ($session->get('perfil')) {
            switch ((int)$session->get('perfil')) {
                case 1:
                    return $this->redirect($this->generateUrl('dashboard_capturista'));
                case 2:
                    return $this->redirect($this->generateUrl('bandeja'));
                case 3:
                    return $this->redirect($this->generateUrl('dashboard_admin'));
            }
        }
        return $this->render('security/index.html.twig', [
            'controller_name' => 'Login',
        ]);

    }

    #[Route('/access', name: 'access')]
    public function login(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository(Usuario::class)->findOneBy(
            ['usuario' => $request->get('_username'), 'contrasenia' => $request->get('_password')]
        );
        if ($usuario) {
            $em = $this->getDoctrine()->getManager();
            $session = new Session();
            $session->start();
            $session->set('nombre', $usuario->getNombre() . ' ' . $usuario->getApellidoPaterno());
            $session->set('id', $usuario->getIdusuario());
            $session->set('perfil', $usuario->getPerfil()->getIdperfil());

            $visita = new Visita();
            $visita->setUsuarioIdusuario($usuario);
            $visita->setInicioSesionFecha(new \DateTime());
            $em->persist($visita);
            $em->flush();

            switch ($usuario->getPerfil()->getIdperfil()) {
                case 1:
                    return $this->redirect($this->generateUrl('dashboard_capturista'));
                case 2:
                    return $this->redirect($this->generateUrl('bandeja'));
                case 3:
                    return $this->redirect($this->generateUrl('dashboard_admin'));
            }
        } else {
            $this->addFlash('error', 'No existe el usuario y contraseña en la base de datos.');
        }
        return $this->redirect($this->generateUrl('login'));
    }

    #[Route('/logout', name: 'logout')]
    public function logout(Request $request)
    {
        $session = $request->getSession();
        $session->clear();
        return $this->redirect($this->generateUrl('login'));
    }
}

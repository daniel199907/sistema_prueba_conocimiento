<?php

namespace App\Controller;

use App\Entity\Estado;
use App\Entity\Producto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardGestorController extends AbstractController
{
    #[Route('/dashboard/bandeja', name: 'bandeja')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        if ($session->get('nombre')) {
            if ((int)$session->get('perfil') === 2) {
                $em = $this->getDoctrine()->getManager();
                $productos = $em->getRepository(Producto::class)->findAll();
                return $this->render('dashboard_gestor/index.html.twig', [
                    'controller_name' => 'Dashboard Gestor',
                    'productos' => $productos
                ]);
            } else {
                $this->addFlash('error', 'No tienes permitido esa acción.');
                return $this->redirect($this->generateUrl('login'));
            }
        } else {
            return $this->redirect($this->generateUrl('login'));
        }
    }

    #[Route('/dashboard/editproduct', name: 'edit_product')]
    public function editProduct(Request $request): Response
    {
        $session = $request->getSession();
        if ($session->get('nombre')) {
            if ((int)$session->get('perfil') === 2) {
                $em = $this->getDoctrine()->getManager();
                try {
                    $producto = $em->getRepository(Producto::class)->find($request->get('id'));
                    $estado = $em->getRepository(Estado::class)->find($request->get('idestado'));
                    $producto->setEstadoIdestados($estado);
                    $producto->setUltimaModificacion(new \DateTime());
                    $producto->setComentario($request->get('comentario'));
                    $em->persist($producto);
                    $em->flush();
                    $this->addFlash('success', '¡Producto editado exitosamente!');
                } catch (\Throwable $e) {
                    $this->addFlash('error', 'No se pudo guardar la iformación en el producto.');
                }
                return $this->redirect($this->generateUrl('bandeja'));
            } else {
                $this->addFlash('error', 'No tienes permitido esa acción.');
                return $this->redirect($this->generateUrl('login'));
            }
        } else {
            return $this->redirect($this->generateUrl('login'));
        }
    }

    #[Route('/dashboard/getproductinformation', name: 'product_information')]
    public function getProductInformation(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('nombre')) {
            if ((int)$session->get('perfil') === 2) {
                $em = $this->getDoctrine()->getManager();
                $producto = $em->getRepository(Producto::class)->find($request->get('id'));
                $estados = $em->getRepository(Estado::class)->findAll();
                return $this->render('dashboard_gestor/editproducto.html.twig', [
                    'producto' => $producto,
                    'estados' => $estados
                ]);
            } else {
                $this->addFlash('error', 'No tienes permitido esa acción.');
                return $this->redirect($this->generateUrl('login'));
            }
        } else {
            return $this->redirect($this->generateUrl('login'));
        }
    }

    #[Route('/dashboard/eliminar_producto/{id}', name: 'eliminar_producto')]
    public function eliminar_producto(Request $request, $id): Response
    {
        $session = $request->getSession();
        if ($session->get('nombre')) {
            if ((int)$session->get('perfil') === 2) {
                $em = $this->getDoctrine()->getManager();
                $message = '';
                $status = false;
                try {
                    $producto = $em->getRepository(Producto::class)->find($id);
                    $em->remove($producto);
                    $em->flush();
                    $status = true;
                } catch (\Throwable $e) {
                    $message = $e->getMessage();
                }
                $productos = $em->getRepository(Producto::class)->findAll();
                return new JsonResponse(['status' => $status, 'message' => $message, 'productos' => $productos]);
            } else {
                $this->addFlash('error', 'No tienes permitido esa acción.');
                return $this->redirect($this->generateUrl('login'));
            }
        } else {
            return $this->redirect($this->generateUrl('login'));
        }
    }
}

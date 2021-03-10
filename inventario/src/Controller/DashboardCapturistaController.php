<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Estado;
use App\Entity\Producto;
use App\Entity\Sucursal;
use App\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class DashboardCapturistaController extends AbstractController
{

    #[Route('/dashboard/capturista', name: 'dashboard_capturista')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        if ($session->get('nombre')) {
            if ((int)$session->get('perfil') === 1) {
                $em = $this->getDoctrine()->getManager();
                $sucursales = $em->getRepository(Sucursal::class)->findAll();
                $categorias = $em->getRepository(Categoria::class)->findAll();
                return $this->render('dashboard_capturista/index.html.twig', [
                    'controller_name' => 'DashboardCapturistaController',
                    'sucursales' => $sucursales,
                    'categorias' => $categorias
                ]);
            } else {
                $this->addFlash('error', 'No tienes permitido esa acción.');
                return $this->redirect($this->generateUrl('login'));
            }
        } else {
            return $this->redirect($this->generateUrl('login'));
        }
    }

    #[Route('/dashboard/registrar_producto', name: 'registrar_producto')]
    public function registrarProducto(Request $request): Response
    {
        $session = $request->getSession();
        if ($session->get('nombre')) {
            if ((int)$session->get('perfil') === 1) {
                try {
                    $em = $this->getDoctrine()->getManager();
                    $usuario = $em->getRepository(Usuario::class)->find((int)$session->get('id'));
                    $producto = new Producto();
                    $sucursal = $em->getRepository(Sucursal::class)->find($request->get('sucursal'));
                    $estado = $em->getRepository(Estado::class)->find(1);
                    $categoria = $em->getRepository(Categoria::class)->find($request->get('category'));


                    $producto->setNombre($request->get('name'));
                    $producto->setDescripcion($request->get('description'));
                    $producto->setPrecio($request->get('price'));
                    $producto->setFecha(new \DateTime($request->get('date')));
                    $producto->setCategoriaIdcategoria($categoria);
                    $producto->setSucursalIdsucursal($sucursal);
                    $producto->setEstadoIdestados($estado);
                    $producto->setUsuarioIdusuario($usuario);
                    $em->persist($producto);
                    $em->flush();
                    $this->addFlash('success', '!Producto registrado exitosamente!');
                } catch (Throwable $e) {
                    $this->addFlash('error', 'No se pudo capturar la información del producto.');
                }
                return $this->redirect($this->generateUrl('dashboard_capturista'));
            } else {
                $this->addFlash('error', 'No tienes permitido esa acción.');
                return $this->redirect($this->generateUrl('login'));
            }
        } else {
            return $this->redirect($this->generateUrl('login'));
        }
    }

}

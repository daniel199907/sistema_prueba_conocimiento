<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Entity\Estado;
use App\Entity\Producto;
use App\Entity\Sucursal;
use App\Entity\Usuario;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class DashboardCapturistaController extends AbstractController
{

    #[Route('/dashboard/capturista', name: 'dashboard_capturista')]
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $sucursales = $em->getRepository(Sucursal::class)->findAll();
        $categorias = $em->getRepository(Categoria::class)->findAll();
        return $this->render('dashboard_capturista/index.html.twig', [
            'controller_name' => 'DashboardCapturistaController',
            'sucursales' => $sucursales,
            'categorias' => $categorias
        ]);
    }

    #[Route('/dashboard/registrar_producto', name: 'registrar_producto')]
    public function registrarProducto(Request $request): Response
    {
        $message = '';
        $status = false;
        try {
            $em = $this->getDoctrine()->getManager();
            $usuario = $em->getRepository(Usuario::class)->find(1);
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
            $status = true;
            $this->addFlash('success', '!Producto registrado exitosamente!');
        } catch (Throwable $e) {
            $message = $e->getMessage();
            $this->addFlash('error', 'No se pudo capturar la información del producto.');
        }
        $sucursales = $em->getRepository(Sucursal::class)->findAll();
        $categorias = $em->getRepository(Categoria::class)->findAll();
       return $this->redirect($this->generateUrl('dashboard_capturista'));
    }
}

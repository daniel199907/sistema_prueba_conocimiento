<?php

namespace App\Controller;

use App\Entity\Producto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CvsController extends AbstractController
{

    #[Route('/dashboard/reportes/cvs', name: 'cvs')]
    public function csvAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('nombre')) {
            $em = $this->getDoctrine()->getManager();
            $query = "SELECT idproducto, nombre, producto.descripcion,
                precio, producto.fecha, sucursal.descripcion as sucursal, categoria.descripcion as categoria, 
                estado.descripcion as estado, producto.ultima_modificacion, comentario FROM inventario.producto
                INNER JOIN sucursal on sucursal.idsucursal=producto.sucursal_idsucursal    
                INNER JOIN categoria on categoria_idcategoria=idcategoria
                INNER JOIN estado on producto.estado_idestados=idestados
                WHERE fecha GROUP BY idproducto";
            $statement = $em->getConnection()->prepare($query);
            $statement->execute();
            $productos = $statement->fetchAll();

            //return new JsonResponse(['prod'=>$productos]);
            $fp = fopen('php://output', 'w');
            fputcsv($fp, array('ID', 'Nombre', 'Descripcion', 'Precio', 'Fecha creacion', 'Sucursal', 'Categoria', 'Estados', 'Ultima modificacion', 'Comentario'));
            foreach ($productos as $product) {
                fputcsv($fp, array($product['idproducto'], $product['nombre'], $product['descripcion'], $product['precio'],
                    $product['fecha'], $product['sucursal'], $product['categoria'], $product['estado'],
                    $product['ultima_modificacion'], $product['comentario']));
            }

            $response = new Response();
            $response->headers->set('Content-Type', 'text/csv');
            //it's gonna output in a testing.csv file
            $response->headers->set('Content-Disposition', 'attachment; filename="products.csv"');

            return $response;
        } else {
            return $this->redirect($this->generateUrl('login'));
        }
    }

    #[Route('/dashboard/reportes/cvsdates', name: 'cvsdates')]
    public function csvActionDates(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('nombre')) {
            $em = $this->getDoctrine()->getManager();
            $query = "SELECT idproducto, nombre, producto.descripcion,
                precio, producto.fecha, sucursal.descripcion as sucursal, categoria.descripcion as categoria, 
                estado.descripcion as estado, producto.ultima_modificacion, comentario FROM inventario.producto
                INNER JOIN sucursal on sucursal.idsucursal=producto.sucursal_idsucursal   
                INNER JOIN categoria on categoria_idcategoria=idcategoria
                INNER JOIN estado on producto.estado_idestados=idestados
                WHERE fecha BETWEEN :fechaInicio AND :fechaFin GROUP BY idproducto";
            $statement = $em->getConnection()->prepare($query);
            $statement->bindValue('fechaInicio', $request->get('fechaInicio'));
            $statement->bindValue('fechaFin', $request->get('fechaFin'));
            $statement->execute();
            $productos = $statement->fetchAll();

            //return new JsonResponse(['prod'=>$productos]);
            $fp = fopen('php://output', 'w');
            fputcsv($fp, array('ID', 'Nombre', 'Descripcion', 'Precio', 'Fecha creacion', 'Sucursal', 'Categoria', 'Estados', 'Ultima modificacion', 'Comentario'));
            foreach ($productos as $product) {
                fputcsv($fp, array($product['idproducto'], $product['nombre'], $product['descripcion'], $product['precio'],
                    $product['fecha'], $product['sucursal'], $product['categoria'], $product['estado'],
                    $product['ultima_modificacion'], $product['comentario']));
            }

            $response = new Response();
            $response->headers->set('Content-Type', 'text/csv');
            //it's gonna output in a testing.csv file
            $response->headers->set('Content-Disposition', 'attachment; filename="products-range.csv"');

            return $response;
        } else {
            return $this->redirect($this->generateUrl('login'));
        }
    }
}

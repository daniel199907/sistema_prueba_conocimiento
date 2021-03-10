<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sucursal
 *
 * @ORM\Table(name="sucursal")
 * @ORM\Entity
 */
class Sucursal
{
    /**
     * @var int
     *
     * @ORM\Column(name="idsucursal", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsucursal;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=45, nullable=false)
     */
    private $descripcion;

    /**
     * @return int
     */
    public function getIdsucursal(): int
    {
        return $this->idsucursal;
    }

    /**
     * @param int $idsucursal
     */
    public function setIdsucursal(int $idsucursal): void
    {
        $this->idsucursal = $idsucursal;
    }

    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }


}

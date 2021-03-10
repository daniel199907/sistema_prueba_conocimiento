<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acceso
 *
 * @ORM\Table(name="acceso", uniqueConstraints={@ORM\UniqueConstraint(name="usuario", columns={"usuario"})})
 * @ORM\Entity
 */
class Acceso
{
    /**
     * @var int
     *
     * @ORM\Column(name="idacceso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idacceso;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=12, nullable=false)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="contrasenia", type="string", length=15, nullable=false)
     */
    private $contrasenia;

    public function getIdacceso(): ?int
    {
        return $this->idacceso;
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getContrasenia(): ?string
    {
        return $this->contrasenia;
    }

    public function setContrasenia(string $contrasenia): self
    {
        $this->contrasenia = $contrasenia;

        return $this;
    }


}

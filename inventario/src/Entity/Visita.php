<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visita
 *
 * @ORM\Table(name="visita", indexes={@ORM\Index(name="fk_visita_usuario1_idx", columns={"usuario_idusuario"})})
 * @ORM\Entity
 */
class Visita
{
    /**
     * @var int
     *
     * @ORM\Column(name="idvisitas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idvisitas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio_sesion_fecha", type="date", nullable=false)
     */
    private $inicioSesionFecha;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_idusuario", referencedColumnName="idusuario")
     * })
     */
    private $usuarioIdusuario;

    public function getIdvisitas(): ?int
    {
        return $this->idvisitas;
    }

    public function getInicioSesionFecha(): ?\DateTimeInterface
    {
        return $this->inicioSesionFecha;
    }

    public function setInicioSesionFecha(\DateTimeInterface $inicioSesionFecha): self
    {
        $this->inicioSesionFecha = $inicioSesionFecha;

        return $this;
    }

    public function getUsuarioIdusuario(): ?Usuario
    {
        return $this->usuarioIdusuario;
    }

    public function setUsuarioIdusuario(?Usuario $usuarioIdusuario): self
    {
        $this->usuarioIdusuario = $usuarioIdusuario;

        return $this;
    }


}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visita
 *
 * @ORM\Table(name="visita", indexes={@ORM\Index(name="fk_visita_acceso1_idx", columns={"acceso_idacceso"})})
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
     * @var \Acceso
     *
     * @ORM\ManyToOne(targetEntity="Acceso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="acceso_idacceso", referencedColumnName="idacceso")
     * })
     */
    private $accesoIdacceso;

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

    public function getAccesoIdacceso(): ?Acceso
    {
        return $this->accesoIdacceso;
    }

    public function setAccesoIdacceso(?Acceso $accesoIdacceso): self
    {
        $this->accesoIdacceso = $accesoIdacceso;

        return $this;
    }


}

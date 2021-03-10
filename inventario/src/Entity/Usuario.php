<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="fk_usuario_acceso1_idx", columns={"acceso_idacceso"}), @ORM\Index(name="idperfil_idx", columns={"perfil"})})
 * @ORM\Entity
 */
class Usuario
{
    /**
     * @var int
     *
     * @ORM\Column(name="idusuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idusuario;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_paterno", type="string", length=45, nullable=false)
     */
    private $apellidoPaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_materno", type="string", length=45, nullable=false)
     */
    private $apellidoMaterno;

    /**
     * @var int
     *
     * @ORM\Column(name="acceso", type="integer", nullable=false)
     */
    private $acceso;

    /**
     * @var \Acceso
     *
     * @ORM\ManyToOne(targetEntity="Acceso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="acceso_idacceso", referencedColumnName="idacceso")
     * })
     */
    private $accesoIdacceso;

    /**
     * @var \Perfil
     *
     * @ORM\ManyToOne(targetEntity="Perfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="perfil", referencedColumnName="idperfil")
     * })
     */
    private $perfil;

    public function getIdusuario(): ?int
    {
        return $this->idusuario;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidoPaterno(): ?string
    {
        return $this->apellidoPaterno;
    }

    public function setApellidoPaterno(string $apellidoPaterno): self
    {
        $this->apellidoPaterno = $apellidoPaterno;

        return $this;
    }

    public function getApellidoMaterno(): ?string
    {
        return $this->apellidoMaterno;
    }

    public function setApellidoMaterno(string $apellidoMaterno): self
    {
        $this->apellidoMaterno = $apellidoMaterno;

        return $this;
    }

    public function getAcceso(): ?int
    {
        return $this->acceso;
    }

    public function setAcceso(int $acceso): self
    {
        $this->acceso = $acceso;

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

    public function getPerfil(): ?Perfil
    {
        return $this->perfil;
    }

    public function setPerfil(?Perfil $perfil): self
    {
        $this->perfil = $perfil;

        return $this;
    }


}

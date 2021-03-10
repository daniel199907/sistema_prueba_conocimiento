<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", uniqueConstraints={@ORM\UniqueConstraint(name="usuario", columns={"usuario"})}, indexes={@ORM\Index(name="idperfil_idx", columns={"perfil"})})
 * @ORM\Entity
 */
class Usuario implements UserInterface, \Serializable
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

    public function getPerfil(): ?Perfil
    {
        return $this->perfil;
    }

    public function setPerfil(?Perfil $perfil): self
    {
        $this->perfil = $perfil;

        return $this;
    }


    public function getRoles()
    {
        return ([$this->getPerfil()->getDescripcion()]);
    }

    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function serialize()
    {
        return serialize([
            $this->idusuario,
            $this->usuario,
            $this->contrasenia
        ]);
    }

    public function unserialize($serialized)
    {
        list(
            $this->idusuario,
            $this->usuario,
            $this->contrasenia
            ) = unserialize($serialized, ['allowe_classes' => false]);
    }
}

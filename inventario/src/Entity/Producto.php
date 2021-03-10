<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producto
 *
 * @ORM\Table(name="producto", indexes={@ORM\Index(name="fk_producto_categoria1_idx", columns={"categoria_idcategoria"}), @ORM\Index(name="fk_producto_estado1_idx", columns={"estado_idestados"}), @ORM\Index(name="fk_producto_sucursal1_idx", columns={"sucursal_idsucursal"}), @ORM\Index(name="fk_producto_usuario1_idx", columns={"usuario_idusuario"})})
 * @ORM\Entity
 */
class Producto
{
    /**
     * @var int
     *
     * @ORM\Column(name="idproducto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproducto;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=30, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=100, nullable=false)
     */
    private $descripcion;

    /**
     * @var int
     *
     * @ORM\Column(name="precio", type="smallint", nullable=false)
     */
    private $precio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="ultima_modificacion", type="date", nullable=true)
     */
    private $ultimaModificacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comentario", type="string", length=100, nullable=true)
     */
    private $comentario;

    /**
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_idcategoria", referencedColumnName="idcategoria")
     * })
     */
    private $categoriaIdcategoria;

    /**
     * @var \Estado
     *
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_idestados", referencedColumnName="idestados")
     * })
     */
    private $estadoIdestados;

    /**
     * @var \Sucursal
     *
     * @ORM\ManyToOne(targetEntity="Sucursal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sucursal_idsucursal", referencedColumnName="idsucursal")
     * })
     */
    private $sucursalIdsucursal;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_idusuario", referencedColumnName="idusuario")
     * })
     */
    private $usuarioIdusuario;

    public function getIdproducto(): ?int
    {
        return $this->idproducto;
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getUltimaModificacion(): ?\DateTimeInterface
    {
        return $this->ultimaModificacion;
    }

    public function setUltimaModificacion(?\DateTimeInterface $ultimaModificacion): self
    {
        $this->ultimaModificacion = $ultimaModificacion;

        return $this;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(?string $comentario): self
    {
        $this->comentario = $comentario;

        return $this;
    }

    public function getCategoriaIdcategoria(): ?Categoria
    {
        return $this->categoriaIdcategoria;
    }

    public function setCategoriaIdcategoria(?Categoria $categoriaIdcategoria): self
    {
        $this->categoriaIdcategoria = $categoriaIdcategoria;

        return $this;
    }

    public function getEstadoIdestados(): ?Estado
    {
        return $this->estadoIdestados;
    }

    public function setEstadoIdestados(?Estado $estadoIdestados): self
    {
        $this->estadoIdestados = $estadoIdestados;

        return $this;
    }

    public function getSucursalIdsucursal(): ?Sucursal
    {
        return $this->sucursalIdsucursal;
    }

    public function setSucursalIdsucursal(?Sucursal $sucursalIdsucursal): self
    {
        $this->sucursalIdsucursal = $sucursalIdsucursal;

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

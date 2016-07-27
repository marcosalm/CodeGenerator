<?php
/**
 * Created by PhpStorm.
 * User: Dcide
 * Date: 26/07/2016
 * Time: 15:49
 */

namespace App\Entity;

use App\Interfaces\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * ProtoClass
 *
 * @ORM\Table(name="proto_methods")
 *
 */
class ProtoMethods implements EntityInterface{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100, nullable=true)
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=100, nullable=true)
     */
    protected $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="stmt", type="string", length=255, nullable=true)
     */
    protected $stmt;

    /**
     * @var ProtoClass
     *
     * @ORM\ManyToOne(targetEntity="ProtoClass")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="proto_class_id", referencedColumnName="ID")
     * })
     */
    protected $ProtoClass;

    /**
     * ProtoMethods constructor.
     * @param string $name
     * @param string $type
     * @param string $comment
     * @param string $stmt
     * @param ProtoClass $ProtoClass
     */
    public function __construct($name, $type, $comment, $stmt, ProtoClass $ProtoClass) {
        $this->name = $name;
        $this->type = $type;
        $this->comment = $comment;
        $this->stmt = $stmt;
        $this->ProtoClass = $ProtoClass;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Dcide
 * Date: 26/07/2016
 * Time: 16:01
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
/**
 * ProtoClass
 *
 * @ORM\Table(name="proto_property")
 *
 */
class ProtoProperty {

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
     * @var ProtoClass
     *
     * @ORM\ManyToOne(targetEntity="ProtoClass")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="proto_class_id", referencedColumnName="ID")
     * })
     */
    protected $ProtoClass;

    /**
     * ProtoProperty constructor.
     * @param string $name
     * @param string $type
     * @param string $comment
     * @param ProtoClass $ProtoClass
     */
    public function __construct($name, $type, $comment, ProtoClass $ProtoClass) {
        $this->name = $name;
        $this->type = $type;
        $this->comment = $comment;
        $this->ProtoClass = $ProtoClass;
    }


}
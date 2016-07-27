<?php
/**
 * Created by PhpStorm.
 * User: Dcide
 * Date: 26/07/2016
 * Time: 16:00
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * ProtoClass
 *
 * @ORM\Table(name="proto_implements")
 *
 */
class ProtoImplements {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     */
    protected $id;


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
     * @var ProtoClass
     *
     * @ORM\ManyToOne(targetEntity="ProtoClass")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="proto_class_implemented_id", referencedColumnName="ID")
     * })
     */
    protected $ProtoClassImplemented;

    /**
     * ProtoImplements constructor.
     * @param ProtoClass $ProtoClass
     * @param ProtoClass $ProtoClassImplemented
     */
    public function __construct(ProtoClass $ProtoClass, ProtoClass $ProtoClassImplemented) {
        $this->ProtoClass = $ProtoClass;
        $this->ProtoClassImplemented = $ProtoClassImplemented;
    }


}
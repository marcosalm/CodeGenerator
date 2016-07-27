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
 * @ORM\Table(name="proto_extends")
 *
 */
class ProtoExtends {

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
     *   @ORM\JoinColumn(name="proto_class_extended_id", referencedColumnName="ID")
     * })
     */
    protected $ProtoClassExtended;


    /**
     * ProtoExtends constructor.
     * @param ProtoClass $ProtoClass
     * @param ProtoClass $ProtoClassExtended
     */
    public function __construct(ProtoClass $ProtoClass, ProtoClass $ProtoClassExtended) {
        $this->ProtoClass = $ProtoClass;
        $this->ProtoClassExtended = $ProtoClassExtended;
    }


}
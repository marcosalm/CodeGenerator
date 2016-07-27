<?php
/**
 * Created by PhpStorm.
 * User: Dcide
 * Date: 26/07/2016
 * Time: 16:09
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProtoClass
 *
 * @ORM\Table(name="proto_project")
 *
 */
class ProtoProject {

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
     * @ORM\Column(name="path", type="string", length=100, nullable=true)
     */
    protected $path;

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
     * @ORM\ManyToOne(targetEntity="ProtoArchitecture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="proto_architecture_id", referencedColumnName="ID")
     * })
     */
    protected $ProtoArchitecture;

}
<?php
namespace App\Entity;
/**
 * Created by PhpStorm.
 * User: Dcide
 * Date: 26/07/2016
 * Time: 15:39
 */

use App\Interfaces\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * ProtoClass
 *
 * @ORM\Table(name="proto_class")
 *
 */
class ProtoClass implements EntityInterface{

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
     * @ORM\Column(name="name_space", type="string", length=100, nullable=true)
     */
    protected $nameSpace;

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
     * @ORM\ManyToOne(targetEntity="ProtoProject")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="proto_project_id", referencedColumnName="id")
     * })
     */
    protected $ProtoProject;


    /**
     * ProtoClass constructor.
     * @param int $id
     * @param string $name
     * @param string $nameSpace
     * @param string $type
     * @param string $comment
     * @param ProtoClass $ProtoProject
     */
    public function __construct($id, $name, $nameSpace, $type, $comment, ProtoClass $ProtoProject) {
        $this->id = $id;
        $this->name = $name;
        $this->nameSpace = $nameSpace;
        $this->type = $type;
        $this->comment = $comment;
        $this->ProtoProject = $ProtoProject;
    }

}
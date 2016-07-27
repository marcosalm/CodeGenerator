<?php
/**
 * Created by PhpStorm.
 * User: Dcide
 * Date: 26/07/2016
 * Time: 16:19
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProtoClass
 *
 * @ORM\Table(name="proto_architecture")
 *
 */
class ProtoArchitecture {

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
     * @ORM\Column(name="config_path", type="string", length=250, nullable=true)
     */
    protected $configPath;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100, nullable=true)
     */
    protected $type;

}
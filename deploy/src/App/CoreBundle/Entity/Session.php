<?php

namespace App\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sessions")
 */
class Session
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(name="sess_id", type="string", length=128)
     */
    private $sessId;

    /**
     * @var string
     *
     * @ORM\Column(name="sess_data", type="text")
     */
    private $sessData;

    /**
     * @var integer
     *
     * @ORM\Column(name="sess_time", type="integer", options={"unsigned"=true})
     */
    private $sessTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="sess_lifetime", type="integer")
     */
    private $sessLifetime;

    /**
     * @return mixed
     */
    public function getSessId()
    {
        return $this->sessId;
    }

    /**
     * @param mixed $sessId
     */
    public function setSessId($sessId)
    {
        $this->sessId = $sessId;
    }

    /**
     * @return mixed
     */
    public function getSessData()
    {
        return $this->sessData;
    }

    /**
     * @param mixed $sessData
     */
    public function setSessData($sessData)
    {
        $this->sessData = $sessData;
    }

    /**
     * @return mixed
     */
    public function getSessTime()
    {
        return $this->sessTime;
    }

    /**
     * @param mixed $sessTime
     */
    public function setSessTime($sessTime)
    {
        $this->sessTime = $sessTime;
    }

    /**
     * @return mixed
     */
    public function getSessLifetime()
    {
        return $this->sessLifetime;
    }

    /**
     * @param mixed $sessLifetime
     */
    public function setSessLifetime($sessLifetime)
    {
        $this->sessLifetime = $sessLifetime;
    }
}

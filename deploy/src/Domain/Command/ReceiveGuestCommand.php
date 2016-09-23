<?php

namespace Domain\Command;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @package Domain\Command
 * @author Rutger Mensch <rutger@mediamonks.com>
 */
class ReceiveGuestCommand
{
    /**
     * @var string
     *
     * @Serializer\SerializedName("uuid")
     * @Serializer\Type("string")
     * @Assert\NotBlank()
     * @Assert\Regex("/^[a-z0-9-]{8}-[a-z0-9-]{4}-[a-z0-9-]{4}-[a-z0-9-]{4}-[a-z0-9-]{12}$/")
     */
    private $uuid;

    /**
     * @var string
     *
     * @Serializer\SerializedName("firstName")
     * @Serializer\Type("string")
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @var string
     *
     * @Serializer\SerializedName("lastName")
     * @Serializer\Type("string")
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var bool
     *
     * @Serializer\Type("boolean")
     * @Assert\NotNull()
     * @Assert\IsTrue()
     */
    private $terms;

    /**
     * @var bool
     *
     * @Serializer\Type("boolean")
     * @Assert\NotNull()
     * @Assert\Type("boolean")
     */
    private $adult;

    /**
     * @var bool
     *
     * @Serializer\SerializedName("newsletter")
     * @Serializer\Type("boolean")
     * @Assert\NotNull()
     * @Assert\Type("boolean")
     */
    private $newsletter;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     * @Assert\Length(min=0, max=6)
     */
    private $zip;

    /**
     * @var int
     *
     * @Serializer\Type("integer")
     * @Assert\NotBlank()
     * @Assert\Range(min=0, max=14)
     */
    private $status;

    /**
     * @var int
     *
     * @Serializer\Type("integer")
     * @Assert\NotBlank()
     * @Assert\Range(min=1, max=2)
     */
    private $phase;

    /**
     * @var int
     *
     * @Serializer\Type("integer")
     * @Assert\Range(min=1, max=999)
     */
    private $station;

    /**
     * @var string
     *
     * @Serializer\SerializedName("artworkData")
     * @Serializer\Type("string")
     */
    private $artworkData;

    /**
     * @var File
     *
     * @Serializer\SerializedName("artworkImage")
     * @Serializer\Type("file")
     * @Assert\Image()
     */
    private $artworkImage;

    /**
     * @var int
     *
     * @Serializer\SerializedName("createdAt")
     * @Serializer\Type("integer")
     * @Assert\NotBlank()
     */
    private $createdAt;

    /**
     * @var int
     *
     * @Serializer\SerializedName("updatedAt")
     * @Serializer\Type("integer")
     * @Assert\NotBlank()
     */
    private $updatedAt;

    /**
     * @var int
     *
     * @Serializer\SerializedName("vrOneAssign")
     * @Serializer\Type("integer")
     */
    private $vrOneAssign;

    /**
     * @var int
     *
     * @Serializer\SerializedName("vrOneStart")
     * @Serializer\Type("integer")
     */
    private $vrOneStart;

    /**
     * @var int
     *
     * @Serializer\SerializedName("vrOneFinish")
     * @Serializer\Type("integer")
     */
    private $vrOneFinish;

    /**
     * @var int
     *
     * @Serializer\SerializedName("vrTwoAssign")
     * @Serializer\Type("integer")
     */
    private $vrTwoAssign;

    /**
     * @var int
     *
     * @Serializer\SerializedName("vrTwoStart")
     * @Serializer\Type("integer")
     */
    private $vrTwoStart;

    /**
     * @var int
     *
     * @Serializer\SerializedName("vrTwoFinish")
     * @Serializer\Type("integer")
     */
    private $vrTwoFinish;

    /**
     * @var string
     *
     * @Serializer\SerializedName("signature")
     * @Serializer\Type("string")
     */
    private $signature;

    /**
     * @param string $uuid
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param bool   $terms
     * @param bool   $adult
     * @param bool   $newsletter
     * @param string $zip
     * @param int    $status
     * @param int    $phase
     * @param int    $station
     * @param string $artworkData
     * @param File   $artworkImage
     * @param int    $createdAt
     * @param int    $updatedAt
     * @param int    $vrOneAssign
     * @param int    $vrOneStart
     * @param int    $vrOneFinish
     * @param int    $vrTwoAssign
     * @param int    $vrTwoStart
     * @param int    $vrTwoFinish
     * @param string $signature
     */
    public function __construct(
        $uuid,
        $firstName,
        $lastName,
        $email,
        $terms,
        $adult,
        $newsletter,
        $zip,
        $status,
        $phase,
        $station,
        $artworkData,
        $artworkImage,
        $createdAt,
        $updatedAt,
        $vrOneAssign,
        $vrOneStart,
        $vrOneFinish,
        $vrTwoAssign,
        $vrTwoStart,
        $vrTwoFinish,
        $signature
    ) {
        $this->uuid = $uuid;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->terms = $terms;
        $this->adult = $adult;
        $this->newsletter = $newsletter;
        $this->zip = $zip;
        $this->status = $status;
        $this->phase = $phase;
        $this->station = $station;
        $this->artworkData = $artworkData;
        $this->artworkImage = $artworkImage;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->vrOneAssign = $vrOneAssign;
        $this->vrOneStart = $vrOneStart;
        $this->vrOneFinish = $vrOneFinish;
        $this->vrTwoAssign = $vrTwoAssign;
        $this->vrTwoStart = $vrTwoStart;
        $this->vrTwoFinish = $vrTwoFinish;
        $this->signature = $signature;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return bool
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * @return bool
     */
    public function isAdult()
    {
        return $this->adult;
    }

    /**
     * @return bool
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getPhase()
    {
        return $this->phase;
    }

    /**
     * @return int
     */
    public function getStation()
    {
        return $this->station;
    }

    /**
     * @return string
     */
    public function getArtworkData()
    {
        return $this->artworkData;
    }

    /**
     * @return File
     */
    public function getArtworkImage()
    {
        return $this->artworkImage;
    }

    /**
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return int
     */
    public function getVrOneAssign()
    {
        return $this->vrOneAssign;
    }

    /**
     * @return int
     */
    public function getVrOneStart()
    {
        return $this->vrOneStart;
    }

    /**
     * @return int
     */
    public function getVrOneFinish()
    {
        return $this->vrOneFinish;
    }

    /**
     * @return int
     */
    public function getVrTwoAssign()
    {
        return $this->vrTwoAssign;
    }

    /**
     * @return int
     */
    public function getVrTwoStart()
    {
        return $this->vrTwoStart;
    }

    /**
     * @return int
     */
    public function getVrTwoFinish()
    {
        return $this->vrTwoFinish;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }
}

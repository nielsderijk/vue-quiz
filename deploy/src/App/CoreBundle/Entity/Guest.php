<?php

namespace App\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use MediaMonks\Doctrine\Mapping\Annotation as MediaMonks;

/**
 * @ORM\Entity()
 * @ORM\Table(name="guests", indexes={
 *     @ORM\Index(name="status_index", columns={"status"}),
 *     @ORM\Index(name="phase_index", columns={"phase"}),
 *     @ORM\Index(name="station_index", columns={"station"}),
 *     @ORM\Index(name="created_at_index", columns={"created_at"}),
 *     @ORM\Index(name="updated_at_index", columns={"updated_at"}),
 *     @ORM\Index(name="vr_one_assign_index", columns={"vr_one_assign"}),
 *     @ORM\Index(name="vr_one_start_index", columns={"vr_one_start"}),
 *     @ORM\Index(name="vr_two_assign_index", columns={"vr_two_assign"}),
 *     @ORM\Index(name="vr_two_start_index", columns={"vr_two_start"})
 * })
 */
class Guest
{
    // The guest has just registered and is waiting to be assigned to a station for VR1.
    const STATUS_VR1_NEW         = 0;
    // The guest has been assigned to a station for VR1 and is waiting for the station to claim the guest.
    const STATUS_VR1_ASSIGNED    = 1;
    // The VR1 session for the guest has been claimed by the station he was assigned to.
    const STATUS_VR1_CLAIMED     = 2;
    // The VR1 session has started for the guest.
    const STATUS_VR1_ACTIVE      = 3;
    // The VR1 session for the guest has been restarted from the admin panel. The station should pick this up soon.
    const STATUS_VR1_RESTARTED   = 4;
    // The VR1 session for the guest has been interrupted from the admin panel. The station should pick this up soon.
    const STATUS_VR1_INTERRUPTED = 5;
    // The VR1 session for the guest has been finished.
    const STATUS_VR1_FINISHED    = 6;
    // The guest has finished VR1 and is waiting to be assigned to a station for VR2.
    const STATUS_VR2_NEW         = 7;
    // The guest has been assigned to a station for VR2 and is waiting for the station to claim the guest.
    const STATUS_VR2_ASSIGNED    = 8;
    // The VR2 session for the guest has been claimed by the station he was assigned to.
    const STATUS_VR2_CLAIMED     = 9;
    // The VR2 session has started for the guest.
    const STATUS_VR2_ACTIVE      = 10;
    // The VR2 session for the guest has been restarted from the admin panel. The station should pick this up soon.
    const STATUS_VR2_RESTARTED   = 11;
    // The VR2 session for the guest has been interrupted from the admin panel. The station should pick this up soon.
    const STATUS_VR2_INTERRUPTED = 12;
    // The guest has finished VR2 and therefore has completely finished the experience.
    const STATUS_VR2_FINISHED    = 13;
    // The guest has been removed from the experience in the admin panel at some point.
    const STATUS_REMOVED         = 14;

    /**
     * @var array
     */
    private $statusMessages = [
        self::STATUS_VR1_NEW         => 'vr1_new',
        self::STATUS_VR1_ASSIGNED    => 'vr1_assigned',
        self::STATUS_VR1_CLAIMED     => 'vr1_claimed',
        self::STATUS_VR1_ACTIVE      => 'vr1_active',
        self::STATUS_VR1_RESTARTED   => 'vr1_restarted',
        self::STATUS_VR1_INTERRUPTED => 'vr1_interrupted',
        self::STATUS_VR1_FINISHED    => 'vr1_finished',
        self::STATUS_VR2_NEW         => 'vr2_new',
        self::STATUS_VR2_ASSIGNED    => 'vr2_assigned',
        self::STATUS_VR2_CLAIMED     => 'vr2_claimed',
        self::STATUS_VR2_ACTIVE      => 'vr2_active',
        self::STATUS_VR2_RESTARTED   => 'vr2_restarted',
        self::STATUS_VR2_INTERRUPTED => 'vr2_interrupted',
        self::STATUS_VR2_FINISHED    => 'vr2_finished',
        self::STATUS_REMOVED         => 'removed',
    ];

    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string")
     * @MediaMonks\Transformable(name="encrypt")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string")
     * @MediaMonks\Transformable(name="encrypt")
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string")
     * @MediaMonks\Transformable(name="encrypt")
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="consent_terms", type="boolean")
     */
    private $consentTerms;

    /**
     * @var bool
     *
     * @ORM\Column(name="over_eighteen", type="boolean")
     */
    private $overEighteen;

    /**
     * @var bool
     *
     * @ORM\Column(name="receive_updates", type="boolean")
     */
    private $updateReceiver;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", nullable=true)
     * @MediaMonks\Transformable(name="encrypt")
     */
    private $zipCode;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status = self::STATUS_VR1_NEW;

    /**
     * @var int
     *
     * @ORM\Column(name="phase", type="smallint")
     */
    private $phase = 1;

    /**
     * @var int
     *
     * @ORM\Column(name="station", type="smallint", nullable=true)
     */
    private $station;

    /**
     * @var string
     *
     * @ORM\Column(name="artwork_data", type="text", nullable=true)
     */
    private $artworkData;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vr_one_assign", type="datetime", nullable=true)
     */
    private $vrOneAssign;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vr_one_start", type="datetime", nullable=true)
     */
    private $vrOneStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vr_one_finish", type="datetime", nullable=true)
     */
    private $vrOneFinish;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vr_two_assign", type="datetime", nullable=true)
     */
    private $vrTwoAssign;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vr_two_start", type="datetime", nullable=true)
     */
    private $vrTwoStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vr_two_finish", type="datetime", nullable=true)
     */
    private $vrTwoFinish;

    /**
     * @var bool
     *
     * @ORM\Column(name="received_email", type="boolean")
     */
    private $receivedEmail = false;

    /**
     * @return string
     */
    public function __toString()
    {
        return 'Guest '.$this->getUuid();
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function getConsentTerms()
    {
        return $this->consentTerms;
    }

    /**
     * @param bool $consentTerms
     */
    public function setConsentTerms($consentTerms)
    {
        $this->consentTerms = $consentTerms;
    }

    /**
     * @return boolean
     */
    public function isOverEighteen()
    {
        return $this->overEighteen;
    }

    /**
     * @param boolean $overEighteen
     */
    public function setOverEighteen($overEighteen)
    {
        $this->overEighteen = $overEighteen;
    }

    /**
     * @return boolean
     */
    public function isUpdateReceiver()
    {
        return $this->updateReceiver;
    }

    /**
     * @param boolean $updateReceiver
     */
    public function setUpdateReceiver($updateReceiver)
    {
        $this->updateReceiver = $updateReceiver;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getStatusMessage()
    {
        if (array_key_exists($this->status, $this->statusMessages)) {
            return $this->statusMessages[$this->status];
        }

        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getPhase()
    {
        return $this->phase;
    }

    /**
     * @param int $phase
     */
    public function setPhase($phase)
    {
        $this->phase = $phase;
    }

    /**
     * @return int
     */
    public function getStation()
    {
        return $this->station;
    }

    /**
     * @param int $station
     */
    public function setStation($station)
    {
        $this->station = $station;
    }

    /**
     * @return string
     */
    public function getArtworkData()
    {
        return $this->artworkData;
    }

    /**
     * @param string $artworkData
     */
    public function setArtworkData($artworkData)
    {
        $this->artworkData = $artworkData;
    }

    /**
     * @return string
     */
    public function getArtworkImagePath()
    {
        $hash = sha1($this->getUuid());
        $prefix = substr($hash, 0, 2);

        return $prefix.'/'.$hash.'.png';
    }

    /**
     * @return int
     */
    public function getRandom360VideoId()
    {
        return intval(substr(base_convert(hexdec($this->uuid), 10, 6), 0, 1));
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|int|string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $this->convertTimestampToDateTime($createdAt);
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime|int|string $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $this->convertTimestampToDateTime($updatedAt);
    }

    /**
     * @return \DateTime
     */
    public function getVrOneAssign()
    {
        return $this->vrOneAssign;
    }

    /**
     * @param \DateTime|int|string $vrOneAssign
     */
    public function setVrOneAssign($vrOneAssign)
    {
        $this->vrOneAssign = $this->convertTimestampToDateTime($vrOneAssign);
    }

    /**
     * @return \DateTime
     */
    public function getVrOneStart()
    {
        return $this->vrOneStart;
    }

    /**
     * @param \DateTime|int|string $vrOneStart
     */
    public function setVrOneStart($vrOneStart)
    {
        $this->vrOneStart = $this->convertTimestampToDateTime($vrOneStart);
    }

    /**
     * @return \DateTime
     */
    public function getVrOneFinish()
    {
        return $this->vrOneFinish;
    }

    /**
     * @param \DateTime|int|string $vrOneFinish
     */
    public function setVrOneFinish($vrOneFinish)
    {
        $this->vrOneFinish = $this->convertTimestampToDateTime($vrOneFinish);
    }

    /**
     * @return \DateTime
     */
    public function getVrTwoAssign()
    {
        return $this->vrTwoAssign;
    }

    /**
     * @param \DateTime|int|string $vrTwoAssign
     */
    public function setVrTwoAssign($vrTwoAssign)
    {
        $this->vrTwoAssign = $this->convertTimestampToDateTime($vrTwoAssign);
    }

    /**
     * @return \DateTime
     */
    public function getVrTwoStart()
    {
        return $this->vrTwoStart;
    }

    /**
     * @param \DateTime|int|string $vrTwoStart
     */
    public function setVrTwoStart($vrTwoStart)
    {
        $this->vrTwoStart = $this->convertTimestampToDateTime($vrTwoStart);
    }

    /**
     * @return \DateTime
     */
    public function getVrTwoFinish()
    {
        return $this->vrTwoFinish;
    }

    /**
     * @param \DateTime|int|string $vrTwoFinish
     */
    public function setVrTwoFinish($vrTwoFinish)
    {
        $this->vrTwoFinish = $this->convertTimestampToDateTime($vrTwoFinish);
    }

    /**
     * @return boolean
     */
    public function hasReceivedEmail()
    {
        return $this->receivedEmail;
    }

    /**
     * @param boolean $receivedEmail
     */
    public function setReceivedEmail($receivedEmail)
    {
        $this->receivedEmail = $receivedEmail;
    }

    /**
     * @param int|string|\DateTime $input
     * @return \DateTime
     */
    protected function convertTimestampToDateTime($input)
    {
        if (!$input) {
            return null;
        }

        if ($input instanceof \DateTime) {
            return $input;
        }

        if (is_numeric($input)) {
            $dateTime = new \DateTime();
            $dateTime->setTimestamp($input);
        } else {
            $dateTime = new \DateTime($input);
        }

        return $dateTime;
    }
}

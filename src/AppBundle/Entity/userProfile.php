<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="userProfiles")
*/
class userProfile
{
	/**
	* @ORM\Column(type="integer")
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

	/**
	* @ORM\Column(type="string", length= 50)
	*/
	protected $googleId;

	/**
	* @ORM\Column(type="string", length=100)
	*/
	protected $name;

	/**
	* @ORM\Column(type="string", length=1000)
	*/
	protected $imageUrl;

    /**
    * @ORM\Column(type="string", length=1000)
    */
    protected $accessToken;

    /**
    * @ORM\Column(type="string", length=1000)
    */
    protected $refreshToken;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set google_id
     *
     * @param integer $googleId
     * @return user_profile
     */
    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;

        return $this;
    }

    /**
     * Get google_id
     *
     * @return integer 
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return user_profile
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set image_url
     *
     * @param string $imageUrl
     * @return user_profile
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get image_url
     *
     * @return string 
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set refreshToken
     *
     * @param string $refreshToken
     * @return userProfile
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * Get refreshToken
     *
     * @return string 
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Set accessToken
     *
     * @param string $accessToken
     * @return userProfile
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Get accessToken
     *
     * @return string 
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}

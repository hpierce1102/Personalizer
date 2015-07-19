<?php
namespace HaydenPierce\PersonalizerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="eBooks")
*/
class eBook {

	/**
	* @ORM\Column(type="integer")
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

	/**
	* @ORM\Column(type="string", length=500)
	*/
	protected $coverImageUrl;

	/**
	* @ORM\Column(type="string", length=100)
	*/
	protected $title;

	/**
	* @ORM\Column(type="text")
	*/
	protected $description;

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
     * Set coverImageUrl
     *
     * @param string $coverImageUrl
     * @return eBook
     */
    public function setCoverImageUrl($coverImageUrl)
    {
        $this->coverImageUrl = $coverImageUrl;

        return $this;
    }

    /**
     * Get coverImageUrl
     *
     * @return string 
     */
    public function getCoverImageUrl()
    {
        return $this->coverImageUrl;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return eBook
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return eBook
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}

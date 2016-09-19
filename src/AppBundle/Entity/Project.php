<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FS\SolrBundle\Doctrine\Annotation as Solr;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;

/**
 * Project
 *
 * @Solr\Document()
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @var int
     *
     * @Solr\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Solr\Field(type="string")
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @Solr\Field(type="string")
     * @ORM\Column(name="short_name", type="string", length=255, nullable=true)
     */
    private $shortName;

    /**
     * @var string
     *
     * @Solr\Field(type="string")
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var string
     *
     * @Solr\Field(type="string")
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @Solr\Field(type="string")
     * @ORM\Column(name="project_status", type="string", length=255, nullable=true)
     */
    private $projectStatus;

    public function __construct(array $values = [])
    {
        foreach (get_object_vars($this) as $property => $value) {
            if (isset($values[$property])) {
                $this->$property = $values[$property];
            }
        }
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Project
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
     * Set shortName
     *
     * @param string $shortName
     *
     * @return Project
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName
     *
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Project
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Project
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set projectStatus
     *
     * @param string $projectStatus
     *
     * @return Project
     */
    public function setProjectStatus($projectStatus)
    {
        $this->projectStatus = $projectStatus;

        return $this;
    }

    /**
     * Get projectStatus
     *
     * @return string
     */
    public function getProjectStatus()
    {
        return $this->projectStatus;
    }

    /**
     * Represent project as array.
     *
     * @param $project
     *
     * @return mixed
     */
    public function toArray()
    {
        $normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());
        return $normalizer->normalize($this);
    }
}

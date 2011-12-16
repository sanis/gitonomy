<?php

namespace Gitonomy\Bundle\CoreBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as AssertDoctrine;

/**
 * @ORM\Entity
 * @ORM\Table(name="project")
 *
 * @AssertDoctrine\UniqueEntity(fields="name",groups={"admin"})
 * @AssertDoctrine\UniqueEntity(fields="slug",groups={"admin"})
 */
class Project
{
    const SLUG_PATTERN = '[a-z0-9-_]+';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",length=32,unique=true)
     * @Assert\NotBlank(groups={"admin"})
     */
    protected $name;

    /**
     * @ORM\Column(type="string",length=32,unique=true)
     * @Assert\NotBlank(groups={"admin"})
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $mainBranch;

    /**
     * @ORM\OneToMany(targetEntity="Gitonomy\Bundle\CoreBundle\Entity\UserRoleProject", mappedBy="project", cascade={"persist", "remove"})
     */
    protected $userRoles;

    public function __construct()
    {
        $this->mainBranch = 'master';
        $this->userRoles  = new ArrayCollection();
    }

    public function getMainBranch()
    {
        return $this->mainBranch;
    }

    public function setMainBranch($mainBranch)
    {
        $this->mainBranch = $mainBranch;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getUserRoles()
    {
        return $this->userRoles;
    }
}

<?php
/**
 * This file is part of knocker project
 * Created by Mikhail Peghasin
 * mikhail.pegasin@itmhouse.com
 */

namespace AppBundle\Roles;


use Doctrine\ORM\EntityManager;

class KnockerRoleBuilder {

    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getKnockerRoles($userId)
    {
        $services = $this->em->getRepository("ApplicationSonataUserBundle:User")->find($userId)->getServices();
        return [];
    }
} 
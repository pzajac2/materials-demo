<?php

namespace Application\Hydrator;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Hydrator\NamingStrategy\UnderscoreNamingStrategy;

class EntityHydrator extends DoctrineObject
{
    public function __construct(ObjectManager $objectManager, $byValue = true)
    {
        parent::__construct($objectManager, $byValue);
        $this->setNamingStrategy(new UnderscoreNamingStrategy);
    }

}

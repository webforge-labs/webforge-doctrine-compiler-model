<?php

namespace Webforge\Doctrine\Compiler\Model;

class Model {

  protected $entities = array();
  protected $entitiesByFQN = array();

  protected $namspace;

  /**
   * @return Entity
   * @throws EntityNotFoundException
   */
  public function getEntity($fqn) {
    if (array_key_exists($fqn, $this->entitiesByFQN)) {
      return $this->entitiesByFQN[$fqn];
    }

    throw new EntityNotFoundException(
      sprintf("Cannot find the entity '%s' in model. Available entities are:\n%s", $fqn, implode(", ", array_keys($this->entitiesByFQN)))
    );
  }

  /**
   * @return string
   */
  public function getNamespace() {
    return $this->namespace;
  }
  
  /**
   * @param string namespace
   * @chainable
   */
  public function setNamespace($namespace) {
    $this->namespace = $namespace;
    return $this;
  }

  public function addEntity(Entity $entity) {
    $this->entities[] = $entity;
    $this->entitiesByFQN[$entity->getFQN()] = $entity;
  }

  public function getEntities() {
    return $this->entities;
  }
}

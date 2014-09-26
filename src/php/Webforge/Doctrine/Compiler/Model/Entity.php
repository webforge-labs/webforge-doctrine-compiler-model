<?php

namespace Webforge\Doctrine\Compiler\Model;

class Entity {

  protected $fqn;

  protected $reference = FALSE;
  protected $collection = FALSE;

  public function __construct($fqn) {
    $this->fqn = $fqn;
  }

  public function getFqn() {
    return $this->fqn;
  }

  public function isReference() {
    return $this->reference;
  }

  public function isCollection() {
    return $this->collection;
  }
}

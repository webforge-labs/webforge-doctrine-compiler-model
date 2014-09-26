<?php

namespace Webforge\Doctrine\Compiler\Model;

use Webforge\Common\System\File;
use Webforge\Common\JS\JSONConverter;

class Reader {

  public function fromJSON(\stdClass $json) {
    $model = new Model();
    $model->setNamespace($json->namespace);

    foreach ($json->entities as $jsonEntity) {
      $entity = new Entity($jsonEntity->fqn);

      $model->addEntity($entity);
    }

    return $model;
  }

  public function fromFile(File $file) {
    return $this->fromJSON(JSONConverter::create()->parseFile($file));
  }
}

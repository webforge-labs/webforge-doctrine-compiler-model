<?php

namespace Webforge\Doctrine\Compiler\Model;

use PHPUnit_Framework_TestCase;
use Webforge\Common\ArrayUtil as A;

class ModelTest extends PHPUnit_Framework_TestCase {
  
  public function setUp() {
    parent::setUp();

    $this->reader = new Reader();
    $this->model = $this->reader->fromFile($GLOBALS['env']['root']->getFile('tests/files/model-compiled.json'));
  }

  public function testItHasTheRightNamespace() {
    $this->assertEquals('ACME\Blog\Entities', $this->model->getNamespace());
  }

  public function testTheModelContainsAllEntities() {
    $this->assertCount(10, $entities = $this->model->getEntities(), 'expected number entities does not match');
    $this->assertContainsOnlyInstancesOf('Webforge\Doctrine\Compiler\Model\Entity', $entities);

    $this->assertEquals(
      Test\Reflection::flatEntityFQNs(),
      A::pluck($entities, 'fqn'),
      'not all FQNs are found in the read model',
      0.0,
      10,
      $canon = true
    );
  }

  public function testOneEntityCanBeRetrievedFromModel() {
    $this->assertEquals('ACME\Blog\Entities\Post', $this->model->getEntity('ACME\Blog\Entities\Post')->getFQN());
  }

  public function testOneUnkownEntityCannotBeRetrievedFromModel() {
    $this->setExpectedException(__NAMESPACE__.'\\EntityNotFoundException');

    $this->model->getEntity('ACME\Blog\Entities\post');
  }

  public function testEntitiesHaveRightCollectionAndReferenceFlags() {

  }
}

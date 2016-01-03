<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own;

trait OwnBody_FromCompleteTrait {

  /**
   * @var string
   */
  private $qcn;

  /**
   * @param string $qcn
   */
  function __construct($qcn) {
    $this->qcn = $qcn;
  }

  /**
   * @param string $name
   *
   * @return null|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  protected function findOwnMethod($name) {
    $method = $this->getMethod($name);
    if ($this->qcn === $method->getDeclaringClassName()) {
      return $method;
    }
    return NULL;
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface[]
   */
  protected function findOwnMethods() {
    $methods = array();
    foreach ($this->getMethods() as $key => $method) {
      if ($this->qcn === $method->getDeclaringClassName()) {
        $methods[$key] = $method;
      }
    }
    return $methods;
  }

  /**
   * @param string $name
   *
   * @return null|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  abstract protected function getMethod($name);

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface[]
   */
  abstract protected function getMethods();

}

<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own;

use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Complete\CompleteBodyInterface;

class OwnBody_FromComplete extends OwnBodyBase {

  /**
   * @var string
   */
  private $qcn;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Complete\CompleteBodyInterface
   */
  private $completeBody;

  /**
   * @param string $qcn
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Complete\CompleteBodyInterface $completeBody
   */
  function __construct($qcn, CompleteBodyInterface $completeBody) {
    $this->qcn = $qcn;
    $this->completeBody = $completeBody;
  }

  /**
   * @param string $name
   *
   * @return null|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  protected function findOwnMethod($name) {
    $method = $this->completeBody->getMethod($name);
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
    foreach ($this->completeBody->getMethods() as $key => $method) {
      if ($this->qcn === $method->getDeclaringClassName()) {
        $methods[$key] = $method;
      }
    }
    return $methods;
  }
}

<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Complete;

trait CompleteBody_DecoratorTrait {

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Complete\CompleteBodyInterface
   */
  private $completeBody;

  /**
   * @return false|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  function getConstructor() {
    return $this->completeBody->getMethod('__construct');
  }

  /**
   * @param string $name
   *
   * @return null|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  function getMethod($name) {
    return $this->completeBody->getMethod($name);
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface[]
   */
  function getMethods() {
    return $this->completeBody->getMethods();
  }

}

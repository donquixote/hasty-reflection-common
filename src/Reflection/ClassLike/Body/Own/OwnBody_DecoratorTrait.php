<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own;

trait OwnBody_DecoratorTrait {

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own\OwnBodyInterface
   */
  private $ownBody;

  /**
   * @param string $name
   *
   * @return null|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  function getOwnMethod($name) {
    return $this->ownBody->getOwnMethod($name);
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface[]
   */
  function getOwnMethods() {
    return $this->ownBody->getOwnMethods();
  }

}

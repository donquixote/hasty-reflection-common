<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Complete;

use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own\OwnBodyInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface;

class CompleteBody_FromOwn extends CompleteBodyBase {

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface
   */
  private $extends;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface
   */
  private $interfacesAll;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own\OwnBodyInterface
   */
  private $ownBody;

  /**
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface $extends
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface $interfacesAll
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own\OwnBodyInterface $ownBody
   */
  function __construct(ClassExtendsInterface $extends, AllInterfacesInterface $interfacesAll, OwnBodyInterface $ownBody) {
    $this->extends = $extends;
    $this->interfacesAll = $interfacesAll;
    $this->ownBody = $ownBody;
  }

  /**
   * @param string $name
   *
   * @return false|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  protected function findMethod($name) {
    if ($method = $this->ownBody->getOwnMethod($name)) {
      return $method;
    }
    if (NULL !== $parentClass = $this->extends->getParentClass()) {
      if ($method = $this->extends->getParentClass()->getOwnMethod($name)) {
        return $method;
      }
    }
    foreach ($this->interfacesAll->getAllInterfaces(FALSE) as $interface) {
      $method = $interface->getOwnMethod($name);
      if (FALSE !== $method) {
        return $method;
      }
    }
    return NULL;
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface[]
   */
  protected function findMethods() {
    $methods = $this->ownBody->getOwnMethods();
    $parentClass = $this->extends->getParentClass();
    if (NULL !== $parentClass) {
      $methods += $parentClass->getMethods();
    }
    foreach ($this->interfacesAll->getAllInterfaces(FALSE) as $interface) {
      $methods += $interface->getOwnMethods();
    }
    return $methods;
  }
}

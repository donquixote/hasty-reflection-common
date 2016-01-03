<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Complete;

use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface;

trait CompleteBody_FromOwnTrait {

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface
   */
  private $extends;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface
   */
  private $interfacesAll;

  /**
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface $extends
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface $interfacesAll
   */
  function __construct(ClassExtendsInterface $extends, AllInterfacesInterface $interfacesAll) {
    $this->extends = $extends;
    $this->interfacesAll = $interfacesAll;
  }

  /**
   * @param string $name
   *
   * @return false|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  protected function findMethod($name) {
    if ($method = $this->getOwnMethod($name)) {
      return $method;
    }
    if (NULL !== $parentClass = $this->extends->getParentClass()) {
      if ($method = $this->extends->getParentClass()->getMethod($name)) {
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
    $methods = $this->getOwnMethods();
    $parentClass = $this->extends->getParentClass();
    if (NULL !== $parentClass) {
      $methods += $parentClass->getMethods();
    }
    foreach ($this->interfacesAll->getAllInterfaces(FALSE) as $interface) {
      $methods += $interface->getOwnMethods();
    }
    return $methods;
  }

  /**
   * @param string $name
   *
   * @return null|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  abstract protected function getOwnMethod($name);

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface[]
   */
  abstract protected function getOwnMethods();

}

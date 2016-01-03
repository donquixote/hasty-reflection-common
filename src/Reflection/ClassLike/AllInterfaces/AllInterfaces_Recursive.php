<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces;

use Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces\OwnInterfacesInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface;

class AllInterfaces_Recursive extends AllInterfacesBase {

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface
   */
  private $extends;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces\OwnInterfacesInterface
   */
  private $interfacesRecursive;

  /**
   * @var string|null
   */
  private $interfaceSelf;

  /**
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface $extends
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces\OwnInterfacesInterface $interfacesRecursive
   * @param string $interfaceSelf
   */
  function __construct(ClassExtendsInterface $extends, OwnInterfacesInterface $interfacesRecursive, $interfaceSelf = NULL) {
    $this->extends = $extends;
    $this->interfacesRecursive = $interfacesRecursive;
    $this->interfaceSelf = $interfaceSelf;
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  protected function buildAllInterfaces() {
    $interfaces = $this->interfacesRecursive->getOwnInterfaces();
    foreach ($interfaces as $interface) {
      $interfaces += $interface->getAllInterfaces();
    }
    if (NULL !== $this->interfaceSelf) {
      $interfaces = array($this->interfaceSelf => $this) + $interfaces;
    }
    if ($parentClass = $this->extends->getParentClass()) {
      $interfaces += $parentClass->getAllInterfaces();
    }
    return $interfaces;
  }
}

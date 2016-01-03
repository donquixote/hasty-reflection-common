<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces;

use Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces\OwnInterfacesInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface;

class AllInterfaces_FromOwn extends AllInterfacesBase {

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface
   */
  private $extends;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces\OwnInterfacesInterface
   */
  private $ownInterfaces;

  /**
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface $extends
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces\OwnInterfacesInterface $ownInterfaces
   */
  function __construct(ClassExtendsInterface $extends, OwnInterfacesInterface $ownInterfaces) {
    $this->extends = $extends;
    $this->ownInterfaces = $ownInterfaces;
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  protected function buildAllInterfacesWithoutSelf() {
    $interfaces = $this->ownInterfaces->getOwnInterfaces();
    foreach ($interfaces as $interface) {
      $interfaces += $interface->getAllInterfaces(FALSE);
    }
    if ($parentClass = $this->extends->getParentClass()) {
      $interfaces += $parentClass->getAllInterfaces(FALSE);
    }
    return $interfaces;
  }
}

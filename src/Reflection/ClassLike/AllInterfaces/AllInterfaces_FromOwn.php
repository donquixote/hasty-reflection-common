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
   * @var string|null
   */
  private $selfInterfaceName;

  /**
   * @var \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface
   */
  private $classIndex;

  /**
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface $extends
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces\OwnInterfacesInterface $ownInterfaces
   * @param string|null $interfaceSelf
   * @param \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface $classIndex
   */
  function __construct(ClassExtendsInterface $extends, OwnInterfacesInterface $ownInterfaces, $interfaceSelf = NULL, ClassIndexInterface $classIndex) {
    $this->extends = $extends;
    $this->ownInterfaces = $ownInterfaces;
    $this->selfInterfaceName = $interfaceSelf;
    $this->classIndex = $classIndex;
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  protected function buildAllInterfacesWithoutSelf() {
    $interfaces = $this->ownInterfaces->getOwnInterfaces();
    foreach ($interfaces as $interface) {
      $interfaces += $interface->getAllInterfaces(FALSE);
    }
    if (NULL !== $this->selfInterfaceName) {
      $selfInterface = $this->classIndex->classGetReflection($this->selfInterfaceName);
      if (NULL !== $selfInterface) {
        $interfaces = array($this->selfInterfaceName => $selfInterface) + $interfaces;
      }
    }
    if ($parentClass = $this->extends->getParentClass()) {
      $interfaces += $parentClass->getAllInterfaces(FALSE);
    }
    return $interfaces;
  }
}

<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces;

use Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface;

class OwnInterfaces_FromNames implements OwnInterfacesInterface {

  /**
   * @var \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface
   */
  private $autoloadSource;

  /**
   * @var string[]
   */
  private $ownInterfaceNames;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]|null
   */
  private $interfaces;

  /**
   * @param \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface $classIndex
   * @param string[] $ownInterfaceNames
   */
  function __construct(ClassIndexInterface $classIndex, array $ownInterfaceNames) {
    $this->autoloadSource = $classIndex;
    $this->ownInterfaceNames = $ownInterfaceNames;
  }

  /**
   * Gets the interfaces directly/explicitly implemented by this class.
   *
   * This does not include interfaces implemented by parent classes, or extended
   * by explicitly implemented interfaces.
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  function getOwnInterfaces() {
    return NULL !== $this->interfaces
      ? $this->interfaces
      : $this->interfaces = $this->buildInterfaces();
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  private function buildInterfaces() {
    $interfaces = array();
    foreach ($this->ownInterfaceNames as $qcn) {
      $interface = $this->autoloadSource->classGetReflection($qcn);
      if ($interface && $interface->isInterface()) {
        $interfaces[$qcn] = $interface;
      }
    }
    return $interfaces;
  }
}

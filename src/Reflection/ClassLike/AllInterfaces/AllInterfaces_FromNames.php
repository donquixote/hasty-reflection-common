<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces;

use Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface;

class AllInterfaces_FromNames extends AllInterfacesBase {

  /**
   * @var \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface
   */
  private $autoloadSource;

  /**
   * @var string[]
   */
  private $allInterfaceNames;

  /**
   * @param \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface $autoloadSource
   * @param string[] $allInterfaceNames
   */
  function __construct(ClassIndexInterface $autoloadSource, array $allInterfaceNames) {
    $this->autoloadSource = $autoloadSource;
    $this->allInterfaceNames = $allInterfaceNames;
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  protected function buildAllInterfaces() {
    $interfaces = array();
    foreach ($this->allInterfaceNames as $qcn) {
      $interface = $this->autoloadSource->classGetReflection($qcn);
      if ($interface && $interface->isInterface()) {
        $interfaces[$qcn] = $interface;
      }
    }
    return $interfaces;
  }
}

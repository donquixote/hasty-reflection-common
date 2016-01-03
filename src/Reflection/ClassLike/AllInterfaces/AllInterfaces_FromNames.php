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
  private $allInterfaceNamesWithoutSelf;

  /**
   * @param \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface $autoloadSource
   * @param string[] $allInterfaceNamesWithoutSelf
   */
  function __construct(ClassIndexInterface $autoloadSource, array $allInterfaceNamesWithoutSelf) {
    $this->autoloadSource = $autoloadSource;
    $this->allInterfaceNamesWithoutSelf = $allInterfaceNamesWithoutSelf;
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  protected function buildAllInterfacesWithoutSelf() {
    $interfaces = array();
    foreach ($this->allInterfaceNamesWithoutSelf as $interfaceName) {
      $interface = $this->autoloadSource->classGetReflection($interfaceName);
      if ($interface && $interface->isInterface()) {
        $interfaces[$interfaceName] = $interface;
      }
    }
    return $interfaces;
  }
}

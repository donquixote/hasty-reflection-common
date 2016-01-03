<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces;

use Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface;

abstract class AllInterfacesBase implements AllInterfacesInterface {

  /**
   * @var string|null
   */
  private $selfInterfaceName;

  /**
   * @var \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface|null
   */
  private $classIndex;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]|null
   */
  private $interfacesAll;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]|null
   */
  private $interfacesAllInclSelf;

  /**
   * @param string $selfInterfaceName
   * @param \Donquixote\HastyReflectionCommon\Canvas\ClassIndex\ClassIndexInterface $classIndex
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface
   */
  function withSelfInterfaceName($selfInterfaceName, ClassIndexInterface $classIndex) {
    $clone = clone $this;
    $clone->selfInterfaceName = $selfInterfaceName;
    $clone->classIndex = $classIndex;
    return $clone;
  }

  /**
   * Gets all interfaces directly or indirectly implemented by this class.
   *
   * Will include the class itself if it is an interface.
   *
   * @param bool $includeSelf
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  function getAllInterfaces($includeSelf) {
    if (NULL === $this->interfacesAll) {
      $this->interfacesAllInclSelf = $this->interfacesAll = $this->buildAllInterfacesWithoutSelf();
      if (NULL !== $this->selfInterfaceName) {
        $selfInterface = $this->classIndex->classGetReflection($this->selfInterfaceName);
        if (NULL !== $selfInterface) {
          $this->interfacesAllInclSelf = array($this->selfInterfaceName => $selfInterface) + $this->interfacesAllInclSelf;
        }
      }
    }
    return $includeSelf
      ? $this->interfacesAllInclSelf
      : $this->interfacesAll;
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  abstract protected function buildAllInterfacesWithoutSelf();

  /**
   * @param string $interfaceName
   * @param bool $includeSelf
   *
   * @return bool
   */
  function extendsOrImplementsInterface($interfaceName, $includeSelf) {
    $interfacesAll = $this->getAllInterfaces($includeSelf);
    return isset($interfacesAll[$interfaceName]);
  }
}

<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces;

abstract class AllInterfacesBase implements AllInterfacesInterface {

  /**
   * @var string|null
   */
  private $selfInterfaceName;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]|null
   */
  private $interfacesAll;

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]|null
   */
  private $selfInterfacesAll;

  /**
   * @param string $selfInterfaceName
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface
   */
  function withSelfInterfaceName($selfInterfaceName) {
    $clone = clone $this;
    $clone->selfInterfaceName = $selfInterfaceName;
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
      $this->selfInterfacesAll = $this->interfacesAll = $this->buildAllInterfacesWithoutSelf();
      if (NULL !== $this->selfInterfaceName) {
        array_unshift($this->selfInterfacesAll, $this->selfInterfaceName);
      }
    }
    return $includeSelf
      ? $this->selfInterfacesAll
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

<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces;

abstract class AllInterfacesBase implements AllInterfacesInterface {

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]|null
   */
  private $interfacesAll;

  /**
   * Gets all interfaces directly or indirectly implemented by this class.
   *
   * Will include the class itself if it is an interface.
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  function getAllInterfaces() {
    return NULL !== $this->interfacesAll
      ? $this->interfacesAll
      : $this->interfacesAll = $this->buildAllInterfaces();
  }

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  abstract protected function buildAllInterfaces();

  /**
   * @param string $interfaceName
   *
   * @return bool
   */
  function extendsOrImplementsInterface($interfaceName) {
    $interfacesAll = $this->getAllInterfaces();
    return isset($interfacesAll[$interfaceName]);
  }
}

<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces;

interface AllInterfacesInterface {

  /**
   * Gets all interfaces directly or indirectly implemented by this class.
   *
   * Will include the class itself if it is an interface.
   *
   * @param bool $includeSelf
   *   If TRUE, and the class is an interface, it will be included in the result.
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  function getAllInterfaces($includeSelf);

  /**
   * @param string $interfaceName
   * @param bool $includeSelf
   *
   * @return bool
   */
  function extendsOrImplementsInterface($interfaceName, $includeSelf);

}

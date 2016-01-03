<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces;

interface AllInterfacesInterface {

  /**
   * Gets all interfaces directly or indirectly implemented by this class.
   *
   * Will include the class itself if it is an interface.
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  function getAllInterfaces();

  /**
   * @param string $interfaceName
   *
   * @return bool
   */
  function extendsOrImplementsInterface($interfaceName);

}

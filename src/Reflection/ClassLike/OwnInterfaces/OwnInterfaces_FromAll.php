<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces;

use Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface;

class OwnInterfaces_FromAll implements OwnInterfacesInterface {

  /**
   * @var \Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface
   */
  private $allInterfaces;

  /**
   * @var string|null
   */
  private $selfInterfaceName;

  /**
   * @param \Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface $allInterfaces
   * @param string|null $selfInterfaceName
   */
  function __construct(AllInterfacesInterface $allInterfaces, $selfInterfaceName) {
    $this->allInterfaces = $allInterfaces;
    $this->selfInterfaceName = $selfInterfaceName;
  }

  /**
   * Gets the interfaces directly/explicitly implemented or extended by this
   * class or interface.
   *
   * This does not include interfaces implemented by parent classes, or extended
   * by explicitly implemented interfaces.
   *
   * If the class itself is an interface, it will NOT be part of the returned
   * array.
   *
   * Some implementations with no access to a parser might simply return ALL
   * interfaces, but without the class itself, if it is an interface.
   *
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  function getOwnInterfaces() {
    return $this->allInterfaces->getAllInterfaces(FALSE);
  }
}

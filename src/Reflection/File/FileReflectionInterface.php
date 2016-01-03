<?php

namespace Donquixote\HastyReflectionCommon\Reflection\File;

interface FileReflectionInterface {

  /**
   * @return \Donquixote\HastyReflectionCommon\NamespaceUseContext\NamespaceUseContextInterface
   */
  function getNamespaceUseContext();

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface[]
   */
  function getClassLikesByQcn();

}

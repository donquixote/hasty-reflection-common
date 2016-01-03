<?php

namespace Donquixote\HastyReflectionCommon\Reflection\FunctionLike;

use Donquixote\HastyReflectionCommon\Reflection\DeclarationInterface;

interface FunctionLikeReflectionInterface extends DeclarationInterface {

  /**
   * @return bool
   */
  function isByReference();

  /**
   * @return string
   *   E.g. "foo" for Acme\Tiger::foo().
   */
  function getName();

  /**
   * @return string
   *   E.g. "Acme\\Tiger::foo" for Acme\Tiger::foo()
   */
  function getQualifiedName();

}

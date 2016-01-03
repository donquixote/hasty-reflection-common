<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body;

use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Complete\CompleteBodyInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\Own\OwnBodyInterface;

interface ClassLikeBodyInterface extends OwnBodyInterface, CompleteBodyInterface {

  /**
   * @return false|\Donquixote\HastyReflectionCommon\Reflection\FunctionLike\MethodReflectionInterface
   */
  function getConstructor();

}

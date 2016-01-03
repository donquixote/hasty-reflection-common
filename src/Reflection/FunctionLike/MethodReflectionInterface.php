<?php

namespace Donquixote\HastyReflectionCommon\Reflection\FunctionLike;

interface MethodReflectionInterface extends FunctionLikeReflectionInterface {

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassLikeReflectionInterface
   */
  function getDeclaringClass();

  /**
   * @return string
   */
  function getDeclaringClassName();

  /**
   * @return bool
   */
  function isStatic();

  /**
   * @return bool
   */
  function isAbstract();

  /**
   * @return bool
   */
  function isPrivate();

  /**
   * @return bool
   */
  function isPublic();

  /**
   * @return bool
   */
  function isProtected();

  /**
   * @return \Donquixote\HastyReflectionCommon\Reflection\Parameter\ParameterReflectionInterface[]
   */
  # function getParameters();
}

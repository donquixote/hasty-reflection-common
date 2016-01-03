<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Header;

interface ClassLikeHeaderInterface {

  /**
   * @return bool
   */
  function isInterface();

  /**
   * @return bool
   */
  function isClass();

  /**
   * @return bool
   */
  function isTrait();

  /**
   * @return bool
   */
  function isAbstract();

  /**
   * @return bool
   */
  function isFinal();

  /**
   * @return string
   */
  function getName();

}

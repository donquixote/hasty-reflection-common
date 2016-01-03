<?php

namespace Donquixote\HastyReflectionCommon\Reflection;

interface DeclarationInterface {

  /**
   * @return string|null
   */
  function getDocComment();

  /**
   * @return \Donquixote\HastyReflectionCommon\NamespaceUseContext\NamespaceUseContextInterface
   */
  function getNamespaceUseContext();

}

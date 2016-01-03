<?php

namespace Donquixote\HastyReflectionCommon\NamespaceUseContext;

/**
 * Represents the use and namespace statements that change the meaning of
 * identifiers used in a php file.
 */
interface NamespaceUseContextInterface {

  /**
   * @return string|null
   */
  function getNamespaceName();

  /**
   * Translates a local name or alias into a qualified name, based on the
   * namespace and use statements found in the file.
   *
   * @param string $nameOrAlias
   *   The local name or alias being used.
   *
   * @return string
   */
  function aliasGetName($nameOrAlias);

}

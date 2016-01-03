<?php

namespace Donquixote\HastyReflectionCommon\NamespaceUseContext;

class NamespaceUseContext_Empty implements NamespaceUseContextInterface {

  /**
   * @return string|null
   */
  function getNamespaceName() {
    return NULL;
  }

  /**
   * Translates a local name or alias into a qualified name, based on the
   * namespace and use statements found in the file.
   *
   * @param string $nameOrAlias
   *   The local name or alias being used.
   *
   * @return string
   */
  function aliasGetName($nameOrAlias) {
    if ('\\' === $nameOrAlias[0]) {
      return substr($nameOrAlias, 1);
    }
    else {
      return $nameOrAlias;
    }
  }
}

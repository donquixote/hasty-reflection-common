<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike\Inheritance;

use Donquixote\HastyReflectionCommon\Reflection\ClassLike\ClassExtends\ClassExtendsInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\AllInterfaces\AllInterfacesInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\OwnInterfaces\OwnInterfacesInterface;

interface InheritanceInterface extends ClassExtendsInterface, AllInterfacesInterface, OwnInterfacesInterface {

}

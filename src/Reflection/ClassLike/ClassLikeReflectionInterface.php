<?php

namespace Donquixote\HastyReflectionCommon\Reflection\ClassLike;

use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Body\ClassLikeBodyInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Header\ClassLikeHeaderInterface;
use Donquixote\HastyReflectionCommon\Reflection\ClassLike\Inheritance\InheritanceInterface;
use Donquixote\HastyReflectionCommon\Reflection\DeclarationInterface;

interface ClassLikeReflectionInterface extends DeclarationInterface, ClassLikeHeaderInterface, InheritanceInterface, ClassLikeBodyInterface {

}

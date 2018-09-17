<?php
/**
 * Created by PhpStorm.
 * User: jacobmalachowski
 * Date: 9/17/18
 * Time: 10:37 AM
 */

namespace Neighborhoods\Prefab;


interface ClassSaverInterface
{
    public function saveClass() : ClassSaverInterface;
    public function setNamespace(string $namespace) : ClassSaverInterface;
    public function setGeneratedClass(string $generatedClass) : ClassSaverInterface;
    public function setClassName(string $className) : ClassSaverInterface;
}

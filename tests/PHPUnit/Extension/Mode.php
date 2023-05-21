<?php

namespace App\Tests\PHPUnit\Extension;

enum Mode: string
{
    case Migration = 'migrations';
    case Schema = 'schema';
}

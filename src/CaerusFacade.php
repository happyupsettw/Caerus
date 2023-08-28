<?php
/**
 * Author: Panigale
 * Date: 2023/8/23
 * Time: 4:39 PM
 */

namespace Panigale\Caerus;

use Illuminate\Support\Facades\Facade;

class CaerusFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'caerus';
    }
}
<?php
/**
 * Author: Panigale
 * Date: 2023/8/9
 * Time: 4:23 PM
 */

namespace Panigale\Caerus\Askables;

trait Apis
{
    protected function sportUrl()
    {
        return env('CAERUS_DOMAIN').'/sports/football?active=true&plays=2,10,12&gamingType=agent&lang=zh_TW';
    }

    /**
     * @return bool|mixed|string
     */
    protected function domain()
    {
        return env('CAERUS_DOMAIN');
    }
}
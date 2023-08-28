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
        return 'https://api.airsports.com.tw/sports/football?active=true&plays=2,10,12&gamingType=agent&lang=zh_TW';
    }
}
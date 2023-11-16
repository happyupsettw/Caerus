<?php
/**
 * Author: Panigale
 * Date: 2023/8/21
 * Time: 5:42 PM
 */

namespace Panigale\Caerus\Askables;

class Game extends Askable
{
    private $category;

    public function url()
    {
        return $this->domain().'/games';
    }

    public function category($type)
    {
        $this->category = $type;

        return $this;
    }

    public function plays(array $playIds)
    {
        $this->plays = $playIds;

        return $this;
    }

    protected function composeUrl(): string
    {
        $url = $this->domain();

        $url .= '/games?';

        if($this->category){
            $url .= 'category='.$this->category;
        }

        if($this->plays){
            $url .= '&plays=';

            foreach ($this->plays as $play)
                $url .= $play.',';
        }

        $url.= 'gamingType=agent&lang=zh_TW';

        return $url;
    }
}
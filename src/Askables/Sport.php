<?php
/**
 * Author: Panigale
 * Date: 2023/8/9
 * Time: 3:50 PM
 */

namespace Panigale\Caerus\Askables;

class Sport extends Askable
{
    /**
     * @var string|null
     */
    public $sport;

    public function __construct(string $sport = null)
    {
        $this->sport = $sport;
    }

    public function fetch()
    {
        if($this->sport)
            return $this->fetchSport($this->sport);

        return $this->fetchSportList();
    }

    public function fetchSport(string $sport)
    {
        $domain = $this->domain().'/sports/baseball';

        return $this->get($domain, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'params' => [
                'active' => 'true',
                'plays' => '2,10,12',
                'gamingType' => 'agent',
                'lang' => 'zh_TW'
            ]
        ])->getBody()->getContents();
    }

    public function setSport(string $sport): Sport
    {
        $this->sport = $sport;

        return $this;
    }

    public function fetchSportList()
    {
        $domain = $this->domain().'/sports';
        return $this->get($domain ,[
            'active' => 'true',
            'gamingType'=> 'agent',
            'lang' => 'zh_TW'
        ]);
    }
}
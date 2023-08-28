<?php

namespace Panigale\Caerus;

use Illuminate\Support\Traits\Macroable;
use Panigale\Caerus\Askables\Askable;
use Panigale\Caerus\Askables\Sport;

/**
 * Author: Panigale
 * Date: 2023/8/9
 * Time: 11:41 AM
 */
class Caerus
{
    use Macroable;

    /**
     * @var string
     */
    public $sport;

    public $league;

    public $game;
    /**
     * @var Askable
     */
    private $askable;

    public function __construct(Askable $askable)
    {
        $this->askable = $askable;
    }

    public static function fetch($str): string
    {
        return $str;
    }

    public function fetchSport(string $sport = null)
    {
        $handler = app()->make(Sport::class);

        if($sport)
            $handler->setSport($sport);

        return $handler->fetch();
    }

    public function test()
    {
        return 'test';
    }

    /**
     * @param string $slug
     * @return PendingRequest
     */
    public function sport(string $slug): PendingRequest
    {
        return (new PendingRequest($this->askable))->sport($slug);
    }

    /**
     * @param string $slug
     * @return PendingRequest
     */
    public function league(string $slug): PendingRequest
    {
        return (new PendingRequest($this->askable))->league($slug);
    }

    private function buildUrl()
    {
        $url = env('CAERUS_DOMAIN');

        if($this->sport)
            $url .= $this->sport;

        if($this->league)
            $url .= '/'.$this->league;

        if($this->game)
            $url .= '/'.$this->game;

        return $url;
    }

    public function games()
    {
    }

    /**
     * @param $id
     * @return PendingRequest
     */
    public function game($id): PendingRequest
    {
        return (new PendingRequest($this->askable))->game($id);
    }

    public function onlyMainPlay()
    {
        return (new PendingRequest($this->askable))->onlyMainPlay();
    }
}
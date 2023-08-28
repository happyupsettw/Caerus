<?php
/**
 * Author: Panigale
 * Date: 2023/8/23
 * Time: 3:27 PM
 */

namespace Panigale\Caerus;

use Panigale\Caerus\Askables\Askable;

class PendingRequest extends Askable
{
    /**
     * @var string
     */
    protected $sport;

    /**
     * @var string
     */
    protected $league;

    /**
     * @var Askable
     */
    private $askable;

    /**
     * @var int
     */
    protected $gameId;
    /**
     * @var true
     */
    private $onlyMainPlay;
    /**
     * @var true
     */
    private $trending;


    public function __construct(Askable $askable)
    {
        $this->askable = $askable;
    }

    /**
     * @param string $slug
     * @return PendingRequest
     */
    public function sport(string $slug): PendingRequest
    {
        $this->sport = $slug;

        return $this;
    }

    public function league(string $slug): PendingRequest
    {
        $this->league = $slug;

        return $this;
    }

    public function game($id): PendingRequest
    {
        $this->gameId = $id;

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function get()
    {
        $res = $this->askable->send('get' ,$this->buildUrl() ,$this->buildOptions());

        if($res->getStatusCode() !== 200)
            throw new \Exception('request fail');

        return json_decode($res->getBody()->getContents() ,true);
    }

    public function onlyMainPlay()
    {
        $this->onlyMainPlay = true;

        return $this;
    }

    public function trending()
    {
        $this->trending = true;

        return $this;
    }

    private function fill($caerue)
    {
    }

    /**
     * https://api.airsports.com.tw/sports/football?active=true&plays=2,10,12&gamingType=agent&lang=zh_TW
     *
     * https://api.airsports.com.tw/leagues/scottish-championship?activeGames=true&sortBy=date&gamingType=agent&lang=zh_TW
     *
     * https://api.airsports.com.tw/games/273090?active=true&gamingType=agent&lang=zh_TW
     *
     * @return void
     * @throws \Exception
     */
    private function buildUrl()
    {
        $url = $this->domain();

        if($this->sport && $this->league)
            throw new \Exception('sport and league can not be set at the same time');

        if($this->trending)
            $url .= '/trending/'.$this->sport;
        else if($this->sport)
            $url .= '/sports/'.$this->sport;

        if($this->league)
            $url .= '/leagues/'.$this->league;

        if($this->gameId)
            $url .= '/games/'.$this->gameId;

        if($this->onlyMainPlay)
            $url .= '?';

        if($this->onlyMainPlay)
            $url .= 'plays=2,10,12';


        return $url;
    }

    /**
     * @return array
     */
    public function buildOptions(): array
    {
        return [];
    }

    /**
     * @throws \Exception
     */
    public function url()
    {
        return $this->buildUrl();
    }

}
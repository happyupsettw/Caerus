<?php
/**
 * Author: Panigale
 * Date: 2023/8/23
 * Time: 3:27 PM
 */

namespace Panigale\Caerus;

use Panigale\Caerus\Askables\Apis;
use Panigale\Caerus\Askables\Askable;
use Panigale\Caerus\Askables\Cart;

class PendingRequest
{
    use Apis;

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

    public function sports() : PendingRequest
    {
        $this->sport = 'all';

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

    public function findOption($optionId, $handicap)
    {
        return $this->askable->find($optionId);
    }

    public function findWhereOption(array $options)
    {
        return $this->askable->findWhereOption($options);
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
     * @return string
     * @throws \Exception
     */
    private function buildUrl()
    {
        $url = $this->domain();

        if($this->sport && $this->league)
            throw new \Exception('sport and league can not be set at the same time');

        if($this->sport == 'all'){
            $url .= '/sports';
        }else{
            if($this->trending)
                $url .= '/trending/'.$this->sport;
            else if($this->sport)
                $url .= '/sports/'.$this->sport;

            if($this->league)
                $url .= '/leagues/'.$this->league.'?activeGames=true&sortBy=date';

            if($this->gameId)
                $url .= '/games/'.$this->gameId;
        }

        if(str_contains($url, '?'))
            $url.= '&';
        else
            $url.= '?';

        if($this->onlyMainPlay)
            $url .= 'plays=2,10,12';

        $url.= 'gamingType=agent&lang=zh_TW';

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
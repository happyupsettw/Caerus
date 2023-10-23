<?php
/**
 * Author: Panigale
 * Date: 2023/10/18
 * Time: 4:56 PM
 */

namespace Panigale\Caerus\Askables;

class Option extends Askable
{
    /**
     * find game play option information
     *
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function find($id)
    {
        return $this->parseJsonRes(
            $this->send('GET', $this->domain() . '/gamePlayOptions/' . $id)
        );
    }

    public function findWhereOption(array $options)
    {
        $idParams = $this->dotToUrlParams($options);
        return $this->parseJsonRes(
            $this->send(
                'GET',
                $this->domain() . '
                    /gamePlayOptions'. $idParams
            )
        );
    }

    private function dotToUrlParams(array $options)
    {
        $str = '?id=';

        foreach ($options as $option) {
            $str .= $option . ',';
        }

        return $str;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: brentheftye
 * Date: 10/02/16
 * Time: 5:21 PM
 */

namespace ceeacce;


class NumberToWordsHelper {
    private $tens = [
        30 => 'TREINTA',
        40 => 'CUARENTA',
        50 => 'CINCUENTA',
        60 => 'SESENTA',
        70 => 'SETENTA',
        80 => 'OCHENTA',
        90 => 'NOVENTA',
    ];

    private $tenths = [
        1 => 'UNO',
        2 => 'DOS',
        3 => 'TRES',
        4 => 'CUATRO',
        5 => 'CINCO',
        6 => 'SEIS',
        7 => 'SIETE',
        8 => 'OCHO',
        9 => 'NUEVE',
        10 => 'DIEZ',
        11 => 'ONCE',
        12 => 'DOCE',
        13 => 'TRECE',
        14 => 'CATORCE',
        15 => 'QUINCE',
        16 => 'DIECISEIS',
        17 => 'DIECISIETE',
        18 => 'DIECIOCHO',
        19 => 'DIECINUEVE',
        20 => 'VEINTE',
        21 => 'VEINTIUNO',
        22 => 'VEINTIDOS',
        23 => 'VEINTITRES',
        24 => 'VEINTICUATRO',
        25 => 'VEINTICINCO',
        26 => 'VEINTISEIS',
        27 => 'VEINTISIETE',
        28 => 'VEINTIOCHO',
        29 => 'VEINTINUEVE'
    ];

    private $hundreds = [
        100 =>'CIEN',
        200 =>'DOSCIENTOS',
        300=>'TRESCIENTOS',
        400=>'CUATROCIENTOS',
        500=>'QUINIENTOS',
        600=>'SEISCIENTOS',
        700=>'SETECIENTOS',
        800=>'OCHOCIENTOS',
        900 =>'NOVECIENTOS'
    ];




    /**
     * Method that returns the tenths in words.
     * @param $number
     * @return mixed
     */
    protected function tenths($number) {
        return $this->tenths[$number];
    }

    /**
     * @param $number
     * @return string
     */
    protected function tens($number) {
        if($number <= 29)//29 is considered the last tenth number, even if in math it is not.
            return tenths($number);

        $residue = $number % 10;

        if ($residue == 0)
            return $this->tens[$number];
        else
            return $this->tens[$number - $residue].' Y '. $this->tenths($residue);
    }

    /**
     * @param $number
     * @return mixed|string
     */
    protected function hundreds($number) {
        if($number >= 100)
        {
            if($number % 100 == 0)
            {
                return $this->hundreds[$number];
            }
            else
            {
                $tenths = (int) substr($number, 0, 1);
                $tens = (int) substr($number, 1, 2);
                return (($tenths == 1)? 'CIENTO' : $this->hundreds[$tenths * 100]).' '.$this->tens($tens);
            }
        } else return $this->tenths($number);
    }

    /**
     * @param $number
     * @return string
     */
    protected function thousands($number) {
        if($number > 999)
        {
            if( $number == 1000)
            {
                return 'MIL';
            }
            else
            {
                $length = strlen($number);
                $hundreds = (int)substr($number, 0, $length - 3);
                $residue = (int)substr($number, -3);
                if($hundreds == 1)
                {
                    $chain = 'MIL '.$this->hundreds($residue);
                }
                else
                {
                    if($residue != 0)
                    {
                        $chain = $this->hundreds($hundreds).' MIL '.$this->hundreds($residue);
                    }
                    else
                        $chain = $this->hundreds($hundreds). ' MIL';
                }
                return $chain;
            }
        } else return $this->hundreds($number);
    }

    /**
     * @param $number
     * @return mixed|string
     */
    public function convert($number) {
        switch (true) {
            case ($number >= 1 && $number <= 29):
                return $this->tenths($number);
                break;
            case ($number >= 30 && $number < 100):
                return $this->tens($number);
                break;
            case ($number >= 100 && $number < 1000) :
                return $this->hundreds($number);
                break;
            case ($number >= 1000 && $number <= 999999):
                return $this->thousands($number);
                break;
            default:
                return "";
                break;
        }
    }
} 
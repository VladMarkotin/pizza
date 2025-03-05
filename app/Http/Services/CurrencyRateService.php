<?php
namespace App\Http\Services;


class CurrencyRateService
{
    const USD = 431;
    # Аббривиатура валюты - например RUB, EUR, USD, ...
    const CUR_ABBREVIATION = 'Cur_Abbreviation';

    # Уникальный номер валюты - например 292 (это EUR)
    const CUR_ID = 'Cur_ID';

    # Курс валюты на сегодня (цифра)
    const CUR_OFFICIAL_RATE = 'Cur_OfficialRate';

    public $currencies;

    public function __construct()
    {
        if($jsonString = file_get_contents($_ENV['NBRB_API'])){
            $this->currencies = json_decode($jsonString, true);
        }
    }

    public function getCurrencyById($id)
    {
        foreach ($this->currencies as $currency) {
            if ($currency[self::CUR_ID] == $id){
                return array(
                    $currency[self::CUR_ABBREVIATION] => $currency[self::CUR_OFFICIAL_RATE]
                );
            }
        }

        return null;
    }
    
}
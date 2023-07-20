<?php

namespace App\Services;

use App\Models\SMS;
use App\Services\ZainService;
use App\Services\HismsService;
use App\Services\JawalyService;
use App\Services\MsegatService;
use App\Services\OursmsService;
use App\Services\GatewayService;
use App\Services\YamamahService;
use App\Services\UnifonicService;


class SmsService
{

    public function sendSms($phone, $msg)
    {
        return false;
        $key = SMS::where(['active' => 1])->first()->key;
        switch ($key) {
            case 'Yamamah':
                (new YamamahService())->send($phone, $msg);
                break;
            case 'Jawaly':
                (new JawalyService())->send($phone, $msg);
                break;
            case 'Gateway':
                (new GatewayService())->send($phone, $msg);
                break;
            case 'Hisms':
                (new HismsService())->send($phone, $msg);
                break;
            case 'Msegat':
                (new MsegatService())->send($phone, $msg);
                break;
            case 'Oursms':
                (new OursmsService())->send($phone, $msg);
                break;
            case 'Unifonic':
                (new UnifonicService())->send($phone, $msg);
                break;
            case 'Zain':
                (new ZainService())->send($phone, $msg);
                break;
        }
    }
    
}

<?php

namespace App\Models;


class Driver extends Orm
{

    protected $guarded = ['id'];

    protected $table = 'driver';

    protected $casts = [
        'options' => 'json'
    ];
    protected $appends = [
        'answer_key'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function getAnswerKeyAttribute()
    {
        $option    = $this->attributes['options'];
        $answerArr = json_decode($option);
        if (!empty($answerArr)) {
            $kk = 0;
            foreach ($answerArr as $key => $item) {
                if ($this->attributes['answer'] == substr($item, 0, 1)) {
                    $kk = $key;
                    break;
                }
            }
            return $kk;
        } else {
            return $this->attributes['answer'] == '对' ? 0 : 1;
        }

    }
}

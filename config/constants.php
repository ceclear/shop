<?php
/*
* mark
* date 2021/2/8
* time 14:44
* author zt
*/

return [
    'jwt_user_expire'         => env('JWT_USER_EXPIRE', 31536000),//默认缓存登录信息1年
    'postage_api_key'         => env('POSTAGE_DI_API_KEY'),
    'ju_he_news_key'          => env('JU_HE_NEWS_APP_KEY'),
    'ju_he_joke_key'          => env('JU_HE_JOKE_APP_KEY'),
    'ju_he_today_history_key' => env('JU_HE_TODAY_HISTORY_APP_KEY')
];

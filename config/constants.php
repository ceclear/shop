<?php
/*
* mark
* date 2021/2/8
* time 14:44
* author zt
*/

return [
    'jwt_user_expire'         => env('JWT_USER_EXPIRE', 31536000),//默认缓存登录信息1年
    'ding_dan_xia_api_key'    => env('DDX_API_KEY', 'T7pYMqMCBTPbUW9HTnenq7ndIw3jH5dB'),
    'postage_api_key'         => env('POSTAGE_DI_API_KEY'),
    'ju_he_news_key'          => env('JU_HE_NEWS_APP_KEY', 'e1dab8cc20428447e68e1efedc501cc8'),
    'ju_he_joke_key'          => env('JU_HE_JOKE_APP_KEY', 'b8a2e9246e5447d2b4c6ce4b0e638f58'),
    'ju_he_today_history_key' => env('JU_HE_TODAY_HISTORY_APP_KEY', '8162c3119c2a90b0297033397967ec76'),
    'ju_he_similar_key'       => env('JU_HE_SIMILAR_APP_KEY', 'fc447dedf8ee455122358017a64a3250'),
    'show_api_secret'         => env('SHOW_API_SECRET', 'a516401ec63841fbb29b13c91b930ff9'),
    'show_api_appid'          => env('SHOW_API_APPID', '598335')
];

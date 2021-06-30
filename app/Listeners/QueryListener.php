<?php

namespace App\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\Log;

class QueryListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param QueryExecuted $event
     */
    public function handle(QueryExecuted $event)
    {
        //
//        if (env('APP_ENV', 'production') == 'local') {
//        $sql = str_replace('?', "'%s'", $event->sql);
//        $log = vsprintf($sql, $event->bindings);
//        $this->put_log('sql', $log);
//        }

        if (config('app.env') == 'local' && config('app.debug')) {
            $sql = str_replace("?", "'%s'", $event->sql);
            $log = empty($event->bindings)?$sql:vsprintf($sql, $event->bindings);
            Log::channel('sql_daily')->info($log);
        }
    }

    private function put_log($file = 'app', $content = '')
    {
        $data     = date('Y-m-d');
        $cut_line = str_repeat("-", 100);
        is_dir(storage_path('logs/sql')) or mkdir(storage_path('logs/sql'), 0777, true); // 文件夹不存在则创建
        $content  = '[' . date('Y-m-d H:i:s') . "]" . $content;
        $fileName = $file . '-' . $data . '.log';
        if (file_exists(storage_path('logs/sql/' . $fileName))) {
            chmod(storage_path('logs/sql/' . $fileName), 0777);
        }
        @file_put_contents(storage_path('logs/sql/' . $fileName), $content . "\n" . $cut_line . "\n\n", FILE_APPEND);
    }
}

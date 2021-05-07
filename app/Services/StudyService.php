<?php


namespace App\Services;

use App\Libs\MemberRedis;
use App\Mail\StudyComplete;
use App\Models\Subtract;
use App\Traits\Errors;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class StudyService extends BaseService
{
    use Errors;

    public function levelList()
    {
        $list = [['val' => 1, 'title' => '一年级'], ['val' => 2, 'title' => '二年级']];
        return compact("list");
    }

    public function createLevel()
    {
        try {
            $count   = request('count') ?? 1;
            $rel_min = request('rel_min') ?? 1;
            $num     = 0;
            $arr     = [];
            do {
                $first    = rand(request('first_op_min'), request('first_op_max'));//第一算数项
                $second   = rand(request('second_op_min'), request('second_op_max'));//第二算数项
                $third    = rand(request('third_op_min'), request('third_op_max'));//第三算数项
                $OpArr    = request('op_str');
                $firstOp  = $OpArr[array_rand($OpArr)];
                $secondOp = $OpArr[array_rand($OpArr)];
                switch (request('step')) {
                    case 1:
                        list($val, $str) = self::createOneStr($firstOp, $first, $second, $rel_min);
                        break;
                    default:
                        list($val, $str) = self::createTwoStr($firstOp, $secondOp, $first, $second, $third, $rel_min);
                        break;
                }
                if (!empty($str) && ($val >= 0 && $val <= $rel_min) && !in_array($str, $arr) && count($arr) < $count) {
                    $arr[]  = $str;
                    $data[] = $val;
                    $num++;
                    Redis::lpush('level', $str);
                }

            } while ($num < $count);
            $column = 3;
            $every  = (int)($count / $column);
            for ($i = 0; $i <= $every; $i++) {
                for ($j = 0; $j < $column; $j++) {
                    $list[$i][] = Redis::lpop('level');
                }
            }
            return $list;
        } catch (\Exception $exception) {
            $this->setError('', '生成题目出错');
            return false;
        }

    }

    /**
     * 一步运算
     * @param $opStr1 //第一个操作符
     * @param $num1 //第一个数字
     * @param $num2 //第二个数字
     * @param $rel_min //最小结果值
     * @return array
     */
    public static function createOneStr($opStr1, $num1, $num2, $rel_min)
    {
        $val = 0;
        $str = '';
        switch ($opStr1) {
            case 1:
                $exec = self::checkValid($num1 + $num2, $rel_min, 1, 1);
                if (!$exec) {
                    break;
                }
                $val = $num1 + $num2;
                $str = $num1 . '+' . $num2;
                break;
            case 2:
                $exec = self::checkValid($num1 - $num2, $rel_min, 2, 1);
                if (!$exec) {
                    break;
                }
                $val = $num1 - $num2;
                $str = $num1 . '-' . $num2;
                break;
            case 3:
                $exec = self::checkValid($num1 * $num2, $rel_min);
                if (!$exec) {
                    break;
                }
                $val = $num1 * $num2;
                $str = $num1 . '×' . $num2;
                break;
            default:
                $exec = self::checkValid($num1 / $num2, $rel_min, 1);
                if (!$exec) {
                    break;
                }
                $val = $num1 / $num2;
                $str = $num1 . '÷' . $num2;
        }
        return [$val, $str];
    }

    /**
     * 两步运算
     * @param $opStr1 //第一个操作符
     * @param $opStr2 //第二个操作符
     * @param $num1 //第一个数字
     * @param $num2 //第二个数字
     * @param $num3 //第三个数字
     * @param $rel_min //最小结果值
     * @return array
     */
    public static function createTwoStr($opStr1, $opStr2, $num1, $num2, $num3, $rel_min)
    {
        $val = 0;
        $str = '';
        switch ($opStr1) {
            case 1:
                $exec = self::checkValid($num1 + $num2, $rel_min, 1, 1);
                if (!$exec) {
                    break;
                }
                switch ($opStr2) {
                    case 1:
                        $val = $num1 + $num2 + $num3;
                        $str = $num1 . '+' . $num2 . '+' . $num3;
                        break;
                    case 2:
                        $val = $num1 + $num2 - $num3;
                        $str = $num1 . '+' . $num2 . '-' . $num3;
                        break;
                    case 3:
                        $val = $num1 + $num2 * $num3;
                        $str = $num1 . '+' . $num2 . '×' . $num3;
                        break;
                    default:
                        $val = $num1 + $num2 / $num3;
                        $str = $num1 . '+' . $num2 . '÷' . $num3;
                        break;
                }
                break;
            case 2:
                $exec = self::checkValid($num1 - $num2, $rel_min, 2, 1);
                if (!$exec) {
                    break;
                }
                switch ($opStr2) {
                    case 1:
                        $val = $num1 - $num2 + $num3;
                        $str = $num1 . '-' . $num2 . '+' . $num3;
                        break;
                    case 2:
                        $val = $num1 - $num2 - $num3;
                        $str = $num1 . '-' . $num2 . '-' . $num3;
                        break;
                    case 3:
                        $val = $num1 - $num2 * $num3;
                        $str = $num1 . '-' . $num2 . '×' . $num3;
                        break;
                    default:
                        $val = $num1 - $num2 / $num3;
                        $str = $num1 . '-' . $num2 . '÷' . $num3;
                        break;
                }
                break;
            case 3:
                $exec = self::checkValid($num1 * $num2, $rel_min);
                if (!$exec) {
                    break;
                }
                switch ($opStr2) {
                    case 1:
                        $val = $num1 * $num2 + $num3;
                        $str = $num1 . '×' . $num2 . '+' . $num3;
                        break;
                    case 2:
                        $val = $num1 * $num2 - $num3;
                        $str = $num1 . '×' . $num2 . '-' . $num3;
                        break;
                    case 3:
                        $val = $num1 * $num2 * $num3;
                        $str = $num1 . '×' . $num2 . '×' . $num3;
                        break;
                    default:
                        $val = $num1 * $num2 / $num3;
                        $str = $num1 . '×' . $num2 . '÷' . $num3;
                        break;
                }
                break;
            default:
                $exec = self::checkValid($num1 / $num2, $rel_min, 1);
                if (!$exec) {
                    break;
                }
                switch ($opStr2) {
                    case 1:
                        $val = $num1 / $num2 + $num3;
                        $str = $num1 . '÷' . $num2 . '+' . $num3;
                        break;
                    case 2:
                        $val = $num1 / $num2 - $num3;
                        $str = $num1 . '÷' . $num2 . '-' . $num3;
                        break;
                    case 3:
                        $val = $num1 / $num2 * $num3;
                        $str = $num1 . '÷' . $num2 . '×' . $num3;
                        break;
                    default:
                        $val = $num1 / $num2 / $num3;
                        $str = $num1 . '÷' . $num2 . '÷' . $num3;
                        break;
                }
        }
        return [$val, $str];
    }


    /**
     * 比较第一个运算项与第二个运算项的结果
     * @param $exec //表达式
     * @param $max //表达式最大值
     * @param int $is_int //是否需要结果为整数
     * @param int $less //是否需要是大于0的
     * @return bool
     */
    public static function checkValid($exec, $max, $is_int = 2, $less = 2)
    {
        if ($exec > $max) {
            return false;
        }
        if ($is_int == 1 && !is_int($exec)) {
            return false;
        }
        if ($exec <= 0 && $less == 1) {
            return false;
        }
        return true;
    }

    public function apiCreateMath()
    {
        try {
            $count   = request('count') ?? 2;
            $rel_min = request('rel_min') ?? 20;
            $opStr   = request('op_str_val') ?? '1,2';
            $num     = 0;
            $arr     = [];
            $OpArr   = explode(',', $opStr);
            if (count($OpArr) > 2) {
                $this->setError('', '操作符最多选2个');
                return false;
            }
            do {
                $first  = rand(request('first_op_min') ?? 10, request('first_op_max') ?? 20);//第一算数项
                $second = rand(request('second_op_min') ?? 10, request('second_op_max') ?? 20);//第二算数项
                $third  = rand(request('third_op_min') ?? 10, request('third_op_max') ?? 20);//第三算数项

                $firstOp  = $OpArr[array_rand($OpArr)];
                $secondOp = $OpArr[array_rand($OpArr)];
                switch (request('step_val') ?? 2) {
                    case 1:
                        list($val, $str) = self::createOneStr($firstOp, $first, $second, $rel_min);
                        break;
                    default:
                        list($val, $str) = self::createTwoStr($firstOp, $secondOp, $first, $second, $third, $rel_min);
                        break;
                }
                if (!empty($str) && ($val >= 0 && $val <= $rel_min) && !in_array($str, $arr) && count($arr) < $count) {
                    $arr[] = $str;
                    $rel[] = $val;
                    $num++;
//                    Redis::lpush('level', $str);
                }

            } while ($num < $count);
            return compact("arr", "rel");
        } catch (\Exception $exception) {
            $this->setError('', '生成题目出错');
            return false;
        }

    }

    public function createSubtract()
    {
        $str = request('arr_str') ?? '';
        $arr = json_decode($str, true);
        if (empty($arr)) {
            $this->setError('', '没有数据可录入');
            return false;
        }
        DB::transaction(function () use ($arr) {
            $yes   = request('yes_num');
            $no    = request('total') - $yes;
            $subId = DB::table('subtracts')->insertGetId(['yes' => $yes, 'no' => $no, 'remind' => request('time_second'), 'rate' => request('percent'), 'user_id' => request()->uid, 'created_at' => time(), 'updated_at' => time()]);
            foreach ($arr as $item) {
                $insert[] = ['sub_id' => $subId, 'key_str' => $item['op_str'], 'enter_val' => $item['val'], 'val' => $item['hid_val'], 'created_at' => time()];
            }
            DB::table('subtract_details')->insert($insert);
            $userInfo = MemberRedis::getRedisInstance()->HGETALL(request()->uid);
            Mail::to('594652523@qq.com')->send(new StudyComplete($userInfo));
        });

        return true;
    }

    public function lists()
    {
        $userId  = request()->uid;
        $date    = request('date') ?? Carbon::today()->toDateString();
        $begin   = strtotime($date . ' 00:00:00');
        $end     = strtotime($date . ' 23:59:59');
        $page    = request('page') ?? 1;
        $size    = request('size') ?? 20;
        $offset  = ($page * $size) - $size;
        $where[] = ['user_id', '=', $userId];
        $where[] = ['subtracts.created_at', '>', $begin];
        $where[] = ['subtracts.created_at', '<', $end];
        $field   = ['key_str as op_str', 'enter_val as val', 'val as hid_val'];
        return Subtract::where($where)->join('subtract_details', 'subtract_details.sub_id', '=', 'subtracts.id')
            ->limit($size)->offset($offset)->get($field);
    }
}

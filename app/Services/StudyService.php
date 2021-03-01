<?php


namespace App\Services;

use App\Traits\Errors;
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
                        list($val, $str) = self::createOneStr($firstOp, $secondOp, $first, $second, $third, $rel_min);
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
}

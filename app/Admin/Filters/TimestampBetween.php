<?php
/**
 * TimestampBetween.php
 *
 * Created on 2020/8/26 11:01
 * Create by jiangxiaobo
 */


namespace App\Admin\Filters;


use Encore\Admin\Grid\Filter\Between;
use Illuminate\Support\Arr;

class TimestampBetween extends Between
{
    /**
     * Get condition of this filter.
     *
     * @param array $inputs
     *
     * @return mixed
     */
    public function condition($inputs)
    {
        if ($this->ignore) {
            return;
        }

        // $inputs即为传进来的参数，格式化成timestamp再去构建条件

        if (!Arr::has($inputs, $this->column)) {
            return;
        }

        $this->value = Arr::get($inputs, $this->column);

        $value = array_filter($this->value, function ($val) {
            return $val !== '';
        });

        if (empty($value)) {
            return;
        }

        if (!isset($value['start'])) {
            $value['end'] = strtotime($value['end']);//转成时间戳
            return $this->buildCondition($this->column, '<=', $value['end']);
        }

        if (!isset($value['end'])) {
            $value['start'] = strtotime($value['start']);//转成时间戳
            return $this->buildCondition($this->column, '>=', $value['start']);
        }

        $this->query = 'whereBetween';

        $value['end'] = strtotime($value['end']);//转成时间戳
        $value['start'] = strtotime($value['start']);//转成时间戳

        //return $this->buildCondition($this->column, $this->value);
        //这里需要注意$this->value的值会作用于页面reset按钮，不能直接修改这个值，否则会导致按reset回显时间戳
        return $this->buildCondition($this->column, $value);
    }
}

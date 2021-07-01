<?php
/*
* mark
* date 2021/1/29
* time 17:30
* author zt
*/

namespace App\Admin\Controllers;

use App\Admin\Filters\TimestampBetween;
use App\Models\Subtract;
use App\Models\SubtractDetail;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;


class SchoolController extends AdminController
{

    public function index(Content $content)
    {
        return $content
            ->header('作业预览')
            ->description(' ')
            ->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Subtract());
        $grid->disableRowSelector();
        $grid->model()->orderBy('id','desc');
        $grid->number('序号');
        $grid->column('member.nickname','提交人');
//        $grid->column('member.avatar','头像')->lightbox(['width' => 50, 'height' => 50]);
        $grid->column('member.openid','openid');
        $grid->column('created_at', '提交时间')->display(function ($v) {
            return $v;
        });
        $grid->column('yes', '正确数');
        $grid->column('no', '错误数');
        $grid->column('remind', '用时')->display(function ($v) {
            //计算小时数
            $remain = $v % 86400;
            $hours  = intval($remain / 3600);
            //计算分钟数
            $remain = $remain % 3600;
            $min    = intval($remain / 60);
            //计算秒数
            $secs = $remain % 60;
            return $hours . '时' . $min . '分' . $secs . '秒';
        });
        $grid->column('rate', '正确率(%)');
        $grid->column('aa', '查看详情')->modal('详情', function ($model) {
            $field = ['id', 'key_str', 'enter_val', 'val'];
            $array = SubtractDetail::where('sub_id', $model->id)->get($field)->toArray();
            if ($array) {
                foreach ($array as &$item) {
                    $item['check'] = $item['enter_val'] == $item['val'] ? '<span class="label label-success">√</span>' : '<span class="label label-danger">×</span>';
                }
                unset($item);
            }
            return new Table(['ID', '题目', '提交值', '正确答案'], $array);
        });
        $grid->rows(function ($row, $number) {
            $row->column('number', $number + 1);
        });
        $grid->disableActions();
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->column(1 / 2, function ($filter) {
                $filter->use(new TimestampBetween('Subtract.created_at', '提交时间'))->datetime();
                $filter->group('rate','正确率', function ($group) {
                    $group->gt('大于');
                    $group->lt('小于');
                    $group->nlt('不小于');
                    $group->ngt('不大于');
                    $group->equal('等于');
                });
            });
            $filter->column(1 / 2, function ($filter) {
                $filter->like('member.nickname','提交人');
                $filter->group('remind','用时(秒)', function ($group) {
                    $group->gt('大于');
                    $group->lt('小于');
                    $group->nlt('不小于');
                    $group->ngt('不大于');
                    $group->equal('等于');
                });
            });

        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ExampleModel::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ExampleModel);

        $form->display('id', __('ID'));
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        return $form;
    }

    public function subtractDetail(Content $content)
    {
        $grid = new Grid(new SubtractDetail());
        $grid->disableRowSelector();
        $grid->column('key_str', '题目');
        $grid->column('enter_val', '提交值');
        $grid->column('val', '正确答案');
        $grid->column('check', '是否正确')->display(function () {
            return $this->enter_val == $this->val ? '正确' : '错误';
        })->label(['正确' => 'success', '错误' => 'danger']);
        $grid->disableActions();
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->equal('sub_id', '编号');
        });
        return $content
            ->header('作业详情')
            ->description(' ')
            ->body($grid);
    }
}

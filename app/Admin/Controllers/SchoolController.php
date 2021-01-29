<?php
/*
* mark
* date 2021/1/29
* time 17:30
* author zt
*/

namespace App\Admin\Controllers;


use App\Models\SubtractDetail;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

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
        $grid = new Grid(new SubtractDetail());
        $grid->disableRowSelector();
        $grid->model()->selectRaw("sub_id,
                 sum(case when enter_val=val then 1 else 0 end) AS 'yes',
                 sum(case when enter_val!=val then 1 else 0 end) AS 'no'
                 ")
            ->groupBy('sub_id');
        $grid->number('序号');

        $grid->rows(function ($row, $number) {
            $row->column('number', $number + 1);
        });
        $grid->column('sub_id', '提交序号');
        $grid->column('account', '想法')->display(function () {
            return "<a href='/admin/account?store_id=" . $this->id . "'>查看详情</a>";
        });
        $grid->disableActions();
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
}

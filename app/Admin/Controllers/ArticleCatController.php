<?php
/*
* mark
* date 2021/1/29
* time 17:30
* author zt
*/

namespace App\Admin\Controllers;

use App\Admin\Filters\TimestampBetween;
use App\Models\ArticleCat;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;


class ArticleCatController extends AdminController
{

    public function index(Content $content)
    {
        return $content
            ->header('文章分类列表')
            ->description(' ')
            ->body($this->grid());
    }

    public function create(Content $content)
    {
        return $content
            ->header('创建分类')
            ->description()
            ->body($this->form());
    }

    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑')
            ->description(trans('admin.description'))
            ->body($this->form()->edit($id));
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ArticleCat());
        $grid->disableRowSelector();
        $grid->column('id', 'ID');
        $grid->column('name', '分类名称');
        $grid->column('icon', '图标')->lightbox(['width' => 30, 'height' => 30]);
        $grid->column('sort', '排序');
        $grid->column('url', '链接')->link();
        $grid->column('status', '状态')->display(function ($v) {
            return ArticleCat::Status[$v];
        })->label(['danger', 'primary']);
        $grid->column('created_at', '创建时间')->date();
        $grid->column('updated_at', '更新时间')->date();
        $grid->actions(function ($actions) {
            // 去掉查看
            $actions->disableview();
        });
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->use(new TimestampBetween('created_at', '提交时间'))->datetime();
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
        $show = new Show(ArticleCat::findOrFail($id));

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
        $form   = new Form(new ArticleCat());
        $form->display('id', __('ID'));
        $form->text('name', '分类名称')->required();
        $form->image('icon', '图标')->uniqueName();
        $form->number('sort', '排序')->default(1);
        $form->url('url', '链接');
        $form->switch('status', '状态')->default(1);
        return $form;
    }

}

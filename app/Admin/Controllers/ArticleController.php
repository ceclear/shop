<?php
/*
* mark
* date 2021/1/29
* time 17:30
* author zt
*/

namespace App\Admin\Controllers;

use App\Admin\Filters\TimestampBetween;
use App\Models\Article;
use App\Models\ArticleCat;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;


class ArticleController extends AdminController
{

    public function index(Content $content)
    {
        return $content
            ->header('文章列表')
            ->description(' ')
            ->body($this->grid());
    }

    public function create(Content $content)
    {
        return $content
            ->header('创建文章')
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
        $grid = new Grid(new Article());
        $grid->disableRowSelector();
        $grid->column('id', 'ID');
        $grid->column('catInfo.name', '分类');
        $grid->column('title', '文章标题');
        $grid->column('image', '封面图')->lightbox(['width' => 130, 'height' => 130]);
        $grid->column('author', '作者');
        $grid->column('praise', '点赞数量');
        $grid->column('sort', '排序');
        $grid->column('pub_time', '发布时间');
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
        $form = new Form(new Article());
        $form->display('id', __('ID'));
        $form->select('article_cat_id', '分类')->options(ArticleCat::all()->pluck('name', 'id'))->required();
        $form->text('title', '文章标题')->required();
        $form->image('image', '封面图')->uniqueName();
        $form->number('sort', '排序')->default(1);
        $form->number('praise', '点赞数量')->default(1);
        $form->text('author', '作者');
        $form->datetime('pub_time', '发布时间');
        $form->editor2('content');
        $form->switch('status', '状态')->default(1);
        return $form;
    }

}

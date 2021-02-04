<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\EnableRow;
use App\Http\Controllers\Controller;
use App\Models\AdPosition;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;


class AdPositionController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('广告位设置')
            ->description(trans('admin.description'))
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header(trans('admin.detail'))
            ->description(trans('admin.description'))
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header(trans('admin.edit'))
            ->description(trans('admin.description'))
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header(trans('admin.create'))
            ->description(trans('admin.description'))
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AdPosition());
        $grid->disableRowSelector();
        $grid->id('ID');
        $grid->name('广告位名称');
        $grid->symbol('广告位标识');
        $grid->sort('排序');
        $grid->status('状态')->switch();
        $grid->column('account', '广告列表')->display(function () {
            return "<a href='/admin/advert?pos_id=" . $this->id . "'>广告列表</a>";
        });
        $grid->created_at(trans('admin.created_at'));
        $grid->updated_at(trans('admin.updated_at'));
        $grid->actions(function ($actions) {
            $actions->disableView();
//            $actions->disableDelete();
        });
        $grid->disableFilter();
        $grid->disableExport();
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
        $show = new Show(AdPosition::findOrFail($id));

        $show->id('ID');
        $show->rate('rate');
        $show->status('status');
        $show->created_at(trans('admin.created_at'));
        $show->updated_at(trans('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AdPosition());

        $form->display('id', 'ID');
        $form->text('name', '广告位名称')->required();
        $form->text('symbol', '广告位标识')->creationRules(['required', "unique:ad_positions,symbol,{{id}}"])->required();
        $form->number('sort', '排序')->min(1)->default(1);
        $form->switch('status', '状态');
        return $form;
    }
}

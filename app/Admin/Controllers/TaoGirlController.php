<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdPosition;
use App\Models\Advert;
use App\Models\Goods;
use App\Models\TaoGirl;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Http\Request;


class TaoGirlController extends Controller
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
            ->header('列表')
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
        $grid = new Grid(new TaoGirl());
        $grid->disableRowSelector();
        $grid->id('ID');
        $grid->column('avatarUrl', '头像')->lightbox(['width' => 50, 'height' => 50]);
        $grid->column('cardUrl', '封面')->lightbox(['width' => 50, 'height' => 50]);
        $grid->city('城市');
        $grid->height('身高');
        $grid->weight('体重');
        $grid->column('imgList', '图片列表')->lightbox(['width' => 50, 'height' => 50]);
        $grid->realName('真实姓名');
        $grid->totalFanNum('粉丝数');
        $grid->totalFavorNum('总粉丝');
        $grid->userId('UserID');
        $grid->column('link', '链接')->link();
        $grid->column('type', '分类');
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
        $form = new Form(new Goods());

        $form->display('id', 'ID');
        $form->select('skip_type', '跳转类型')->options(Advert::SKIP_TYPE)->required();
        $form->text('product_id', '数据ID')->attribute('placeholder="只有APP内部跳转才填"');
        $form->text('name', 'name')->attribute('placeholder="可不填"');

        $form->image('img_url', '图片')->required();
        $form->url('url', '跳转链接')->required();
        $form->number('sort', '排序')->default(1)->min(1);
        $form->color('bg_color', '背景色')->placeholder('可不填')->attribute(['autocomplete' => 'off']);
        $form->switch('status', '状态')->default(1);
//        $form->display('created_at', trans('admin.created_at'));
//        $form->display('updated_at', trans('admin.updated_at'));
        return $form;
    }

    /**
     * 更改状态
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request)
    {
        $id    = $request->input('id', 0);
        $value = $request->input('value', 0);
        $rel   = Advert::where('id', $id)->update(['status' => $value]);
        if ($rel)
            return $this->responseJson(1);
        return $this->responseJson(0);
    }


}

<?php
/*
* mark
* date 2020/12/30
* time 17:19
* author zt
*/

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Services\ToolService;
use App\Traits\ResponseJson;

class ToolController extends Controller
{
    use ResponseJson;

    protected $toolService;

    /**
     * ToolController constructor.
     * @param ToolService $toolService
     */
    public function __construct(ToolService $toolService)
    {
        $this->toolService = $toolService;
    }

    public function searchMobile()
    {
        $rel = $this->toolService->searchMobile();
        if ($rel === false) {
            return $this->responseJson(1, $this->toolService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);
    }

    public function Postage()
    {
        $rel = $this->toolService->postage();
        if ($rel === false) {
            return $this->responseJson(1, $this->toolService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);
    }

    public function Similar()
    {
        $rel = $this->toolService->Similar();
        if ($rel === false) {
            return $this->responseJson(1, $this->toolService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);
    }

    public function TodayList()
    {
        $rel = $this->toolService->today();
        if ($rel === false) {
            return $this->responseJson(1, $this->toolService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);
    }

    public function TodayDetail()
    {
        $rel = $this->toolService->todayDetail();
        if ($rel === false) {
            return $this->responseJson(1, $this->toolService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);
    }

    public function foodList()
    {
        $rel = $this->toolService->foodList();
        if ($rel === false) {
            return $this->responseJson(1, $this->toolService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);
    }

    public function foodDetail()
    {
        $rel = $this->toolService->foodDetail();
        if ($rel === false) {
            return $this->responseJson(1, $this->toolService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);
    }
}

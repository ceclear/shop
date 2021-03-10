<?php
/*
* mark
* date 2020/12/30
* time 17:19
* author zt
*/

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Services\StudyService;
use App\Traits\ResponseJson;

class StudyController extends Controller
{
    use ResponseJson;

    protected $studyService;

    /**
     * StudyController constructor.
     * @param StudyService $studyService
     */
    public function __construct(StudyService $studyService)
    {
        $this->studyService = $studyService;
    }

    public function createMath()
    {
        $rel = $this->studyService->apiCreateMath();
        if ($rel === false) {
            return $this->responseJson(1, $this->studyService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);
    }

}

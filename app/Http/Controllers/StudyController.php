<?php
/*
* mark
* date 2020/12/30
* time 17:19
* author zt
*/

namespace App\Http\Controllers;


use App\Http\Requests\CreateLevel;
use App\Services\StudyService;
use App\Traits\ResponseJson;
use Spipu\Html2Pdf\Html2Pdf;

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

    public function index()
    {
        return view('Study.index');
    }

    public function level()
    {
        $rel = $this->studyService->levelList();
        if ($rel === false) {
            return $this->responseJson(1, $this->studyService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);
    }

    public function detail(CreateLevel $createLevel)
    {
        $list = $this->studyService->createLevel();
        if ($list === false) {
            return view('Study.index')->withErrors($this->studyService->getFirstError());
        }
        $html2pdf = new Html2Pdf();
        $html     = "<style>
        html, body {
        background-color: #fff;
        color: #636b6f;

        font-weight: 600;
        height: 100vh;

        }

        table.gridtable {

        font-size: 28px;
        color: #333333;
        border-width: 1px;
        border-color: #666666;
        border-collapse: collapse;
        }

        table.gridtable th {
        border-width: 1px;
        padding: 3px 3px;
        border-style: solid;
        border-color: #666666;
        background-color: #dedede;
        }

        table.gridtable td {
        border-width: 1px;
        padding: 8px;
        border-style: solid;
        border-color: #666666;
        background-color: #ffffff;
        text-align: center;
        }

        .answer-input {
        padding: 8px;
        }
        </style>";
        $html     .= '<table class="gridtable">';
        $html     .= '<tr><th>expression</th><th>answer</th><th>expression</th><th>answer</th><th>expression</th><th>answer</th></tr>';
//        dd($list);
        foreach ($list as $item) {
            $html .= '<tr>';
            foreach ($item as $value) {
                $html .= '<td>' . $value . '</td>';
                $html .= '<td></td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table>';
        $html2pdf->writeHTML($html);
        $html2pdf->output();
    }

}

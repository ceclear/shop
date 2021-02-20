<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Traits\ResponseJson;

class OrderController extends Controller
{

    use ResponseJson;

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function orderCheckout()
    {
        $rel = $this->orderService->orderCheckOut();
        if ($rel === false) {
            return $this->responseJson(1, $this->orderService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);
    }

}

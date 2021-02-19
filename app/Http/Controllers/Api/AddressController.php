<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddAddress;
use App\Services\AddressService;
use App\Traits\ResponseJson;

class AddressController extends Controller
{

    use ResponseJson;

    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function lists()
    {
        $rel = $this->addressService->lists();
        return $this->responseJson(0, '', $rel);
    }

    public function add(AddAddress $addAddress)
    {
        $rel = $this->addressService->add();
        return $this->responseJson(0, '', $rel);
    }
}

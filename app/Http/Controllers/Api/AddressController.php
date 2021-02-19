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
        $rel = $this->addressService->add($addAddress);
        return $this->responseJson(0, '', $rel);
    }

    public function edit(AddAddress $addAddress)
    {
        $rel = $this->addressService->save($addAddress);
        if ($rel === false) {
            return $this->responseJson(1, $this->addressService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);
    }

    public function info()
    {
        $rel = $this->addressService->info();
        if ($rel === false) {
            return $this->responseJson(1, $this->addressService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);
    }

    public function delete()
    {
        $rel = $this->addressService->delete();
        if ($rel === false) {
            return $this->responseJson(1, $this->addressService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);
    }
    public function setDefault()
    {
        $rel = $this->addressService->setDefault();
        if ($rel === false) {
            return $this->responseJson(1, $this->addressService->getFirstError());
        }
        return $this->responseJson(0, '', $rel);
    }

}

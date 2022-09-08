<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Http\Resources\CarCollection;
use App\Http\Resources\CarResource;

class CarsManagerController extends Controller
{
    public $repository;

    public function __construct()
    {
        /* Inject repository */
        $this->injectRepository();
    }

    public function index()
    {
        return new CarCollection($this->repository->getReportVehicles());
    }

    public function getReturnVehicles()
    {
        return new CarCollection($this->repository->getMoreUseClients());
    }

    public function store(CarRequest $request)
    {
        $this->injectRepository($request->type);
        return new CarResource($this->repository->registerVehicleIn($request));
    }

    public function update(string $id)
    {
        $this->injectRepository($this->repository->getLastVehicle($id)->type);
        return new CarResource($this->repository->registerVehicleOut($id));
    }

    public function destroy(string $id)
    {
        $this->repository->delete($id);

        return $this->responseOk([
            'action' => 'delete',
            'message' => 'Successfull'
        ]);
    }
}

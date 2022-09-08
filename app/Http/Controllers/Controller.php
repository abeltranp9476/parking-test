<?php

namespace App\Http\Controllers;

use App\Repositories\BaseRepository;
use App\Repositories\CarRepository;
use App\Repositories\TruckRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /* Return response */
    public function responseOk($response)
    {
        return response()->json([
            'data' => $response
        ]);
    }

    /* Inject repository on demand */
    public function injectRepository($type = null)
    {
        if ($type === null) $this->repository = new BaseRepository();
        if ($type === 'car') $this->repository = new CarRepository();
        if ($type === 'truck') $this->repository = new TruckRepository();
    }
}

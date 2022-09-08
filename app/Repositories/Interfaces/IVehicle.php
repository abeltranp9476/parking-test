<?php

namespace App\Repositories\Interfaces;

use Jenssegers\Mongodb\Eloquent\Model;


interface IVehicle extends IBase
{
    public function registerVehicleIn($request);

    public function registerVehicleOut(string $vehicleId);
}

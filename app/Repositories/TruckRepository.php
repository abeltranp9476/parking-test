<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IVehicle;
use Carbon\Carbon;

class TruckRepository extends BaseRepository implements IVehicle
{
    protected $repository;
    protected $price_per_min = 1;

    public function registerVehicleIn($request)
    {
        return $this->create([
            'type' => $request->type,
            'matricula' => $request->matricula,
            'price_per_min' => $this->price_per_min,
            'in_at' => Date(now()),
        ]);
    }

    public function registerVehicleOut(string $vehicleId)
    {
        $now = now();
        $car = $this->getLastVehicle($vehicleId);
        $start = Carbon::createFromTimeString($car->in_at);
        $end = Carbon::createFromTimeString($now);
        $minutesDiff = $start->diffInMinutes($end, false);

        $car->min_total = $minutesDiff;
        $car->out_at = Date($now);
        $car->price_total = $car->price_per_min * $minutesDiff;
        $car->update();

        return  $car;
    }
}

<?php

namespace App\Repositories;

use App\Models\Vehicle;
use App\Repositories\Interfaces\IBase;
use Illuminate\Support\Facades\DB;

class BaseRepository implements IBase
{
    protected $repository;
    protected $vehiclesPerPage = 20;

    public function __construct()
    {
        $this->repository = new Vehicle();
    }

    public function find(string $vehicleId)
    {
        return $this->repository->find($vehicleId);
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function paginate($perPage)
    {
        return $this->repository->paginate($perPage);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        $car = $this->repository->find($id);
        $car->update($data);
    }

    public function delete(string $id)
    {
        $car = $this->repository->find($id);
        $car->delete();
    }

    public function getReportVehicles()
    {
        return $this->repository::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$project' => [
                        'created_at' => 1,
                        'matricula' => 1,
                        'price_total' => 1,
                        'min_total' => 1,
                    ]
                ],
                [
                    '$group' => [
                        '_id' => '$matricula',
                        'price_total' => ['$sum' => '$price_total'],
                        'min_total' => ['$sum' => '$min_total'],
                    ]
                ],
                [
                    '$sort' => ['_id' => -1]
                ]
            ]);
        });
    }

    public function getMoreUseClients()
    {
        return $this->repository::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$group' => [
                        '_id' => '$matricula',
                        'min_total' => ['$sum' => '$min_total'],
                    ]
                ],
                [
                    '$sort' => ['min_total' => -1]
                ],
                [
                    '$limit' => 3
                ]
            ]);
        });
    }

    public function getLastVehicle(string $matricula)
    {
        return $this->repository->where('matricula', $matricula)
            ->orderBy('created_at', 'Desc')
            ->first();
    }
}

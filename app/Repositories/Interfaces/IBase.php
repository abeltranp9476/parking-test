<?php

namespace App\Repositories\Interfaces;

use Jenssegers\Mongodb\Eloquent\Model;


interface IBase
{
    public function find(string $vehicleId);

    public function all();

    public function paginate($perPage);

    public function create(array $data);

    public function update($id, array $data);

    public function delete(string $id);

    public function getReportVehicles();

    public function getMoreUseClients();

    public function getLastVehicle(string $matricula);
}

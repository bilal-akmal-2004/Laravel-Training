<?php

namespace App\Services;

use App\Models\Venue;
use App\Services\Contracts\VenueServiceContract;

class VenueService implements VenueServiceContract
{
    public function paginate(int $perPage=20)
    {
        return Venue::paginate($perPage);
    }

    public function create(array $data)
    {
        return Venue::create($data);
    }

    public function update(Venue $venue, array $data)
    {
        $venue->update($data);

        return $venue;
    }

    public function delete(Venue $venue)
    {
        return $venue->delete();
    }
}
<?php

namespace App\Services\Contracts;

use App\Models\Venue;

interface VenueServiceContract
{
    public function paginate(int $perPage=20);

    public function create(array $data);

    public function update(Venue $venue, array $data);

    public function delete(Venue $venue);
}
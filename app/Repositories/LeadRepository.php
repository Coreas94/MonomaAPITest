<?php

namespace App\Repositories;

use App\Models\Lead;

class LeadRepository
{
    public function all()
    {
        return Lead::all();
    }

    public function find($id)
    {
        return Lead::find($id);
    }

    public function create($data)
    {
        return Lead::create($data);
    }
}

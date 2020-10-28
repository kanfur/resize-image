<?php

namespace App\Models\Http;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status
{
    const CODE = [
        "Success" => 200,
        "New Record" => 201,
        "Bad Request" => 400,
        "Unauthorized" => 401,
        "Forbidden" => 403,
        "Not Found" => 404,
        "Internal Server Error" => 500
    ];
}

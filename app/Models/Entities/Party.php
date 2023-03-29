<?php

namespace App\Models\Entities;

use CodeIgniter\Entity\Entity;

class Party extends Entity
{
    // ...
    protected $attributes = [
        'id' => null,
        'partyname' => null,
        // In the $attributes, the key is the db column name
        'city' => null,
        'contactperson' => null,
        'contactnumber' => null,
        'create_time' => null,
        'update_time' => null,
    ];

    protected $datamap = [
        // property_name => db_column_name
        'name' => 'partyname',
        'shahar' => 'city',
        'contact' => 'contactperson',
    ];
}
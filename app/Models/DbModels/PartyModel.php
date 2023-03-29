<?php


namespace App\Models\DbModels;

use CodeIgniter\Model;

class PartyModel extends Model
{
    protected $table = 'partymaster';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = \App\Models\Entities\Party::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['partyname', 'city', 'contactperson', 'contactnumber'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'create_time';
    protected $updatedField = 'update_time';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
}
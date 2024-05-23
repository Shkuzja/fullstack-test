<?php

namespace App\Models;

use CodeIgniter\Model;

class Comments extends Model
{
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['created_at', 'email', 'content'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'content' => 'required|string',
        'created_at' => 'valid_date',
        'email' => 'required|string|max_length[255]|valid_email',
    ];

    protected $validationMessages = [
        'content' => [
            'required' => 'Необходимо заполнить поле',
            'string' => 'Значение должно быть строкой.',
        ],
        'created_at' => [
            'valid_date' => 'Не верный формат даты.',
        ],
        'email' => [
            'min_length' => 'Минимальное допустимое количество символов.',
            'required' => 'Необходимо заполнить поле',
            'valid_email' => 'Некорректный адрес электронной почты.',
            'string' => 'Значение должно быть строкой.',
            'max_length' => 'Превышено максимально допустимое количество символов.',
        ],

    ];
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

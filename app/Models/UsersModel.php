<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $returnType       = 'object';
    protected $allowedFields    = ['username', 'password', 'level'];

    public function getUser($data)
    {
        $query = $this->db->table('users')->getWhere(['username'    => $data['username']]);
        return $query->getRow();
    }
}

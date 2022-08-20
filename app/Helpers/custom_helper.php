<?php

function userLogin()
{
    $db = \Config\Database::connect();
    return $db->table('users')->where('id_user', session('id_user'))->get()->getRow();
}

function countData($table)
{
    $db = \Config\Database::connect();
    return $db->table($table)->countAllResults();
}
 
function countDataByStatus($req, $id_user = null)
{
    $db = \Config\Database::connect();
    $status = "";
    $where = "";
    $builder = $db->table('peminjaman');

    if ($req == "acc") {
        $status = "telah disetujui";
    } else if ($req == "ditolak") {
        $status = "peminjaman ditolak";
    } else {
        if (is_null($id_user)) {
            $where = "kode_status IS NULL OR ( kode_status != 'telah disetujui' AND kode_status != 'peminjaman ditolak' ) ";
        } else {
            $where = "id_user = " .$id_user. " AND (kode_status IS NULL OR ( kode_status != 'telah disetujui' AND kode_status != 'peminjaman ditolak' )) ";
        }
        return $builder->where($where)->countAllResults();
    }

    if (is_null($id_user)) {
        $builder->where('kode_status', $status);
    } else {
        $builder->where('id_user', $id_user)
                ->where('kode_status', $status);
    }

    return $builder->countAllResults();
}

function countRuangan()
{
    $db = \Config\Database::connect();
    return $db->table('ruangan')->countAllResults();
}

function countJadwal()
{
    $db = \Config\Database::connect();
    return $db->table('jadwal')->join('peminjaman', 'peminjaman.id_peminjaman = jadwal.id_peminjaman')->countAllResults();
}


function countPeminjamanById($id)
{
    $db = \Config\Database::connect();
    return $db->table('peminjaman')->where('id_user', $id)->countAllResults();
}


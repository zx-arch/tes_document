<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDocumentModel extends Model
{
    use SoftDeletes;
    protected $table = 'user_document';
    protected $fillable = [
        'id',
        'username',
        'nama_document',
        'jenis_document',
        'file'
    ];
    protected $hidden = [];

    public static function getSKPTDocumentsForUser($username, $jenis_document)
    {
        return self::where('username', $username)
            ->where('jenis_document', $jenis_document)
            ->get();
    }
    public static function getAll($username)
    {
        return self::where('username', $username)
            ->get();
    }

}
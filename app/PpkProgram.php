<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PpkProgram extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ppk_layout_id', 'target_kinerja', 'deskripsi', 'anggaran_program', 'indikator_program', 'target_program'
    ];

    public function data_indikator()
    {
        return $this->hasMany('App\PpkIndikatorProgram', 'ppk_program_id', 'id');
    }
}

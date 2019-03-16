<?php
namespace fge\nucc\models;
use Illuminate\Database\Eloquent\Model;
use App;

class ConfigNucModel extends Model
{
    protected $table='nuc_config';

    protected $fillable = ['clave', 'fge_url_nuc'];
}

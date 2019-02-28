<?php
namespace fge\nucc\models;
use Illuminate\Database\Eloquent\Model;
use App;

class ConfigNucModel extends Model
{
    protected $table='config_nuc';

    protected $fillable = ['clave', 'fge_url_nuc'];
}

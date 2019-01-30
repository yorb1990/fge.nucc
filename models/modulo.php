<?php
namespace fge\nucc\models;
use Illuminate\Database\Eloquent\Model;
use App;
class moduloModel extends Model
{
    protected $table='modulos';

    protected $fillable = ['name', 'prefix', 'ip'];

    public function setNameAttriubute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function setPrefixAttriubute($value)
    {
        $this->attributes['prefix'] = strtoupper($value);
    }
    
}
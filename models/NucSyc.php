<?php
namespace fge\nucc\models;
use Illuminate\Database\Eloquent\Model;
use App;

class NucSycModel extends Model
{
    protected $table='nuc_syc';

    protected $fillable = ['carpeta', 'nuc', 'cvv', 'acuerdo'];
}
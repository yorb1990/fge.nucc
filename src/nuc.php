<?php
namespace fge\nucc\src;
class nuc extends token{
    protected $prefix="";
    protected $year="";
    public $nuc='';
    public $cvv='';
    function __construct(){
        $this->l=6;
    }
    public function nnuc($prefix,$year){
        $this->prefix=$prefix;
        $this->year=$year;
        $this->l=6;
    }
    public function nuccvv($nuc,$cvv){
        $token=explode('-',$nuc);
        $this->nuc=$token[1];
        $this->t=$token[1];
        $this->prefix=$token[0];
        $this->year=$token[2];
        $this->cvv=$cvv;
        $this->c=$this->cvv;
        $this->l=6;
    }
    public function IsValid(&$error){                
        return $this->valited($error);
    }
}
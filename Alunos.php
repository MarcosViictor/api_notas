<?php 

class Alunos{

    protected $id;
    protected $nome;
    protected $avp1;
    protected $avp2;
    protected $media;

    public function __construct($nome, $avp1, $avp2)
    {
        $this->nome = $nome;
        $this->avp1 = $avp1;
        $this->avp2 = $avp2;
    }

    public function getId(){
        return $this->id;
    }
    public function getNome(){
        return $this->nome;
    }

    public function getAvp1(){
        return $this->avp1;
    }

    public function getAvp2(){
        return $this->avp2;
    }

    public function getMedia(){
        return $this->media;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setAvp1($avp1){
        $this->avp1 = $avp1;
    }

    public function setAvp2($avp2){
        $this->avp2 = $avp2;
    }

    public function setMedia($media){
        $this->media = $media;
    }

    public function setid($id){
        $this->id = $id;
    }
    public function calcularMedia() {
        if (is_numeric($this->avp1) && is_numeric($this->avp2)) {
            $this->media = ($this->avp1 + $this->avp2) / 2;
        } else {
            throw new Exception('Valores de AVP1 e AVP2 devem ser numéricos.');
        }
    }
}




?>
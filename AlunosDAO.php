<?php 
require_once('conexao.php');
require_once('Alunos.php');

class AlunosDao{
    public function create(Alunos $alunos){
        $sql = 'INSERT INTO notas_alunos (nome, avp1, avp2, media) VALUES (?,?,?,?)';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $alunos->getNome());
        $stmt->bindValue(2, $alunos->getAvp1());
        $stmt->bindValue(3, $alunos->getAvp2());
        $stmt->bindValue(4, $alunos->getMedia());
        $stmt->execute();
    }

    public function read($id){
        $sql = 'SELECT * FROM notas_alunos WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $id); 
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return [];
        }
    }
    

    public function update(Alunos $alunos){
        $alunos->calcularMedia();
        $sql = 'UPDATE notas_alunos SET nome = ?, avp1 = ?, avp2 = ?, media = ? WHERE id = ?';
    
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $alunos->getNome());
        $stmt->bindValue(2, $alunos->getAvp1());
        $stmt->bindValue(3, $alunos->getAvp2());
        $stmt->bindValue(4, $alunos->getMedia());
        $stmt->bindValue(5, $alunos->getId());
    
        $stmt->execute();
    }
    
    public function delete(Alunos $alunos) {
        $sql = 'DELETE FROM notas_alunos WHERE id = ?';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1, $alunos->getId());
        $stmt->execute();
    }


    public function VerTodosAlunos(){
        $sql = 'SELECT * FROM notas_alunos';
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return [];
        }
    }

}


?>
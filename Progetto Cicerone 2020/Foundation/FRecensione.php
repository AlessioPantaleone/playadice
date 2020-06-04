<?php


class FRecensione
{

    static function searchRecensioneByIdGioco() : string
    {
        return "SELECT *
                FROM recensione
                WHERE IdGioco=:IdGioco;";
    }

    static function storeRecensione() : string
    {
        return "INSERT INTO recensione(Creatore, IdGioco,Voto,Commento)
				VALUES(:Creatore, :IdGioco, :Voto, :Commento);";
    }

    static function removeRecensione() : string
    {
        return "DELETE 
                FROM recensione
                WHERE IdGioco = :IdGioco AND Creatore=:Creatore;";

    }


    static function bindValues(PDOStatement &$stmt, ERecensione &$recensione)
    {
        $result = var_export($stmt, true);

        if( strpos( $result, ":Creatore" ) !== false)
            $stmt->bindValue(':Creatore', $recensione->getEUtente()->getUsername(), PDO::PARAM_STR);
        if( strpos( $result, ":IdGioco" ) !== false)
            $stmt->bindValue(':IdGioco', $recensione->getEGioco()->getId(), PDO::PARAM_INT);
        if( strpos( $result, ":Voto" ) !== false)
            $stmt->bindValue(':Voto', $recensione->getVoto(), PDO::PARAM_STR);
        if( strpos( $result, ":Commento" ) !== false)
            $stmt->bindValue(':Commento', $recensione->getCommento(), PDO::PARAM_STR);

    }

    static function createObjectFromRow($row)
    {


        $recensione = new ERecensione();

        if ( ($row['Creatore']) != null )
        {
            $Pippo = FPersistantManager::getInstance()->search("Utente","UserName",($row['Creatore']));
            $recensione->setEUtente($Pippo[0]);
        }
        $recensione->setVoto($row['Voto']);
        $recensione->setCommento($row['Commento']);

        //$Pippo = FPersistantManager::getInstance()->search("Gioco","Id",($row['IdGioco']));
        //$recensione->setEGioco($Pippo[0]);
        return $recensione;
    }
}
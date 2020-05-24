<?php

/**
 * Lo scopo di questa classe e' quello di fornire un accesso unico al DBMS, incapsulando
 * al proprio interno i metodi statici di tutte le altre classi Foundation, cosi che l'accesso
 * ai dati persistenti da parte degli strati superiore dell'applicazione sia piu' intuitivo.
 * @author gruppo 2
 * @package Foundation
 */

class FPersistantManager
{

    /** l'unica istanza della classe */
    private static $instance = null;
    /** oggetto PDO che effettua la connessione al dbms */
    private $db;

    /***********************************    METODI DI INIZIALIZZAZIONE     *********************************/

    /**
     * Inizializza un oggetto FPersistantManager. Metodo privato per evitare
     * duplicazioni dell'oggetto.
     */
    private function __construct()
    {
        try {
            global $address, $admin, $pass, $database;
            //$this->db = new PDO ("mysql:host=$address;dbname=$database", $admin, $pass); //TODO  MODIFY
            $this->db = new PDO ("mysql:host=127.0.0.1;dbname=playadice", "root"); //TODO  MODIFY

        } catch (PDOException $e) {
            echo "Errore : " . $e->getMessage();
            die;
        }
    }

    /**
     * Metodo che chiude la connessione al dbms.
     */
    function __destruct()
    {
        $this->db = null;
        static::$instance = null;
    }

    /**
     * Metodo reso privato per evitare la clonazione dell'oggetto.
     */
    private function __clone()
    {
    }

    /**
     * Metodo che restituisce l'unica istanza dell'oggetto.
     * @return FPersistantManager l'istanza dell'oggetto.
     */
    static function getInstance(): FPersistantManager
    {
        if (static::$instance == null) {
            static::$instance = new FPersistantManager();
        }
        return static::$instance;
    }

    /****************************************** SEARCH **************************************************/

    /**
     * Effettua una ricerca sul database secondo vari parametri. Tale metodo e' scaturito a seguito
     * di una ricerca da parte dell'utente, puo' essere relativa a canzoni o musicisti secondo diversi
     * parametri, come nome o genere musicale.
     * @param string $key la table da cui prelevare i dati
     * @param string $value il valore per cui cercare i valori
     * @param string $str il dato richiesto dall'utente
     * @return array|NULL i risultati ottenuti dalla ricerca. Se la richiesta non ha match, ritorna NULL.
     */
    function search(string $key, string $value, string $str)
    {
        $sql = '';
        $className = 'F'.$key;

        if(class_exists($className))
        {
            $method = 'search'.$key.'By'.$value;
            if(method_exists($className, $method))
                $sql = $className::$method();
        }


        if($sql)
            return $this->execSearch('F'.$key, $value, $str, $sql);
        else return NULL;
    }

    private function execSearch(string $className, string $value, string $str, string $sql)
    {
        try
        {
            $stmt = $this->db->prepare($sql); // creo PDOStatement
            $stmt->bindValue(":".$value, $str, PDO::PARAM_STR);
            $stmt->execute();   //viene eseguita la query
            $stmt->setFetchMode(PDO::FETCH_ASSOC); // i risultati del db verranno salvati in un array con indici le colonne della table

            $obj = NULL; // l'oggetto di ritorno viene definito come NULL

            while($row = $stmt->fetch())
            { // per ogni tupla restituita dal db...


                $obj[] = FPersistantManager::createObjectFromRow($className, $row); //...istanzio l'oggetto
            }
            $this->__destruct(); // chiude la connessione

            return $obj;
        }
        catch (PDOException $e)
        {
            $this->__destruct(); // chiude la connessione
            return null; // ritorna null se ci sono errori
        }
    }

    /****************************************** STORE ********************************************/

    /**
     * Metodo che permette di salvare informazioni contenute in un oggetto
     * Entity sul database.
     * @param object $obj l'oggetto da salvare
     * @return bool $result il risultato dell'elaborazione
     */
    function store(&$obj) : bool
    {
        $result = false;
        $sql = '';
        $class = '';
        if(is_a($obj, EAdmin::class) ) // se l'oggetto e' una tipologia Utente
            $class = get_parent_class($obj); // si considera la classe padre, EUtente
        else
            $class = get_class($obj); // restituisce il nome della classe dall'oggetto

        $resource = substr($class,1); // nome della risorsa (Utente, Avatar, Gioco ...)
        $foundClass = 'F'.$resource; // nome della rispettiva classe Foundation
        $method = 'store'.$resource; // nome del metodo store+nome_risorsa

        if(class_exists($foundClass) && method_exists($foundClass, $method))  // se la classe esiste e il metodo pure...
            $sql = $foundClass::$method(); //ottieni la stringa sql

        if($sql) //se la stringa sql esiste...
            $result = $this->execStore($obj, $sql); // ... esegui la query

        return $result;
    }

    /**
     * Esegue una INSERT sul database
     *
     * @param mixed $obj
     *            l'oggetto da salvare
     * @param string $sql
     *            la stringa contenente il comando SQL
     * @return boolean l'esito della transazione
     */
    private function execStore(&$obj, string $sql)
    {
        $this->db->beginTransaction(); // inizio della transazione

        $stmt = $this->db->prepare($sql);

        // si prepara la query facendo un bind tra parametri e variabili dell'oggetto
        try
        {
            FPersistantManager::bindValues($stmt, $obj); // si associano i valori dell'oggetto alle entry della query

            $stmt->execute();
            if ($stmt->rowCount()) // si esegue la query
            {
                if (method_exists($obj, 'getId') && $obj->getId() == 0){ // ...se il valore e' di default si assegna l'id
                    $obj->setId($this->db->lastInsertId()); // assegna all'oggetto l'ultimo id dato dal dbms
                }
                $commit = $this->db->commit(); // effettua il commit

                $this->__destruct(); // chiude la connessione

                return $commit; // ritorna il risultato del commit
            }
            else
            {
                // ...altrimenti si effettua il rollback e si ritorna false
                $this->db->rollBack();
                $this->__destruct(); // chiude la connessione

                return false;
            }
        }
        catch (PDOException $e)
        {  // errore: rollback e return false

            $this->db->rollBack();
            $this->__destruct(); // chiude la connessione

            return false;
        }
    }


    /*****************************   ASSOCIAZIONI ENTITY - DB    *********************************/

    /**
     * Associa ai campi della query i corrispondenti valori dell'oggetto
     * @param PDOStatement $stmt lo statement contenente i campi da riempire
     */
    private function bindValues(PDOStatement &$stmt, &$obj)
    {
        $class = '';
        if(is_a($obj, EAdmin::class))
            $class = get_parent_class($obj);
        else
            $class = get_class($obj); // restituisce il nome della classe dall'oggetto

        $resource = substr($class,1); // nome della risorsa (User, Song, UserInfo, ...)
        $foundClass = 'F'.$resource; // nome della rispettiva classe Foundation

        $foundClass::bindValues($stmt, $obj); // associazione statement - EObject
    }

    /**
     * Da una tupla ricevuta da una query istanzia l'oggetto corrispondente
     * @param string $class il nome della classe (ottenibile tramite EClass::name )
     * @param $row array la tupla restituita dal dbms
     * @return mixed l'oggetto risultato dell'elaborazione
     */
    private function createObjectFromRow(string $class, $row)
    {
        $obj = NULL; //oggetto che conterra' l'istanza dell'elaborazione

        if ( class_exists( $class ) )
        {
            $foundClass = 'F'.substr($class,1);

            $obj = $foundClass::createObjectFromRow($row);
        }

        return $obj;
    }

}
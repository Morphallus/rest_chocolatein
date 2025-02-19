<?php

include_once("MyAccessBDD.php");
    
class Controle {
    
    /**
     * 
     * @var MyAccessBDD
     */
    private $myAaccessBDD;
    
    public function demande(string $methodeHTTP, string $table, ?string $id, ?array $champs){
    echo "$methodeHTTP : table=$table, id=$id, champs=". json_encode($champs) ;
    }
    
    /**
     * réponse renvoyée (affichée) au client au format json
     * @param int $code code standard HTTP (200, 500, ...)
     * @param string $message message correspondant au code
     * @param array|int|string|null $result
     */
    private function reponse(int $code, string $message, array|int|string|null $result=""){
        $retour = array(
            'code' => $code,
            'message' => $message,
            'result' => $result
        );
        echo json_encode($retour, JSON_UNESCAPED_UNICODE);
    }
    
    /**
     * Constructeur : récupère l'instance d'accès à la BDD
     */
    public function __construct(){
        try{
            $this->myAaccessBDD = new MyAccessBDD();
        }catch(Exception $e){
            $this->reponse(500, "erreur serveur");
            die();
        }
    }
    
    /**
     * authentification incorrecte
     */
    public function unauthorized(){
        $this->reponse(401, "authentification incorrecte");
    }
    
}

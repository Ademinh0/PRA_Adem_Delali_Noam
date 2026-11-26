<?php 
namespace App\Models;
//  accès BDD / findByLogin() 

class UserModel
{
    public function findByLogin(string $login){
        $pdo = Database::getInstance();
        $sql = 'SELECT * FROM users WHERE login = :login';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['login' => $login]);

        return $stmt->fetch(); // on renvoie la ligne sous forme de tableau ou bien on renvoie false si login n'existe pas
    }
}
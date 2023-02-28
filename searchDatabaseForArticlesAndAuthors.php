<?php
session_start();

$databaseConfig = require_once 'configFile.php';

try {
    $databaseConnection = new PDO(
        'mysql:host=' . $databaseConfig['host'] . ';dbname=' . $databaseConfig['database'] . ';charset=utf8',
        $databaseConfig['user'],
        $databaseConfig['password'],
        [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]

    );

    if(isset($_POST['authorsName'])) {
        $recivedAuthorName = $_POST['authorsName'];
        $_SESSION['recivedAuthorName']=$recivedAuthorName;

        $userQuery = $databaseConnection->prepare("SELECT id_author FROM authors WHERE author_name LIKE '%$recivedAuthorName%'");
        $userQuery->execute();

        $searchingResults = $userQuery->fetch();


        if($searchingResults==NULL) {

            $_SESSION['SearchMessage'] = "Given author was not found";
        }

        else {

            $userQuery = $databaseConnection->prepare("SELECT * FROM article, article_content WHERE id_author=:idSelectedAuthor
            AND article.id_article=article_content.id_article");
            $userQuery->bindValue(':idSelectedAuthor', $searchingResults[0], PDO::PARAM_INT);
            $userQuery->execute();
            $_SESSION['findedArticlesOfGivenAuthor']=$userQuery->fetchAll();

        }
        header('Location: find_article.php');
        exit();

    }

    else{
    
        $userQuery = $databaseConnection->prepare("SELECT author_name, article.id_author, COUNT(article.id_article) AS writenArticle 
        FROM article, article_content, authors WHERE WEEK(NOW())-1 = WEEK(creation_date) 
        AND article.id_article=article_content.id_article AND authors.id_author=article.id_author GROUP BY 
        article.id_author ORDER BY writenArticle DESC LIMIT 3");
        $userQuery->execute();
        $_SESSION['top3authorsOfTheWeek'] = $userQuery->fetchAll();

        header('Location: find_article.php');
        exit();

    }

}
catch (PDOException $error) {
    echo $error->getMessage();
    exit('Database error');
}
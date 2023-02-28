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

        function updateRecord($columnName, $newValue){

            global $databaseConnection;

            $userQuery = $databaseConnection->prepare("UPDATE article_content SET $columnName=:newValue WHERE id_article=:idArticle");
            $userQuery->bindValue(':newValue', $newValue, PDO::PARAM_STR);
            $userQuery->bindValue(':idArticle', $_SESSION['articleId'], PDO::PARAM_INT);
            $userQuery->execute();

            $_SESSION['changeRecordMessage']="Record has been changed";

            header('Location: edit_article.php');
            exit();
        }

    if(isset($_POST['articleId'])){
    $givenArticleId = $_POST['articleId'];  

    $userQuery = $databaseConnection->prepare("SELECT * FROM article_content WHERE id_article=:idOfSearchedArticle");
    $userQuery->bindValue(':idOfSearchedArticle', $givenArticleId, PDO::PARAM_INT);
    $userQuery->execute();

    $queryResult = $userQuery->fetchAll();
    }

    if (isset($_POST['newTitle'])) {

        $newTitle=$_POST['newTitle'];
        updateRecord("article_title", $newTitle);
    }
    
    
    if (isset($_POST['articleContent'])) {

        $newText=$_POST['articleContent'];
        updateRecord("article_content", $newText);     
    }
    
    if (isset($_POST['newDate'])) {

        $newDate=$_POST['newDate'];
        updateRecord("creation_date", $newDate);
    }
    
    if($queryResult==NULL){

        $_SESSION['failMessage'] = "There is no article with that ID";
        header('Location: edit_article.php');
        exit();
    }

    else{
        
       $_SESSION['foundedArticle'] = $queryResult;
       $_SESSION['articleId']= $givenArticleId;
       
       $userQuery = $databaseConnection->prepare("SELECT author_name FROM article, authors 
       WHERE id_article=:idOfSearchedArticle AND article.id_author=authors.id_author");
       $userQuery->bindValue(':idOfSearchedArticle', $givenArticleId, PDO::PARAM_INT);
       $userQuery->execute();
    
       $queryResult = $userQuery->fetchAll();
       $_SESSION['authorOfTheArticle'] = $queryResult;

       header('Location: edit_article.php');
        exit();
    }
       
}

catch (PDOException $error) {
    echo $error->getMessage();
    exit('Database error');
}
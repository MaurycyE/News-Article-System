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

    $articleTitle = $_POST['articleTitle'];
    $articleContent = $_POST['articleContent'];
    $articleDate = $_POST['articleDate'];
    $author = $_POST['author'];

    function checkAuthorName($authorName)
    {
        global $databaseConnection;

        $userQuery = $databaseConnection->prepare("SELECT id_author FROM authors WHERE author_name LIKE '%$authorName%'");
        $userQuery->execute();

        return $userQuery->fetch();
    }

    function addAuthorToDataBaseOrGetId($checkingResut, $authorNameToAdd)
    {
        global $databaseConnection;

        if ($checkingResut == NULL) {
            $userQuery = $databaseConnection->prepare("INSERT INTO authors VALUES(:id_author, :author_name)");
            $userQuery->bindValue(':id_author', NULL, PDO::PARAM_NULL);
            $userQuery->bindValue(':author_name', $authorNameToAdd, PDO::PARAM_STR);
            $userQuery->execute();

            $userQuery = $databaseConnection->prepare("SELECT id_author FROM authors WHERE author_name=:authorNameToAdd");
            $userQuery->bindValue(':authorNameToAdd', $authorNameToAdd, PDO::PARAM_STR);
            $userQuery->execute();

            return $userQuery->fetch();
        } else {
            return $checkingResut;
        }
    }

    function connectIdAuthorToArticleIdInDatabase($idArticle, $idAuthor)
    {
        global $databaseConnection;

        $userQuery = $databaseConnection->prepare("INSERT INTO article VALUES(:idArticleJustAdded, :idAuthorConnectedToArticle)");
        $userQuery->bindValue(':idArticleJustAdded', $idArticle[0], PDO::PARAM_INT);
        $userQuery->bindValue(':idAuthorConnectedToArticle', $idAuthor[0], PDO::PARAM_INT);
        $userQuery->execute();
    }

    if (isset($articleTitle)) {

        $userQuery = $databaseConnection->prepare("INSERT INTO article_content VALUES(:id_article, :article_title, 
        :article_content, :creation_date)");
        $userQuery->bindValue(':id_article', NULL, PDO::PARAM_NULL);
        $userQuery->bindValue(':article_title', $articleTitle, PDO::PARAM_STR);
        $userQuery->bindValue(':article_content', $articleContent, PDO::PARAM_STR);
        $userQuery->bindValue(':creation_date', $articleDate, PDO::PARAM_STR);
        $userQuery->execute();

        $userQuery = $databaseConnection->prepare("SELECT id_article FROM article_content WHERE article_title=:articleTitleJustAdded");
        $userQuery->bindValue(':articleTitleJustAdded', $articleTitle, PDO::PARAM_STR);
        $userQuery->execute();

        $idArticleToConnectWithAuthorId = $userQuery->fetch();

        $isAuthorInDatabase = checkAuthorName($author);
        $idAuthorToAddToDatabase = addAuthorToDataBaseOrGetId($isAuthorInDatabase, $author);
        connectIdAuthorToArticleIdInDatabase($idArticleToConnectWithAuthorId, $idAuthorToAddToDatabase);

        if (isset($_POST['anotherAuthorName'])) {

            $anotherAuthorName = $_POST['anotherAuthorName'];
            $isAuthorInDatabase = checkAuthorName($anotherAuthorName);
            $idAuthorToAddToDatabase = addAuthorToDataBaseOrGetId($isAuthorInDatabase, $anotherAuthorName);
            connectIdAuthorToArticleIdInDatabase($idArticleToConnectWithAuthorId, $idAuthorToAddToDatabase);
        }

        if (isset($_POST['anotherAuthorName2'])) {

            $anotherAuthorName2 = $_POST['anotherAuthorName2'];
            $isAuthorInDatabase = checkAuthorName($anotherAuthorName2);
            $idAuthorToAddToDatabase = addAuthorToDataBaseOrGetId($isAuthorInDatabase, $anotherAuthorName2);
            connectIdAuthorToArticleIdInDatabase($idArticleToConnectWithAuthorId, $idAuthorToAddToDatabase);
        }

        $_SESSION['articleAdded'] = true;
        header('Location:add_article.php');
        exit();
    }
} catch (PDOException $error) {
    echo $error->getMessage();
    exit('Database error');
}
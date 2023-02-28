<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find your article</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body class="bg-dark">

    <div class="container justify-content-center align-items-center bg-dark">
        <main>
            <div class="row justify-content-center text-center my-5">

                <div class="col-10 col-sm-8 col-lg-6 bg-success rounded-4 shadow-lg border">
                    <h1 class="p-3">Find an article</h1>


                    <form action="searchDatabaseForArticlesAndAuthors.php" method="post">
                        <h5 class="mb-3 text-light">Find all of your favorite author articles</h5>
                        <div class="mb-2 text-light">
                            <input type="text" class="form-control" name="authorsName" placeholder="Enter author name" id="addTitle" required>
                        </div>

                        <button type="submit" class="btn btn-primary my-3">SEARCH</button>

                    </form>

                    <form action="searchDatabaseForArticlesAndAuthors.php" method="post">

                        <h5 class="my-3 text-light">OR find top 3 authors that wrote the most articles
                            last week
                        </h5>

                        <button type="submit" class="btn btn-primary my-3">SHOW ME</button>

                    </form>

                    <div>
                        <?php
                            if(isset($_SESSION['SearchMessage'])){
                            echo '<h3 class="mb-3 text-light">'.$_SESSION['SearchMessage'].'</h3>';
                            unset($_SESSION['SearchMessage']);
                            }


                            if(isset($_SESSION["findedArticlesOfGivenAuthor"])){

                                echo '<h2 class="mb-3 text-light">Articles writen by: '.$_SESSION['recivedAuthorName'].'</h2>';
                                echo '<div class="table-responsive">
                                        <table class="table table-sm table-hover mt-1">
                                             <thead>
                                                <tr><th>Article ID</th><th>Article Title</th><th>Creation Date</th></tr>
                                            </thead>
                                            <tbody>';
                                                foreach($_SESSION["findedArticlesOfGivenAuthor"] as $ArticleData) {
                                                    echo "<tr><td> {$ArticleData['id_article']} </td><td> {$ArticleData['article_title']}</td> 
                                                    <td> {$ArticleData['creation_date']} </td></tr>";
                                                }
                                            echo '</tbody>
                                        </table>
                                    </div>';}
                            
                        unset($_SESSION["findedArticlesOfGivenAuthor"]);

                        if(isset($_SESSION['top3authorsOfTheWeek'])){

                            echo '<h2 class="mb-3 text-light">Top 3 authors of the week:</h2>';
                            echo '<div class="table-responsive">
                                        <table class="table table-sm table-hover mt-1">
                                            <thead>
                                                 <tr><th>Authors</th><th>Numbers of writen articles</th></tr>
                                            </thead>
                                             <tbody>';

                                                    foreach($_SESSION["top3authorsOfTheWeek"] as $authorsOfTheWeekData) {
                                                        echo "<tr><td> {$authorsOfTheWeekData['author_name']} </td><td> {$authorsOfTheWeekData['writenArticle']}</td> 
                                                        </tr>";
                                                    }
                                        echo'</tbody>
                                         </table>
                                    </div>';
                        }
                        unset($_SESSION["top3authorsOfTheWeek"]);

                        ?>
                    </div>

                    <a class="nav-link text-dark my-3 rounded-3" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg></a>
                </div>

            </div>

        </main>

    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
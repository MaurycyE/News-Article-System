<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new article</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body class="bg-dark">

    <div class="container justify-content-center align-items-center bg-dark">
        <main>
            <div class="row justify-content-center text-center my-5">

                <div class="col-10 col-sm-8 col-lg-6 bg-success rounded-4 shadow-lg border">
                    <h1 class="p-3 text-dark">Add new article</h1>

                    <form action="reciving_article_data.php" method="post">
                        <div class="my-3 text-light">
                            <label for="addTitle" class="form-label h5">Add Title</label>
                            <input type="text" class="form-control" name="articleTitle" placeholder="Enter your article title" id="addTitle" required>
                        </div>

                        <h5 class="mb-3 text-light">Add article content</h5>
                        <div class="mb-3 text-light d-flex">

                            <textarea class="rounded-3" name="articleContent" id="addContent" cols="100" rows="5" required></textarea>
                        </div>

                        <div class="mb-3 text-light">
                            <label for="addDate" class="form-label h5">Enter date of creation</label>
                            <input type="date" class="form-control" name="articleDate" id="addDate" required>
                        </div>

                        <div class="my-3 text-light">
                            <label for="addAuthor" class="form-label h5">Add Author</label>
                            <input type="text" class="form-control" name="author" placeholder="Enter author name" id="addAuthor" required>
                        </div>

                        <div class="d-inline">
                            <button type="button" class="btn btn-secondary" id="anotherAuthorNameButton">+ Add another author</button>
                            <input type="text" class="form-control" name="anotherAuthorName" id="anotherAuthorName" placeholder="Enter author name" disabled>

                        </div>

                        <div class="d-inline">
                            <button type="button" class="btn btn-secondary mt-3" id="anotherAuthorNameButton2">+ Add another author</button>
                            <input type="text" class="form-control" name="anotherAuthorName2" id="anotherAuthorName2" placeholder="Enter author name" disabled>

                        </div>

                        <button type="submit" class="btn btn-dark my-3">ADD ARTICLE</button>

                    </form>

                    <?php
                    if ((isset($_SESSION['articleAdded'])) && ($_SESSION['articleAdded'])) {
                        echo '<h2 class="mb-3 text-light">Article added!</h2>';
                    }
                    $_SESSION['articleAdded'] = false;

                    ?>

                    <a class="nav-link text-dark my-3 rounded-3" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg></a>

                </div>

            </div>


        </main>

    </div>

    <script>
        document.getElementById('anotherAuthorNameButton').onclick = function() {
            let disabled = document.getElementById("anotherAuthorName").disabled;
            if (disabled) {
                document.getElementById("anotherAuthorName").disabled = false;
            }
        }
        document.getElementById('anotherAuthorNameButton2').onclick = function() {
            let disabled = document.getElementById("anotherAuthorName2").disabled;
            if (disabled) {
                document.getElementById("anotherAuthorName2").disabled = false;
            }
        }
    </script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit article</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body class="bg-dark">

    <div class="container justify-content-center align-items-center bg-dark">
        <main>
            <div class="row justify-content-center text-center my-5">

                <div class="col-10 col-sm-8 col-lg-6 bg-success rounded-4 shadow-lg border">
                    <h1 class="p-3">Edit selected article</h1>

                    <form action="findAndEditArticle.php" method="post">
                        <div class="mb-3 text-light">
                            <label for="giveArticleId" class="form-label">Find your article by ID</label>
                            <input type="number" class="form-control" name="articleId" placeholder="Enter id article" id="giveArticleId" required min="1">
                        </div>

                        <button type="submit" class="btn btn-primary my-3">Find</button>

                    </form>

                    <?php

                    if(isset($_SESSION['failMessage'])){
                            echo '<h4 class="mb-3 text-light">'.$_SESSION['failMessage'].'</h4>';
                            unset($_SESSION['failMessage']);
                            }
                    
                    if(isset($_SESSION['foundedArticle'])){

                        echo '<h4 class="mb-3 text-dark bg-white rounded-2 p-2">'.$_SESSION['foundedArticle'][0][1].'</h4>';
                        echo '<div class="bg-white border rounded-2 p-2">'.$_SESSION['foundedArticle'][0][2].'</div>';
                        echo '<div class="bg-white my-2 rounded-2 p-2">'.$_SESSION['foundedArticle'][0][3].'</div>';
                        
                        echo "Author/s: ";
                        foreach($_SESSION["authorOfTheArticle"] as $articleAuthor){

                            echo '<span class="mx-1 text-white">'.$articleAuthor['author_name'].'</span>';
                        }
                        echo '<div class="my-4"><button class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#edit_title">Edit Title</button>

                         <button class="btn btn-primary mx-2" data-bs-toggle="modal"
                         data-bs-target="#edit_text">Edit Text</button>

                         <button class="btn btn-primary" data-bs-toggle="modal"
                         data-bs-target="#edit_date">Edit date</button></div>';

                        unset($_SESSION['foundedArticle']);
                        unset($_SESSION["authorOfTheArticle"]);
                    }

                    if(isset($_SESSION['changeRecordMessage'])){
                        echo '<h4 class="mb-3 text-light">'.$_SESSION['changeRecordMessage'].'</h4>';
                        unset($_SESSION['changeRecordMessage']);
                    }

                    ?>


                    <a class="nav-link text-dark my-3 rounded-3" href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg></a>


                    <!-- Modal edit title-->
                    <div class="modal fade" id="edit_title" tabindex="-1"
                            aria-labelledby="editTitle-modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editTitle-modalLabel">Enter new title:
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="findAndEditArticle.php" method="post">

                                                <div class="mb-3">
                                                    <input type="text" class="form-control" id="newTitle" 
                                                        name="newTitle" required>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                                    <path
                                                    d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                                </svg></button>
                                                </div>                                       
                                        </form>
                                    </div>

                                </div>
                            </div>
                           
                        </div>
                        <!-- Modal -->

                        <!-- Modal edit text-->
                    <div class="modal fade" id="edit_text" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editText-modalLabel">Enter new text:
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="findAndEditArticle.php" method="post">

                                                <div class="mb-3">
                                                    
                                                <textarea class="rounded-3" name="articleContent"  cols="60" rows="5" required></textarea>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                                    <path
                                                    d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                                </svg></button>
                                                </div>                                       
                                        </form>
                                    </div>

                                </div>
                            </div>
                           
                        </div>
                        <!-- Modal -->

                        <!-- Modal edit data-->
                        <div class="modal fade" id="edit_date" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="edit_date_modalLabel">Enter new date:
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="findAndEditArticle.php" method="post">

                                                <div class="mb-3">
                                                    <input type="date" class="form-control" name="newDate" required>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                                    <path
                                                    d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                                </svg></button>
                                                </div>                                       
                                        </form>
                                    </div>

                                </div>
                            </div>
                           
                        </div>
                        <!-- Modal -->

                </div>

            </div>


        </main>

    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
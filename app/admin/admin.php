<?php
// *******************************************************************************************************
// *******************************************************************************************************
// **************************************** PANEL ADMINISTRACYJNY ****************************************
// *******************************************************************************************************
// *******************************************************************************************************

// Funkcja do wyświetlenia ładnego tytułu u góry widoku
function pokazTytul() {
    $result = 
    '
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <p class="text-center h1 fw-bold mx-md-4 mt-4">Panel Administracyjny</p>
    ';
    
    return $result;
}

//     ----------------------------------------SELECT----------------------------------------
function pokazWszystkiePodstrony() {
    include('cfg.php');
    $query = " SELECT * FROM page_list ";
    $result = mysqli_query($link, $query);
    while( $row = mysqli_fetch_array($result) ) {
        $id = $row['id'];
        $page_content = htmlspecialchars($row['page_content']);
        $page_title = $row['page_title'];

        $table =
        "
        <head>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head>

        <table class='table table-responsive-sm table-hover table-dark' style = 'margin-right: 100px;'>
            <tr>
                <td style='border: 2px solid black;'><span style='font-size: xx-large; margin-right: 55px;'>Id strony</span></td>
                <td style='border: 2px solid black;'><span style='font-size: xx-large; margin-right: 35px;'>Tytuł</span></td>
                <td style='border: 2px solid black;'><span style='font-size: xx-large; margin-right: 35px;'>Zawartość (HTML)</span></td>
            </tr>
            <tr>
                <td style='border: 2px solid black;'>".$id."</td>
                <td style='border: 2px solid black;'>".$page_title."</td>
                <td style='border: 2px solid black;'>".$page_content."</td>        
            </tr>
        </table>        

        <form method='post'>
            <input type='hidden' name='idP' value='" . $id . "'/>
            <input type='hidden' name='titleP' value='" . $page_title . "'/>
            <input type='hidden' name='contentP' value='" . $page_content . "'/>
            <!--  <input type='submit' name='edit' value='Edytuj dane'/> -->
            <button type='submit' name='edit' class='btn btn-warning'>Edytuj podstronę</button>

        </form>

        <form method='post'>
            <input type='hidden' name='idToDelete' value='" . $id . "'/>
            <!-- <input type='submit' name='delete' value='Skasuj rekord'/> -->
            <button type='submit' name='delete' class='btn btn-danger'>Skasuj podstronę</button>
        </form>";

        echo $table;
    }
}
//     ----------------------------------------LOGIN----------------------------------------
function formularzLogowania() {
    include('cfg.php');

    if($_SESSION['loginFailed'] != 0) {

    
    $result = 
    '
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-md-4 mt-4">Zaloguj się</p>

                                    <form method="post" name="logowanko" class="mx-1 mx-md-4" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="login" id="form3" name="username" class="form-control" />
                                                <label class="form-label" for="form3">Twój username</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" id="form3_2" name="password" class="form-control" />
                                                <label class="form-label" for="form3_2">Hasło</label>
                                            </div>
                                        </div>

                                        <div class="status" style="text-align: center">
                                        </div>
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary" name="loguj">Zaloguj się</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                    <img src="https://egymerch.com/site_assets/assets/imgs/login/login.png"
                                        class="img-fluid" alt="Sample image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

';

return $result;

    }
}

//     ----------------------------------------UPDATE----------------------------------------
function UpdateForm() {
    include('cfg.php');

    if(empty($_POST['idP'])) {
        return "";
    }

    $id = $_POST['idP'];
    $title = $_POST['titleP'];
    $content = htmlspecialchars($_POST['contentP']);


    $update_form = 
    "
        <div>
        <div>
            <h1>Edytuj strone ".$title." #".$id."</h1>
            <form method='post'>
            <table style='width:100%; height: 400px'>
                <thead>
                    <th><span class='text'>id</span></th>
                    <th><span class='text'>title</span></th>
                    <th><span class='text' id='content'>Content</span></th>
                </thead>
                <tbody>
                    <tr>
                        <td><input type='text' readonly value='".$id."' name='update_id'/></td>
                        <td><input type='text' name='update_title' value='".$title."'/></td>
                        <td><textarea style='height: 98%; width: 99%' name='update_content'>".$content." </textarea></td>
                    </tr>       
                </tbody>
            </table>
            <button type='submit' class='btn btn-primary'>Zapisz</button>
            </form>
        </div>
        </div>
        ";
    return $update_form;
}

function queryUpdate() {
    include('cfg.php');

    $id = $_POST['update_id'];
    $title = $_POST['update_title'];
    $content = $_POST['update_content'];

    $query = "UPDATE `page_list` SET `page_title`='".$title."' , `page_content`=' ".htmlspecialchars($content)." ' WHERE `id`=".$id." LIMIT 1";
    // W zapytaniach typu UPDATE, DELETE, SELECT zawsze używaj na koocu parametru LIMIT, np.
    // dla potrzeby naszego projektu CMSa należy użyd LIMIT 1, oznacza to że modyfikacji ulegnie pierwszy
    // znaleziony rekord. W przypadku gdy warunek jest „nieszczelny”, i brakuje opcji LIMIT, można
    // „wysadzid” sobie całą bazę – historia pełna jest takich przypadków. Chodzi o sytuacje, gdzie np.
    // wszystkie treści strony przez przypadek, lub w wyniku ataku SQL INJECTION są zastępowane np. NULLem
    $result = mysqli_query($link, $query);

    return $result;

}


//     ----------------------------------------DELETE----------------------------------------
function queryDelete() {
    include('cfg.php');
    $id = $_POST['idToDelete'];
    $query = "DELETE FROM `page_list` WHERE id=$id LIMIT 1";
    $result = mysqli_query($link, $query);
    return $result;
}

// Wyłączenie notice'ów i warningów
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 

//     ----------------------------------------INSERT----------------------------------------
function insertForm() {
    
    include('cfg.php');

    $insertForm =
        '<div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Dodaj kolejną stronę</p>

                                <form method="post" class="mx-1 mx-md-4">

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" name="insertTitle"/>
                                            <label class="form-label" for="form3">Tytuł podstrony</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <textarea style="height: 85%; width: 85%" name="insertContent"></textarea>
                                            <label class="form-label" for="form3_2">Zawartość (Kod HTML)</label>
                                        </div>
                                    </div>

                                    <div class="status" style="text-align: center">
                                    </div>
                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-success" name="insert">Dodaj</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';

    return $insertForm;
}

function queryInsert() {

    include('cfg.php');
    
    $title = $_POST['insertTitle'];
    $content = $_POST['insertContent'];
    $query = "INSERT INTO `page_list` (`page_title`, `page_content`) values('$title', '$content')";
    $result = mysqli_query($link, $query);

    return $result;

}


echo pokazTytul();
echo formularzLogowania();



//    ----------------- Wywołanie Query zależnie od warunku i tylko dla zalogowanego użytkownika -----------------------

if($_SESSION['loginFailed'] == 0) {

    echo UpdateForm();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['update_id'])) {
            echo queryUpdate();
            exit;
        }

        if(isset($_POST['idToDelete'])) {
            echo queryDelete();
            exit;
        }

        if(isset($_POST['insertTitle'])) {
            echo queryInsert();
            exit;
        }
    }

    pokazWszystkiePodstrony();
    echo insertForm();

}
else {
    echo "!!! Nie jesteś zalogowany !!!";
}

?>
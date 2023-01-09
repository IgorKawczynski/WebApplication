<?php

// *******************************************************************************************************************************
// *******************************************************************************************************************************
// **************************************************** PANEL ADMINISTRACYJNY ****************************************************
// *******************************************************************************************************************************
// *******************************************************************************************************************************

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

//     ------------------------------------------------------------ SELECT ------------------------------------------------------------

// Funkcja wyświetla wszystkie podstrony poprzez zapytanie
// 'select' z bazy danych, w której są stosowne rekordy
function pokazWszystkiePodstrony() {
    include('cfg.php');
    $query = " SELECT * FROM page_list "; // zapytanie typu 'select'
    $result = mysqli_query($link, $query);
    while( $row = mysqli_fetch_array($result) ) { // dla każdego rekordu
        $id = $row['id'];
        $page_content = htmlspecialchars($row['page_content']); // enkodowanie
        $page_title = $row['page_title'];

        // HTML do ładnego wyświetlenia rekordów
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
//     ------------------------------------------------------------ LOGIN ------------------------------------------------------------

// Funkcja z dodatkowym HTML'em do wygenerowania
// formularzu logowania (tylko dla użytkownika niezalogowanego)
function formularzLogowania() {
    include('cfg.php');

    if($_SESSION['loginFailed'] != 0) {

    // HTML z formularzem + bootstrap
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

//     ------------------------------------------------------------ UPDATE ------------------------------------------------------------

// Funkcja z formularzem do edycji
function UpdateForm() {
    include('cfg.php');

    if(empty($_POST['idP'])) {
        return "";
    }

    $id = $_POST['idP'];
    $title = $_POST['titleP'];
    // enkodowanie HTML'owe
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

// Funkcja z podzapytaniem do edycji
function queryUpdate() {
    include('cfg.php');

    $id = $_POST['update_id'];
    $title = $_POST['update_title'];
    $content = $_POST['update_content'];


    // Dekodowanie w momencie pobierania zmiennej $content -- z uwagi na to, że query enkoduje znaki html'owe typu '<' lub ' " '...
    $query = "UPDATE `page_list` SET `page_title`='".$title."' , `page_content`=' ".html_entity_decode($content)." ' WHERE `id`=".$id." LIMIT 1";
    
    // W zapytaniach typu UPDATE, DELETE, SELECT zawsze używaj na koocu parametru LIMIT, np.
    // dla potrzeby naszego projektu CMSa należy użyd LIMIT 1, oznacza to że modyfikacji ulegnie pierwszy
    // znaleziony rekord. W przypadku gdy warunek jest „nieszczelny”, i brakuje opcji LIMIT, można
    // „wysadzid” sobie całą bazę – historia pełna jest takich przypadków. Chodzi o sytuacje, gdzie np.
    // wszystkie treści strony przez przypadek, lub w wyniku ataku SQL INJECTION są zastępowane np. NULLem
    $result = mysqli_query($link, $query);

    return $result;

}


//     ------------------------------------------------------------ DELETE ------------------------------------------------------------

// Funkcja z podzapytaniem do usunięcia
function queryDelete() {
    include('cfg.php');
    $id = $_POST['idToDelete'];
    $query = "DELETE FROM `page_list` WHERE id=$id LIMIT 1";
    $result = mysqli_query($link, $query);
    return $result;
}

// Wyłączenie notice'ów i warningów
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 

//     ------------------------------------------------------------ INSERT ------------------------------------------------------------

// Funkcja z formularzem do dodania nowej podstrony
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

// Funkcja do wykonania podzapytania
function queryInsert() {

    include('cfg.php');
    
    $title = $_POST['insertTitle'];
    $content = $_POST['insertContent'];

    // enkodowanie pod HTML'a --> $content = htmlspecialchars($content, ENT_HTML401);

    $query = "INSERT INTO `page_list` (`page_title`, `page_content`) values('$title', '$content')";
    $result = mysqli_query($link, $query);

    return $result;

}

// Wygenerowanie tytułu + formularzu z logowaniem jeśli to niezbędne
echo pokazTytul();
echo formularzLogowania();



//    ------------------------ Wywołanie Query zależnie od warunku i tylko dla zalogowanego użytkownika ------------------------------

// Jeśli zalogowany
if($_SESSION['loginFailed'] == 0) {

    echo UpdateForm();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Jeśli Wykonano Update -- Wykonaj Update
        if(isset($_POST['update_id'])) {
            echo queryUpdate();
            echo "<script>";
            echo "alert('Pomyślnie zaaktualizowano stronę ! ');";
            echo "window.location = 'http://localhost/Application/app/admin/admin.php';";
            echo "</script>" ;
            exit;
        }

        // Jeśli Wykonano Delete -- Wykonaj Delete
        if(isset($_POST['idToDelete'])) {
            echo queryDelete();
            echo "<script>";
            echo "alert('Pomyślnie usunięto stronę ! ');";
            echo "window.location = 'http://localhost/Application/app/admin/admin.php';";
            echo "</script>" ;
            exit;
        }

        // Jeśli Wykonano Insert -- Wykonaj Insert
        if(isset($_POST['insertTitle'])) {
            echo queryInsert();
            echo "<script>";
            echo "alert('Pomyślnie dodano nową stronę ! ');";
            echo "window.location = 'http://localhost/Application/app/admin/admin.php';";
            // header("Location: http://localhost/Application/?url=home");
            // console.log("DODANO NOWĄ STRONĘ! ");
            echo "</script>" ;
            exit;
        }
    }

    // Wygenerowanie formularzu do insert'ów + podstron jeśli to niezbędne
    pokazWszystkiePodstrony();
    echo insertForm();

}
else {

    // Na wypadek błędnego zalogowania się
    if((isset($_POST['username']) && $_POST['username'] != "root") && (isset($_POST['password']) && $_POST['password'] != "root")) {
        echo "<script>";
        echo "alert('Błędny Login lub Hasło !');";
        echo "</script>" ;
    }

    echo "Zaloguj się najpierw !";
}




function list_categories() {

    include "cfg.php";

    $query="SELECT * FROM category WHERE mother = 0";

    $result=mysqli_query($link, $query);

    while($row = mysqli_fetch_array($result)) {

        $id=$row['id'];
        $parent = $row['mother'];
        $name=$row['name'];

        $child_query = "SELECT * FROM category WHERE mother = $id";

        $child_categories = mysqli_query($link, $child_query);

        $page_result  = "
        <head>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head>

        <div style='margin: auto; width: 10%;'>
        <div>
            <table>
                <thead>
                    <th><span>ID</span></th>
                    <th><span>NAZWA</span></th>
                    <th><span>actions</span></th>
                </thead>
                <tbody>
                    <tr> 
                    <td>".$id."</td>
                    <td>".$name."</td>
                    <td><form method='post'>
                        <input type='hidden' name='category_id' value='".$id."'/>
                        <input type='hidden' name='category_mother' value='".$mother."'/>
                        <input type='hidden' name='category_name' value='".$name."'/>
                        <input type='submit' name='edit' value='Edit'/>
                    </form>
                    <form method='post'>
                        <input type='hidden' name='category_to_delete_id' value='".$id."'/>
                        <input type='submit' name='delete' value='Delete'/>
                    </form></td>
                    </tr>       
                </tbody>
            </table>
            
        </div>
        
        </div>
        <br>
        ";
        echo $page_result;
        while ($child_row = mysqli_fetch_array($child_categories)) {

            $child_id = $child_row['id'];
            $child_mother = $child_row['mother'];
            $child_name = $child_row['name'];

            $wallpaper = './../assets/real-madrid-logo-wallpaper.jpg';
            $style = '';

            if($child_mother == 1) {
                $wallpaper = '../../assets/real-madrid-logo-wallpaper.jpg';
                $style = 'color: black; font-size: 40px;';

            }
            if($child_mother == 2) {
                $wallpaper = '../../assets/barca-logo-wallpaper.jpg';
                $style = 'color: white; font-size: 40px;';
            }
            if($child_mother == 3) {
                $wallpaper = '../../assets/united-logo-wallpaper.jpg';
                $style = 'color: white; font-size: 40px;';
            }
            if($child_mother == 4) {
                $wallpaper = '../../assets/city-logo-wallpaper.png';
                $style = 'color: white; font-size: 40px;';
            }
            if($child_mother == 5) {
                $wallpaper = '../../assets/arsenal-logo-wallpaper.png';
                $style = 'color: white; font-size: 40px;';
            }
            if($child_mother == 6) {
                $wallpaper = '../../assets/psg-logo-wallpaper.jpg';
                $style = 'color: white; font-size: 40px;';
            }
            if($child_mother == 7) {
                $wallpaper = '../../assets/chelsea-logo-wallpaper.jpg';
                $style = 'color: white; font-size: 40px;';
            }
            if($child_mother == 8) {
                $wallpaper = '../../assets/bayern-logo-wallpaper.jpg';
                $style = 'color: white; font-size: 40px;';
            }

            $children_result = "
            <head>
                <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet'>
            </head>

            <body>
                <table id='tableCategories' class='table table-hover' background='./assets/anfield.jpeg'>
                    <thead>
                        <tr style='background-color: #333; color: white;'>
                            <th style='margin: auto; width: 15%;' scope='col'>Numer Zawodnika</th>
                            <th style='margin: auto; width: 15%;' scope='col'>Klub przynależący</th>
                            <th style='margin: auto; width: 52%;' scope='col'>Imię</th>
                            <th scope='col'>Zarządzaj</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr background=".$wallpaper." style='color: white; opacity: 0.8;'>
                            <td style='".$style."'>".$child_id."</td> 
                            <td style='".$style."'>".$child_mother."</td>
                            <td style='".$style."'>".$child_name."</td>
                            <td>
                                <form method='post'>
                                    <input type='hidden' name='category_id' value='".$child_id."'/>
                                    <input type='hidden' name='category_mother' value='".$child_mother."'/>
                                    <input type='hidden' name='category_name' value='".$child_name."'/>
                                    <button type='submit' name='edit' class='btn btn-warning'>Edytuj zawodnika</button>
                                </form>
                                <form method='post'>
                                    <input type='hidden' name='category_to_delete_id' value='".$child_id."'/>
                                    <button type='submit' name='delete' class='btn btn-danger'>Skasuj zawodnika</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </body>
        ";

        echo $children_result;
        }

    }
}



// function list_categories() {

//     include "cfg.php";

//     $query="SELECT * FROM category WHERE mother = 0";

//     $result=mysqli_query($link, $query);

//     while($row = mysqli_fetch_array($result)) {

//         $id=$row['id'];
//         $parent = $row['mother'];
//         $name=$row['name'];

//         $child_query = "SELECT * FROM category WHERE mother = $id";

//         $child_categories = mysqli_query($link, $child_query);

//         $page_result  = "
//         <div style='margin: auto; width: 10%;'>
//         <div>
//             <table>
//                 <thead>
//                     <th><span>ID</span></th>
//                     <th><span>NAZWA</span></th>
//                     <th><span>actions</span></th>
//                 </thead>
//                 <tbody>
//                     <tr> 
//                     <td>".$id."</td>
//                     <td>".$name."</td>
//                     <td><form method='post'>
//                         <input type='hidden' name='category_id' value='".$id."'/>
//                         <input type='hidden' name='category_mother' value='".$mother."'/>
//                         <input type='hidden' name='category_name' value='".$name."'/>
//                         <input type='submit' name='edit' value='Edit'/>
//                     </form>
//                     <form method='post'>
//                         <input type='hidden' name='category_to_delete_id' value='".$id."'/>
//                         <input type='submit' name='delete' value='Delete'/>
//                     </form></td>
//                     </tr>       
//                 </tbody>
//             </table>
            
//         </div>
        
//         </div>
//         <br>
//         ";
//         echo $page_result;
//         while ($child_row = mysqli_fetch_array($child_categories)) {

//             $child_id = $child_row['id'];
//             $child_mother = $child_row['mother'];
//             $child_name = $child_row['name'];

//             $children_result = "
//             <div style='margin: auto; width: 10%;'>
//             <div >
//                 <table>
//                     <thead>
//                         <th><span >ID</span></th>
//                         <th><span >MATKA</span></th>
//                         <th><span >NAZWA</span></th>
//                         <th><span>actions</span></th>
//                     </thead>
//                     <tbody>
//                         <tr> 
//                         <td >".$child_id."</td> 
//                         <td >".$child_mother."</td>
//                         <td >".$child_name."</td>
//                         <td><form method='post'>
//                             <input type='hidden' name='category_id' value='".$child_id."'/>
//                             <input type='hidden' name='category_mother' value='".$child_mother."'/>
//                             <input type='hidden' name='category_name' value='".$child_name."'/>
//                             <input type='submit' name='edit' value='Edit'/>
//                         </form>
//                         <form method='post'>
//                             <input type='hidden' name='category_to_delete_id' value='".$child_id."'/>
//                             <input type='submit' name='delete' value='Delete'/>
//                         </form>
//                         <form method='post'>
//                             <input type='hidden' name='product_category' value='".$child_id."'/>
//                             <input type='submit' name='new_product' value='Add product'/>
//                         </form>
//                         </td>
//                         </tr>
//                     </tbody>
//                 </table>
                
//             </div>
           
//             </div>
//             <br>
//         ";

//         echo $children_result;
//         echo "<br>";
//         }
//         echo "<br><hr style='height: 2px; background: red'><br>";

//     }
// }

list_categories();

?>
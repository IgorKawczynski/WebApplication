<?php

// *******************************************************************************************************************************
// *******************************************************************************************************************************
// *******************************************************************************************************************************
// **************************************************** PANEL ADMINISTRACYJNY ****************************************************
// *******************************************************************************************************************************
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

// ******************************************************************************************************************************
// ********************************************************** PODSTRONY *********************************************************
// ******************************************************************************************************************************

//     ------------------------------------------------------ SELECT PODSTRON ------------------------------------------------------

// Funkcja wyświetla wszystkie podstrony poprzez zapytanie
// 'select' z bazy danych, w której są stosowne rekordy
function pokazWszystkiePodstrony() {
     // Dołączenie configu z bazą danych
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
//     ---------------------------------------------------------- LOGIN ----------------------------------------------------------

// Funkcja z dodatkowym HTML'em do wygenerowania
// formularzu logowania (tylko dla użytkownika niezalogowanego)
function formularzLogowania() {
     // Dołączenie configu z bazą danych
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

//     ------------------------------------------------------ UPDATE PODSTRON -----------------------------------------------------

// Funkcja z formularzem do edycji
function UpdateForm() {
     // Dołączenie configu z bazą danych
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
    <br>
    <div>
        <div>
            <h1>Edytuj strone ".$title." o ID : ".$id."</h1>
            <form method='post'>
                <table class='table table-responsive-sm table-hover table-dark' style='width:100%; height: 400px'>
                    <thead class='table-dark'>
                        <th><span class='text'>id</span></th>
                        <th><span class='text'>title</span></th>
                        <th><span class='text' id='content'>Content</span></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type='text' readonly value='".$id."' name='updateId'/></td>
                            <td><input type='text' name='updateTitle' value='".$title."'/></td>
                            <td><textarea style='height: 98%; width: 99%' name='updateContent'>".$content." </textarea></td>
                        </tr>       
                    </tbody>
                </table>
                <button type='submit' class='btn btn-primary'>Zapisz</button>
            </form>
        </div>
    </div>
    <br>
        ";
    return $update_form;
}

// Funkcja z podzapytaniem do edycji
function queryUpdate() {
     // Dołączenie configu z bazą danych
    include('cfg.php');

    $id = $_POST['updateId'];
    $title = $_POST['updateTitle'];
    $content = $_POST['updateContent'];


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


//     ------------------------------------------------------ DELETE PODSTRON ------------------------------------------------------

// Funkcja z podzapytaniem do usunięcia podstron
function queryDelete() {
     // Dołączenie configu z bazą danych
    include('cfg.php');
    $id = $_POST['idToDelete'];
    $query = "DELETE FROM `page_list` WHERE id=$id LIMIT 1";
    $result = mysqli_query($link, $query);
    return $result;
}

// Wyłączenie notice'ów i warningów
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 

//     ------------------------------------------------------ INSERT PODSTRON ------------------------------------------------------

// Funkcja z formularzem do dodania nowej podstrony
function insertForm() {
     // Dołączenie configu z bazą danych
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
    // Dołączenie configu z bazą danych
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
    echo UpdateCategoryForm();
    echo UpdateProductForm();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Jeśli Wykonano Update -- Wykonaj Update
        if(isset($_POST['updateId'])) {
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

        // Jeśli Wykonano Update Kategorii -- Wykonaj Update Kategorii
        if(isset($_POST['updateCategoryId'])) {
            echo queryUpdateCategory();
            echo "<script>";
            echo "alert('Pomyślnie zaaktualizowano kategorię ! ');";
            echo "window.location = 'http://localhost/Application/app/admin/admin.php';";
            echo "</script>" ;
            exit;
        }

        // Jeśli Wykonano Delete kategorii -- Wykonaj Delete kategorii
        if(isset($_POST['categoryIDdelete'])) {
            echo queryDeleteCategory();
            echo "<script>";
            echo "alert('Pomyślnie usunięto kategorię ! ');";
            echo "window.location = 'http://localhost/Application/app/admin/admin.php';";
            echo "</script>" ;
            exit;
        }

        // Jeśli Wykonano Insert kategorii -- Wykonaj Insert kategorii
        if(isset($_POST['insertMother'])) {
            echo queryInsertCategory();
            echo "<script>";
            echo "alert('Pomyślnie dodano kategorię ! ');";
            echo "window.location = 'http://localhost/Application/app/admin/admin.php';";
            echo "</script>" ;
            exit;
        }

        // Jeśli wykonano edycję produktu -- Wykonaj Update produktu
        if(isset($_POST['updatedProductId'])) {
            $message = queryUpdateProduct();
            $_SESSION['message'] = $message;
            echo "<script>";
            echo "alert('Pomyślnie zmieniono produkt ! ');";
            echo "window.location = 'http://localhost/Application/app/admin/admin.php';";
            echo "</script>" ;
            exit;
        }

        // Jeśli kliknięto usunięcie produktu -- Wykonaj Delete produktu
        if(isset($_POST['idProductToDelete'])) {
            $message = queryProductDelete();
            $_SESSION['message'] = $message;
            echo "<script>";
            echo "alert('Pomyślnie usunięto produkt ! ');";
            echo "window.location = 'http://localhost/Application/app/admin/admin.php';";
            echo "</script>" ;
            exit;
        }

        // Jeśli kliknięto dodanie produktu -- Wykonaj Insert produktu 
        if(isset($_POST['sizeInsert'])) {
            $message = queryInsertProduct();
            $_SESSION['message'] = $message;
            echo "<script>";
            echo "alert('Pomyślnie dodano produkt ! ');";
            echo "window.location = 'http://localhost/Application/app/admin/admin.php';";
            echo "</script>" ;
            exit;
        }

        // Jeśli dodano produkt do koszyka -- Dodaj zmienną z produktem do sesji
        if(isset($_POST['addedToCartProductId'])) {
            $message = addProductToCart();
            $_SESSION['message'] = $message;
            echo "<script>";
            echo "alert('Pomyślnie dodano produkt do koszyka ! ');";
            echo "</script>" ;
            exit;
        }

        // Jeśli usuwasz produkt z koszyka -- usuń go z sesji
        if (isset($_POST['productFromCartToDeleteId'])) {
            $message = removeFromCart();
            $_SESSION['message'] = $message;
            echo "<script>";
            echo "alert('Pomyślnie usunięto produkt do koszyka ! ');";
            echo "</script>" ;
            exit;
        }

    }

    // Wygenerowanie formularzu do insert'ów + podstron jeśli to niezbędne
    pokazWszystkiePodstrony();
    // Formularz z insertem dla podstron
    echo insertForm();
    // Wyświetlenie wszystkich KATEGORII oraz PODKATEGORII
    listOfCategories();
     // Formularz z insertem dla kategorii/podkategorii
    echo insertFormCategory();
    
    pokazTytulProdukty(1);
    productsList(1);
    pokazTytulProdukty(2);
    productsList(2);
    pokazTytulProdukty(3);
    productsList(3);
    echo insertProductForm();
    
    echo showCartContent();
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



// ******************************************************************************************************************************
// ********************************************************** KATEGORIE *********************************************************
// ******************************************************************************************************************************

// Aktualne rekordy w mojej bazie danych (kluby oraz ich zawodnicy) :
// Kategorie i podkategorie 
// Real Madryt      Barcelona       United         City        Arsenal         PSG          Chelsea              Bayern
//     |                |              |             |            |             |              |                   |
// Courtouis        Ter Stegen      De Gea         Stones       Saka          Mbappe        Sterling              Mane
// Carvajal         Araujo          Varane         De Bruyne    Odegaard      Messi         Aubameyang            Sane
// Kroos            Alba            Fernandes      Silva        Jesus         Neymar        Fofana                Neuer
// Modrić           Busquets        Casemiro       Foden        Martinelli    Ramos         Kante N'golo          Mueller
// Benzema          Pedri           Rashford       Mahrez                                   Mount                 Musiala
// Vini Jr          Lewandowski     Martial        Haaland                                  Cucurella             Coman
// Camavinga        Raphinha                       Alvarez                                  Koulibaly             Gnabry
// Militao          Dembele                        Walker                                                         De Light
// Alaba            


//     ----------------------------------------------------- SELECT KATEGORII -----------------------------------------------------


// Metoda do wyświetlenia wszystkich kategorii oraz podkategorii z bazy danych
function listOfCategories() {
    // Dołączenie configu z bazą danych
    include "cfg.php";

    $query="SELECT * FROM category WHERE mother = 0";

    $result=mysqli_query($link, $query);

    // Główna pętla
    while($row = mysqli_fetch_array($result)) {

        $id=$row['id'];
        $parent = $row['mother'];
        $name=$row['name'];

        $child_query = "SELECT * FROM category WHERE mother = $id";

        $child_categories = mysqli_query($link, $child_query);

        $wallpaper = './../assets/liverpool.png';

        // HTML pod wyświetlenie kategorii
        $page_result  = "
        <head>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head>

        <br><br><br><br>
        <div style='margin: auto; width: 30%;'>
            <table id='tableUnderCategories' class='table table-hover'>
                <thead>
                    <tr style='background-color: #333; color: white;'>
                        <th style='margin: auto; width: 15%;' scope='col'>ID KLUBU</th>
                        <th style='margin: auto; width: 15%;' scope='col'>NAZWA KLUBU</th>
                        <th style='margin: auto; width: 15%;' scope='col'>ZARZĄDZAJ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr background=".$wallpaper." style='color: white; opacity: 0.8;'> 
                        <td>".$id."</td>
                        <td>".$name."</td>
                        <td>
                            <form method='post'>
                                <input type='hidden' name='categoryID' value='".$id."'/>
                                <input type='hidden' name='categoryMother' value='".$mother."'/>
                                <input type='hidden' name='categoryName' value='".$name."'/>
                                <button type='submit' name='edit' class='btn btn-warning'>Edytuj Kategorię</button>
                            </form>
                            <form method='post'>
                                <input type='hidden' name='categoryIDdelete' value='".$id."'/>
                                <button type='submit' name='delete' class='btn btn-danger'>Usuń Kategorię</button>
                            </form>
                        </td>
                    </tr>       
                </tbody>
            </table>
        </div>
        ";
        echo $page_result;

        // Pętla dla podkategorii
        while ($child_row = mysqli_fetch_array($child_categories)) {

            $child_id = $child_row['id'];
            $child_mother = $child_row['mother'];
            $child_name = $child_row['name'];

            $wallpaper = './../assets/real-madrid-logo-wallpaper.jpg';
            $style = '';

            // Warunki pod zmianę tapety i stylów dla poszczególnych podkategorii (wszystko zależne od id matki)
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

            // HTML pod wyświetlenie podkategorii
            $children_result = "
            <head>
                <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet'>
            </head>

            <body>
                <table id='tableUnderCategories' class='table table-hover'>
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
                                    <input type='hidden' name='categoryID' value='".$child_id."'/>
                                    <input type='hidden' name='categoryMother' value='".$child_mother."'/>
                                    <input type='hidden' name='categoryName' value='".$child_name."'/>
                                    <button type='submit' name='edit' class='btn btn-warning'>Edytuj zawodnika</button>
                                </form>
                                <form method='post'>
                                    <input type='hidden' name='categoryIDdelete' value='".$child_id."'/>
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

//     ----------------------------------------------------- UPDATE KATEGORII -----------------------------------------------------


// Funkcja z formularzem do edycji dla KATEGORII/PODKATEGORII
function UpdateCategoryForm() {
    // Dołączenie configu z bazą danych
    include('cfg.php');
    if(empty($_POST['categoryID'])) {
        // console.log("UPDATE KATEGORII BRAK");
        return "";
    }

    $id = $_POST['categoryID'];
    $mother = $_POST['categoryMother'];
    // enkodowanie HTML'owe
    $name = htmlspecialchars($_POST['categoryName']);


    $update_form = 
    "
    <br>
    <br>
        <div>
        <div>
            <h1>Edytuj Kategorię/Podkategorię ".$name." o ID : ".$id."</h1>
            <form method='post'>
            <table class='table table-responsive-sm table-hover table-dark' style='height: 200px;'>
                <thead class='table-dark'>
                    <th><span class='text'>ID</span></th>
                    <th><span class='text'>Matka</span></th>
                    <th><span class='text' id='content'>Nazwa</span></th>
                </thead>
                <tbody>
                    <tr>
                        <td><input type='text' readonly value='".$id."' name='updateCategoryId'/></td>
                        <td><input type='text' name='update_category_mother' value='".$mother."'/></td>
                        <td><textarea style='height: 98%; width: 99%' name='update_category_name'>".$name." </textarea></td>
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

// Funkcja z podzapytaniem do edycji (dla kategorii)
function queryUpdateCategory() {
    // Dołączenie configu z bazą danych
    include('cfg.php');

    $id = $_POST['updateCategoryId'];
    $mother = $_POST['update_category_mother'];
    $name = $_POST['update_category_name'];

    // Dekodowanie w momencie pobierania zmiennej $content -- z uwagi na to, że query enkoduje znaki html'owe typu '<' lub ' " '...
    $query = "UPDATE `category` SET `mother`='".$mother."' , `name`=' ".html_entity_decode($name)." ' WHERE `id`=".$id." LIMIT 1";
    
    // W zapytaniach typu UPDATE, DELETE, SELECT zawsze używaj na koocu parametru LIMIT, np.
    // dla potrzeby naszego projektu CMSa należy użyd LIMIT 1, oznacza to że modyfikacji ulegnie pierwszy
    // znaleziony rekord. W przypadku gdy warunek jest „nieszczelny”, i brakuje opcji LIMIT, można
    // „wysadzid” sobie całą bazę – historia pełna jest takich przypadków. Chodzi o sytuacje, gdzie np.
    // wszystkie treści strony przez przypadek, lub w wyniku ataku SQL INJECTION są zastępowane np. NULLem
    $result = mysqli_query($link, $query);
    return $result;
}

//     ----------------------------------------------------- DELETE KATEGORII -----------------------------------------------------


// Funkcja z podzapytaniem do usunięcia kategorii/podkategorii
function queryDeleteCategory() {
    // Dołączenie configu z bazą danych
    include('cfg.php');
    $id = $_POST['categoryIDdelete'];
    $query = "DELETE FROM `category` WHERE id=$id LIMIT 1";
    $result = mysqli_query($link, $query);
    return $result;
}


//     ----------------------------------------------------- INSERT KATEGORII -----------------------------------------------------


// Funkcja z formularzem do dodania nowej podstrony
function insertFormCategory() {
    // Dołączenie configu z bazą danych
    include('cfg.php');

    $insertForm ='
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Dodaj Kolejną Kategorię</p>

                                <form method="post" class="mx-1 mx-md-4">

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" name="insertMother"/>
                                            <label class="form-label" for="form3">ID Matki</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <textarea style="height: 85%; width: 85%" name="insertName"></textarea>
                                            <label class="form-label" for="form3_2">Nazwa Kategorii</label>
                                        </div>
                                    </div>

                                    <div class="status" style="text-align: center">
                                    </div>
                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-success" name="insert">Dodaj Kategorię</button>
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

// Funkcja do wykonania podzapytania typu INSERT dla kategorii/podkategorii
function queryInsertCategory() {

    // Dołączenie configu z bazą danych
    include('cfg.php');
    
    $mother = $_POST['insertMother'];
    $name = $_POST['insertName'];

    $query = "INSERT INTO `category` (`mother`, `name`) values('$mother', '$name')";
    $result = mysqli_query($link, $query);

    return $result;
}




// ******************************************************************************************************************************
// ********************************************************** PRODUKTY **********************************************************
// ******************************************************************************************************************************



// Funkcja do wyświetlenia ładnego tytułu dla poszczególnych kategorii produktów
function pokazTytulProdukty($categoryId) {


    // Dołączenie configu z bazą danych
    include ("cfg.php");
    $result = '';
    if($categoryId == 1) {
        $result = 
        '
        <head>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <p class="text-center h1 fw-bold mx-md-4 mt-4">Piłki</p>
        ';
    }
    
    if($categoryId == 2) {
        $result = 
        '
        <head>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <p class="text-center h1 fw-bold mx-md-4 mt-4">Stroje</p>
        ';
    }
    else if($categoryId == 3){
        $result = 
        '
        <head>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>
        <p class="text-center h1 fw-bold mx-md-4 mt-4">Buty</p>
        ';
    }
    echo $result;
}

// Metoda do wyświetlenia produktów na podstawie id kategorii (1--> piłki, 2--> stroje, 3-->buty)
function productsList($categoryId) {
    // Dołączenie configu z bazą danych
    include ("cfg.php");

    // Pobranie danych z bazy (Zapytanie typu select)
    $query="SELECT * FROM product WHERE category = $categoryId";
    $resultQuery = mysqli_query($link, $query);

    // Główna pętla przelatująca po tabeli
    while($row = mysqli_fetch_array($resultQuery)) {

        // Przypisanie zmiennym wartości z rekordów
        $id = $row['id'];
        $title = $row['title'];
        $description = $row['description'];
        $creation_date = $row['creation_date'];
        $modification_date = $row['modification_date'];
        $expiration_date = $row['expiration_date'];
        $net_price = $row['net_price'];
        $value_added_tax = $row['value_added_tax'];
        $amount_in_magazine = $row['amount_in_magazine'];
        $availability = $row['availability'];
        $category = $row['category'];
        $size = $row['size'];
        $image = base64_encode($row['image']);

        // Warunki przez które produkt jest niedostępny
        // 1. Ilość przedmiotów jednego typu w magazynie jest mniejsza niż 1 (nie ma produktu na stanie)
        // 2. Data wygaśnięcia jest mniejsza niż aktualna (produkt wygasł)
        // Wtedy Status dostępności jest równy 0 (TinyInt) (produkt jest niedostępny z różnych powodów)
        if($amount_in_magazine <= 0 || date("Y-M-D", strtotime($expiration_date)) < date("Y-M-D")) {
            $availability = false;
        }
        
        // System dodawania do koszyka -> Produkt można dodać do koszyka tylko jeśli powyższe warunki nie są spełnione
        $addToCart = "";

        // Jeśli produkt jest niedostępny (ustawione to zostaje w powyższej metodzie) -> produktu nie można zakupić (niedostępny przycisk)
        if ($availability == false) {
            $addToCart = 
            "
            <button name='unavailable' class='btn btn-danger'>Produkt Aktualnie Niedostępny</button>
            ";
        }
        // W innym wypadku produkt można dodać do koszyka bezpośrednio po kliknięciu
        else {
            $addToCart = "
                <form method='post'>
                    <input type='hidden' name='addedToCartProductId' value='".$id."'/>
                    <input type='hidden' name='addedToCartAmountLeft' value='".$amount_in_magazine."'/>
                    <button type='submit' name ='addToCart' class='btn btn-primary'>Dodaj do koszyka</button>
                </form>";
        }

        // Wylistowanie produktów w HTML (tabela + przyciski) - dodany Bootstrap w wersji 5.2.1
        $listOfProducts  = "
        <head>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head>

        <div>
            <div>
                <table class='table table-responsive-sm table-hover' style = 'margin-right: 5px;'>
                    <thead class='table-dark'>
                        <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                            <span>ID</span>
                        </th>
                        <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                            <span>Tytuł</span>
                        </th>
                        <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                            <span>Opis Produktu</span>
                        </th>
                        <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                            <span>Data Utworzenia Produktu</span>
                        </th>
                        <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                            <span>Data Modyfikacji</span>
                        </th>
                        <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                            <span>Data Wygasnięcia</span>
                        </th >
                        <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                            <span>Cena netto</span>
                        </th>
                        <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                            <span>Podatek VAT</span>
                        </th>
                        <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                            <span>Ilość sztuk w magazynie</span>
                        </th>
                        <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                            <span>Dostępność</span>
                        </th>
                        <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                            <span>Kategoria</span>
                        </th>
                        <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                            <span>Wielkość</span>
                        </th>
                        <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                            <span>Zdjęcie Produktu</span>
                        </th>
                        <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                            <span>Zarządzaj</span>
                        </th>
                    </thead>
                    <tbody>
                        <tr> 
                            <td style='border: 1px;'>
                                <span style='font-size: small; margin-right: 15px;'>".$id."
                            </td>
                            <td style='border: 1px;'>
                                <span style='font-size: small; margin-right: 15px;'>$title
                            </td>
                            <td style='border: 1px;'>
                                <span style='font-size: small; margin-right: 15px;'>$description
                            </td>    
                            <td style='border: 1px;'>
                                <span style='font-size: small; margin-right: 15px;'>$creation_date
                            </td>
                            <td style='border: 1px;'>
                                <span style='font-size: small; margin-right: 15px;'>$modification_date
                            </td> 
                            <td style='border: 1px;'>
                                <span style='font-size: small; margin-right: 15px;'>$expiration_date
                            </td> 
                            <td style='border: 1px;'>
                                <span style='font-size: small; margin-right: 15px;'>$net_price
                            </td>
                            <td style='border: 1px;'>
                                <span style='font-size: small; margin-right: 15px;'>$value_added_tax
                            </td>
                            <td style='border: 1px;'>
                                <span style='font-size: small; margin-right: 15px;'>$amount_in_magazine
                            </td>
                            <td style='border: 1px;'>
                                <span style='font-size: small; margin-right: 15px;'>$availability
                            </td>
                            <td style='border: 1px;'>
                                <span style='font-size: small; margin-right: 15px;'>$category
                            </td>
                            <td style='border: 1px;'>
                                <span style='font-size: small; margin-right: 15px;'>$size
                            </td>
                            <td>
                                <img style='width: 150px; height: 150px; border: black;' src='data:image/jpeg;base64, $image'/>
                            </td>
                            <td>
                                <form method='post'>
                                    <input type='hidden' name='updatingId' value='".$id."'/>
                                    <input type='hidden' name='updatingTitle' value='".$title."'/>
                                    <input type='hidden' name='updatingDescription' value='".$description."'/>
                                    <input type='hidden' name='updatingCD' value='".$creation_date."'/>
                                    <input type='hidden' name='updatingMD' value='".$modification_date."'/>
                                    <input type='hidden' name='updatingED' value='".$expiration_date."'/>
                                    <input type='hidden' name='updatingNetPrice' value='".$net_price."'/>
                                    <input type='hidden' name='updatingValueAddedTax' value='".$value_added_tax."'/>
                                    <input type='hidden' name='updatingAmountInMagazine' value='".$amount_in_magazine."'/>
                                    <input type='hidden' name='updatingAvailability' value='".$availability."'/>
                                    <input type='hidden' name='updatingcategory' value='".$category."'/>
                                    <input type='hidden' name='updatingsize' value='".$size."'/>
                                    <input type='hidden' name='updatingImage' value='".$image."'/>
                                    <button type='submit' name='edit' class='btn btn-warning'>Edytuj Produkt</button>
                                </form>
                                <form method='post'>
                                    <input type='hidden' name='idProductToDelete' value='".$id."'/>
                                    <button type='submit' name='delete' class='btn btn-danger'>Skasuj Produkt</button>
                                </form>
                                $addToCart
                            </td>
                        </tr>       
                    </tbody>
                </table>
            </div>
        </div>
    ";
    echo $listOfProducts;
    }
}

//     ----------------------------------------------------- INSERT PRODUKTÓW -----------------------------------------------------


// Metoda z formularzem do wykonania zapytania INSERT dla Produktów
function insertProductForm() {
    // Dołączenie configu z bazą danych
    include ("cfg.php");


    // formularz w postaci HTML'a + bootstrap
    $insertForm = "
    <head>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css' rel='stylesheet'>
    </head>

    <br>
    <br>
    <br>
        <div>
            <div>
                <h2 style='text-align:center'>Dodaj Nowy Produkt</h2>
                <form method='post' enctype='multipart/form-data'>
                <table class='table table-responsive-sm table-hover table-dark' style='margin-right: 5px;'>
                <thead class='table-dark'>
                    <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                        <span>Tytuł</span>
                    </th>
                    <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                        <span>Opis Produktu</span>
                    </th>
                    <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                        <span>Data Utworzenia Produktu</span>
                    </th>
                    <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                        <span>Data Modyfikacji</span>
                    </th>
                    <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                        <span>Data Wygasnięcia</span>
                    </th >
                    <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                        <span>Cena netto</span>
                    </th>
                    <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                        <span>Podatek VAT</span>
                    </th>
                    <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                        <span>Ilość sztuk w magazynie</span>
                    </th>
                    <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                        <span>Dostępność</span>
                    </th>
                    <th style='border: 1px;'><span style='font-size: small; margin-right: 15px;'>
                        <span>Kategoria</span>
                    </th>
                    <th style='border: 1px;'><span style='font-size: small; margin-right: 5px;'>
                        <span>Wielkość</span>
                    </th>
                    <th style='border: 1px;'><span style='font-size: small; margin-left: -5px'>
                        <span>Zdjęcie Produktu</span>
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type='text' name='titleInsert'/>
                        </td>
                        <td>
                            <input type='text' name='descriptionInsert'/>
                        </td>
                        <td>
                            <input type='date' name='creationDateInsert'/>
                        </td>
                        <td>
                            <input type='date' name='modificationDateInsert'/>
                        </td>
                        <td>
                            <input type='date' name='expirationDateInsert'/>
                        </td>
                        <td>
                            <input type='number' name='netPriceInsert' style='width: 65%'/>
                        </td>
                        <td>
                            <input type='number' name='valueAddedTaxInsert' style='width: 55%'/>
                        </td>
                        <td>
                            <input type='number' name='amountInMagazineInsert' style='width: 55%'/>
                        </td>
                        <td>
                            <input type='text' name='availabilityInsert' value='' style='width: 45%'/>
                        </td>
                        <td>
                            <input type='text' name='categoryIDInsert' value='$categoryID' style='width: 45%'/>
                        </td>
                        <td>
                            <input type='number' name='sizeInsert' style='width: 45%;'/>
                        </td>
                        <td>
                            <input type='file' name='newIMAGE' style='width: 85%;'/>
                        </td>
                    </tr> 
                </tbody>
                </table>
                <button type='submit' name='add' class='btn btn-primary'>Dodaj Produkt</button>
                </form>
            </div>
        </div>
        ";
    return $insertForm;
}

// Wykonanie Query dla zapytanie typu INSERT - dla produktów
function queryInsertProduct() {
    // Dołączenie configu z bazą danych
    include('cfg.php');

    // Pobranie danych z formularza i jego inputów
    $title = $_POST['titleInsert'];
    $description = $_POST['descriptionInsert'];
    $creation_date = date('Y-m-d', strtotime($_POST['creationDateInsert']));
    $modification_date = date('Y-m-d', strtotime($_POST['modificationDateInsert']));
    $expiration_date = date('Y-m-d', strtotime($_POST['expirationDateInsert']));
    $net_price = $_POST['netPriceInsert'];
    $value_added_tax = $_POST['valueAddedTaxInsert'];
    $amount_in_magazine = $_POST['amountInMagazineInsert'];
    $availability = $_POST['availabilityInsert'];
    $category = $_POST['categoryIDInsert'];
    $size = $_POST['sizeInsert'];
    $image = bin2hex(file_get_contents($_FILES['newIMAGE']['tmp_name']));

    // Treść samego query
    $query = "INSERT INTO `product`
    (`title`, `description`, `creation_date`, `modification_date`,
    `expiration_date`, `net_price`, `value_added_tax`, `amount_in_magazine`,
    `availability`, `category`, `size`, `image`) VALUES 
            ('$title', '$description', '$creation_date', '$modification_date',
            '$expiration_date', $net_price, $value_added_tax, $amount_in_magazine,
            $availability, $category, $size, 0x$image)";    //hexdecimal

    // Wykonanie query na bazę - dodaj produkt
    $resultQuery = mysqli_query($link, $query);
    $_SESSION['query'] = $query;
}


//     ----------------------------------------------------- UPDATE PRODUKTÓW -----------------------------------------------------


// Metoda z formularzem do edycji produktu -> pobranie edytowanego produktu + sam formularz z edycją
function updateProductForm() {
     // Dołączenie configu z bazą danych
    include("cfg.php");

    // jeśli brak wywołania edycji -> nie wyświetlaj formularza
    if(empty($_POST['updatingId'])) {
        return "";
    }
    // w przeciwnym wypadku :

    // pobranie wartości z listy produktów (z zapytania typu select) - hidden inputy i atrybut 'name' w tagu <form>
    $id = $_POST['updatingId'];
    $title = $_POST['updatingTitle'];
    $description = $_POST['updatingDescription'];
    $creationDate = $_POST['updatingCD'];
    $modificationDate = $_POST['updatingMD'];
    $expirationDate = $_POST['updatingED'];
    $netPrice = $_POST['updatingNetPrice'];
    $valueAddedTax = $_POST['updatingValueAddedTax'];
    $amountInMagazine = $_POST['updatingAmountInMagazine'];
    $availability = $_POST['updatingAvailability'];
    $category = $_POST['updatingCategory'];
    $size = $_POST['updatingSize'];
    $image = $_POST['updatingImage'];

    //HTML pod sam formularz do edycji
    $edit_product_form = "
    <br>
    <br>
    <div>
        <div>
            <h1>Edytuj produkt '$title'</h1>
            <form method='post' enctype='multipart/form-data'>
                <table class='table table-responsive-sm table-hover table-dark'>
                    <thead class='table-dark'>
                        <th>
                            <span>ID</span>
                        </th>
                        <th>
                            <span>Tytuł</span>
                        </th>
                        <th>
                            <span>Opis Produktu</span>
                        </th>
                        <th>
                            <span>Data Utworzenia</span>
                        </th>
                        <th>
                            <span>Data Modyfikacji</span>
                        </th>
                        <th>
                            <span>Data Wygaszenia</span>
                        </th>
                        <th>
                            <span>Cena</span>
                        </th>
                        <th>
                            <span>Podatek VAT</span>
                        </th>
                        <th>
                            <span>Sztuk w Magazynie</span>
                        </th>
                        <th>
                            <span>Dostępny</span>
                        </th>
                        <th>
                            <span>Kategoria</span>
                        </th>
                        <th>
                            <span>Wielkość</span>
                        </th>
                        <th>
                            <span>Zdjęcie</span>
                        </th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input style='width: 100%' type='text' name='updatedProductId' readonly value='$id'/>
                            </td>
                            <td>
                                <textarea style='height: 98%; width: 99%;' name='updatedProductTitle'>".$title."</textarea>
                            </td>
                            <td>
                                <input style='width: 110%; height: 200%' name='updatedProductDescription' value='$description'/>
                            </td>
                            <td>
                                <input style='width: 85%' type='date' name='updatedProductCreationDate' value='$creationDate'/>
                            </td>
                            <td>
                                <input style='width: 85%' type='date' name='updatedProductModDate' value='$modificationDate'/>
                            </td>
                            <td>
                                <input style='width: 85%' type='date' name='updatedProductExpDate' value='$expirationDate'/>
                            </td>
                            <td>
                                <input style='width: 110%' type='number' name='updatedProductNet' value='$netPrice' step='0.01'/>
                            </td>
                            <td>
                                <input style='width: 100%' type='number' name='updatedProductValuetax' value='$valueAddedTax'/>
                            </td>
                            <td>
                                <input style='width: 65%' type='number' name='updatedProductAmount' value='$amountInMagazine'/>
                            </td>
                            <td>
                                <input style='width: 65%' type='text' name='updatedProductAvailability' value='$availability'/>
                            </td>
                            <td>
                                <input style='width: 65%' type='text' name='updatedProductCategory' value='$category'/>
                            </td>
                            <td>
                                <input style='width: 65%' type='number' name='updatedProductSize' value='$size'/>
                            </td>
                            <td>
                                <img style='width: 150px; height: 150px' src='data:image/jpeg;base64, $image'/>
                                <input type='hidden' name='nonupdatedimage' value='$image'>
                                <input type='file' name='updatedproductphoto' value='$image'/>
                            </td>
                        </tr>                     
                    </tbody>
                </table>
                <button type='submit' class='btn btn-primary'>Edytuj Produkt</button>
            </form>
        </div>
    </div>
    <br>
    <br>
    ";
    return $edit_product_form;
}

// Zapytanie typu Update do edycji produktu
function queryUpdateProduct() {
    // Dołączenie configu z bazą danych
    include('cfg.php');

    // pobranie wartości z post'a --> wszystko pochodzi z formularza do edycji, 1185
    $id = $_POST['updatedProductId'];
    $title = $_POST['updatedProductTitle'];
    $description = $_POST['updatedProductDescription'];
    $creationDate = $_POST['updatedProductCreationDate'];
    $modificationDate = $_POST['updatedProductModDate'];
    $expirationDate = $_POST['updatedProductExpDate'];
    $netPrice = $_POST['updatedProductNet'];
    $valueAddedTax = $_POST['updatedProductValuetax'];
    $amountInMagazine = $_POST['updatedProductAmount'];
    $availability = $_POST['updatedProductAvailability'];
    $category = $_POST['updatedProductCategory'];
    $size = $_POST['updatedProductSize'];
    // ->sprawdzenie czy podano plik z obrazem
    if($_FILES['updatedproductphoto']['tmp_name'] != ""
        && isset($_FILES['updatedproductphoto']['tmp_name'])) {
        // przekonwertowanie binarnych wartości na heksadecymalne do zdjęcia
        $image = bin2hex(file_get_contents($_FILES['updatedproductphoto']['tmp_name'])); // funkcja działa tylko przy !!!tmp_name!!! -> dla name lub innych wg. dokumentacji jest problem
    }
    else {
        // ->jeśli nie to przeładuj obraz poprzedni
        $image = bin2hex(base64_decode($_POST['nonupdatedimage']));
    }

    // wykonanie samego query typu update
    $query = "UPDATE `product` SET `title` = '".$title."', `description` = '".$description."', `creation_date` = '".$creationDate."', `modification_date` = '".$modificationDate."', `expiration_date` = '".$expirationDate."', `net_price` = ".$netPrice.", `value_added_tax` = ".$valueAddedTax.", `amount_in_magazine` = ".$amountInMagazine.", `availability` = ".$availability.", `category` = ".$category.", `size` = ".$size.", `image` = 0x$image WHERE `id` = ".$id." LIMIT 1";
    $result = mysqli_query($link, $query);

    return $result;
}


//     ----------------------------------------------------- DELETE PRODUKTÓW -----------------------------------------------------


// Funkcja z podzapytaniem typu DELETE do usunięcia produktu po ID
function queryProductDelete() {
    // Dołączenie configu z bazą danych
    include('cfg.php');
    // id pobierane jak w poprzednich query tego typu po id aktualnego rekordu
    // i kliknęciu w przycisk usunięcia (id pobierane jest z ukrytego inputa)
    $id = $_POST['idProductToDelete'];
    $query = "DELETE FROM `product` WHERE id = $id LIMIT 1";
    $result = mysqli_query($link, $query);
    return $result;
}




// ******************************************************************************************************************************
// *********************************************************** KOSZYK ***********************************************************
// ******************************************************************************************************************************


// Rozpoczęcie sesji pod koszyk, do sesji wrzucane będą produkty
session_start();

// Metoda do dodania produktu do koszyka, dolicza 1 produkt przy każdym dodaniu do koszyka
function addProductToCart() {

    // Jeśli przedmiotu jeszcze nie ma w koszyku, ustaw jego licznik na 1, w przeciwnym wypadku dodaj jeden
    if (!isset($_SESSION['count'])) {
        $_SESSION['count'] = 1;
    }
    else {
        $_SESSION['count'] ++;
    }

    // Licznik przedmiotu
    $itemCounter = $_SESSION['count'];
    // Id produktu z koszyka
    $productFromCartId = $_POST['addedToCartProductId'];
    // Ile pozostało w magazynie po dodaniu do koszyka
    $amountRest = $_POST['addedToCartAmountLeft'] - 1;
    // Modyfikacja liczby przedmiotów pozostałych w magazynie
    $update = updateAmountOfProduct($productFromCartId, $amountRest);

    // Ustawienie produktu do sesji z koszykiem -> zliczenie przedmiotów i rzeczywiste wrzucenie tego do sesji
    $set = false;
    // Zapisanie danych produktow z tablicy dwuwymiarowej - reszte pobierzemy po id_prod z bazy
    // $prod[$nr]['id_prod'] = $id_prod;
    // $prod[$nr]['ile'sztuk'] = $ile_sztuk;
    // $prod[$nr]['wielkosc'] = $wielkosc;
    // $prod[$nr]['data'] = time(); // pobranie aktualnego czasu

    // Zamiast numeracji na sztywno - pętla do momentu licznika przedmiotu
    for ($itemCount = 1; $itemCount <= $itemCounter; $itemCount++) {
        if($_SESSION['cart'][$itemCount]["id"]==$productFromCartId){
            $_SESSION['cart'][$itemCount]["amount"] ++;
            $set = true;
            break;
        }
    }
    // Jeśli nie udało się dopisać kolejnego produktu do koszyka to dopisz go jako pierwszy i ustaw amount na 1
    if(!$set) {
        $_SESSION['cart'][$itemCounter] = array('id' => $productFromCartId, 'amount' => 1);
    }
    return  "Produkt dodano do koszyka!";
}

// Metoda od usunięcia produktu z koszyka (sesji)
function removeFromCart() {

    // Pobranie id produktu do usunięcia (z posta inputa)
    $toDeleteId = $_POST['productFromCartToDeleteId'];
    // Wszystkie produkty z koszyka
    $products = $_SESSION['cart'];

    // Ustawienie pod zmienną warunku czy można usunąć dany produkt
    $canDelete = null;

    // Sprawdzenie czy id usuwanego produktu jest w sesji z koszykiem i jeśli tak to ustaw dla zmiennej ten produkt do usunięcia
    foreach ($products as $product) {
        if ($product['id'] == $toDeleteId) {
            $canDelete = $product;
        }
    }
    // Jeśli nie to nie usuwaj
    if ($canDelete == null) {
        return "";
    }

    // Pobranie z koszyka odpowiedniego produktu do usunięcia/pomniejszenia o ilość
    $itemCounter = array_search($canDelete, $products);
    // Wartość produktów w magazynie -> należy ją powiększyć o 1 skoro usuwamy produkt z koszyka
    $amount = $_POST['amountOfProductToDelete'] + 1;
    
    $toDeleteId = $_SESSION['cart'][$itemCounter]["id"];

    // W przypadku błędu
    if(!updateAmountOfProduct($toDeleteId, $amount)) {
        return "Nie udało się zmienić ilości produktu !";
    }

    // Zmniejszenie licznika z koszyka
    $_SESSION['cart'][$itemCounter]['amount'] --;
    $_SESSION['count'] --;

    // Wyrzucenie ostateczne produktu z koszyka -> unset w sesji dla obiektu
    if ($_SESSION['cart'][$itemCounter]['amount'] == 0) {
        unset( $_SESSION['cart'][$itemCounter]);
    }
    return "Pomyślnie wyrzucono z koszyka!";
}

// Metoda do wyświetlenia zawartości koszyka (obiekty z sesji)
function showCartContent() {
    // Dołączenie configu z bazą danych
    include("cfg.php");
    // Brutto dla całego koszyka
    $grossPriceCart = 0;
    // Wszystkie produkty
    $products = $_SESSION['cart'];

    // HTML pod wyświetlenie koszyka -> Najpierw Nagłówek jednorazowo
    $cartHTML .= "
    <br>
    <br>
    <div >
        <div>
            <h2 style='text-align:center'>Twój Koszyk</h2>
            <table class='table table-responsive-sm table-hover table-dark'>
                <thead class='table-dark'>                   
                    <th>
                        <span>Przedmiot</span>
                    </th>
                    <th>
                        <span>Brutto</span>
                    </th>
                    <th>
                        <span>Wybranych Sztuk</span>
                    </th>
                    <th>
                        <span>Zarządzaj Koszykiem</span>
                    </th>
                </thead>";

    // Następnie poszczególne wiersze z koszyka -> produkty po kolei
    foreach ($products as $product) {
        // Id produktu do przyszłego usunięcia
        $toDeleteId = $product["id"];
        // Liczba produktów w koszyku
        $amount = $product["amount"];
        // Pobranie produktu z bazy przy pomocy SELECT'a
        $query="SELECT * FROM `product` WHERE id = $toDeleteId LIMIT 1";
        // Wywołanie tego na bazie (połączenie z configu)
        $result=mysqli_query($link, $query);

        // Nadanie zmiennym wartości z select'a
        while($row = mysqli_fetch_array($result)) {
            $net = $row['net_price'];
            $vat = $row['value_added_tax'];
            $amountInMagazine = $row['amount_in_magazine'];
            $image = base64_encode($row['image']);
            $gross = $net+$net* ($vat/100);

            // Wyliczenie wartości brutto z całego koszyka
            $grossPriceCart += $gross * $amount;

            // Wyświetlenie rekordów po kolei
            $cartHTML .=  "        
                    <tbody'>
                        <tr> 
                            <td>
                                <img style='width: 75px; height: 75px' src='data:image/jpeg;base64, $image'/>
                            </td>
                            <td>
                                $gross
                            </td>
                            <td>
                                $amount
                            </td>
                            <td>
                                <form method='post'>
                                    <input type='hidden' name='productFromCartToDeleteId' value='". $toDeleteId ."'/>
                                    <input type='hidden' name='amountOfProductToDelete' value='".$amountInMagazine."'/>
                                    <button type='submit' class='btn btn-danger' name='delete'>Usuń produkt</button>
                                </form>
                            </td>
                        </tr>       
                    </tbody>

    ";
        }
    }

    // Wyświetlenie ceny po wyliczeniu w pętli
    $cartHTML.= '
            </table>   
        </div>
    </div>
<h4>Cena: '.$grossPriceCart.'zł</h4>';
    return $cartHTML;
}



// Metoda do edycji pozostałych produktów w magazynie
function updateAmountOfProduct($productId, $amountRest) {
    // Dołączenie configu z bazą danych
    include("cfg.php");

    // Wykonanie zapytania typu update do zmiany ilości produktów na stanie
    // (zmiana następuje po dodaniu produktu do koszyka bądź usunięciu go z niego)
    $query="UPDATE `product` SET `amount_in_magazine` = $amountRest WHERE `id` = $productId ";
    $resultQuery=mysqli_query($link, $query);
    if($resultQuery == true) {
        return true;
    }
    else {
        return false;
    }
}
?>
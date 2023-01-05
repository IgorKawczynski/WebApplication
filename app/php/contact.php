<?php 


// Funkcja do wyświetlenia formularza kontaktowego
function pokazKontakt() { 

    echo '
        <head>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="../../app/css/contact.css">
            <link rel="stylesheet" href="../../app/css/login.css">
            <script src="../../app/js/validation.js"></script>
        </head>

        <section class="vh-100" style="background-color: #eee;">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-xl-11">
                        <div class="card text-black" style="border-radius: 25px;">
                            <div class="card-body p-md-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                        <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Skontaktuj się</p>

                                        <form id="contact-form" name="contact-form" method="POST">

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="text" id="email" name="email" class="form-control">
                                                    <label for="email" class="">E-mail</label>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="text" id="subject" name="subject" class="form-control">
                                                    <label for="subject" class="">Temat</label>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <div class="md-form">
                                                        <textarea type="text" id="message" name="message" rows="2"
                                                            class="form-control md-textarea"></textarea>
                                                        <label for="message">Treść wiadomości</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="status" style="text-align: center">
                                            </div>

                                            <div class="status"></div>

                                            <p style="text-align: center; margin-top: 8px;">
                                                <input class="btn btn-success" type="submit" value="Wyślij">
                                            </p>

                                            <p style="text-align: center; margin-top: 8px;">
                                                <a href="mailto:igor.kawczynski@help.com"> Lub wyślij bezpośrednio</a>
                                            </p>

                                        </form>

                                    </div>
                                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                        <img src="https://www.egymerch.com/site_assets/assets/imgs/about/about.png"
                                            class="img-fluid" alt="Sample image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    ';

    // Wywołaj funkcję jeśli uzupełniłeś formularz
    if (isset($_POST['email'])){
        echo "<script>";
        echo "alert('Pomyślnie wysłano maila !');";
        echo "window.location = 'http://localhost/Application/?url=home';";
        echo "</script>" ;
        wyslijMailKontakt("igoreses12168@onet.pl");
    }
}

// Funkcja do wysłania maila 
function  wyslijMailKontakt($odbiorca) { 

    if (empty($_POST['subject']) || empty($_POST['message']) || empty($_POST['email']))
    {
        echo "<script>";
        echo "alert('Najpierw wypełnij maila !');";
        echo "window.location = 'http://localhost/Application/app/php/contact.php';";
        echo "</script>" ;
        // pokazKontakt(); // ponowne wywolanie formularza z wysłaniem wiadomości mail ---> zapętlone błędnie
    }
    else
    {
        $mail['subject'] = $_POST['subject'];
        $mail['body'] =  $_POST['message'];
        $mail['sender'] = $_POST['email'];
        $mail['reciptient'] = $odbiorca;

        $header = "From: Formularz kontaktowy <". $mail['sender']."\n";
        $header .= "MIME-Version: 1.0\ncontent-Type: text/plain; charset=utf-8\ncontent-Transfer-Encoding:";
        $header .= "X-Sender: <". $mail['sender'].">\n";
        $header .= "X-Mailer: PRapwww mail 1.2\n";
        $header .= "X-Priority: 3\n";
        $header .= "Return-Path: <". $mail['sender'].">\n";

        // Do poprawnego wysłania maila potrzeba skonfigurowanego SMTP...
        // ini_set('SMTP', "smtp.gmail.com");
        // ini_set('smtp_port', "25");
        // ini_set('sendmail_from', "kluseczkiwujka94@gmail.com");

        mail($mail['reciptient'], $mail['subject'], $mail['body'], $header);

        echo 'Wiadomość została pomyślnie wysłana !!';
    }
}

// Wywołanie formularza
pokazKontakt();

// Funkcja do przypomnienia hasła (wysyłka na maila)
function  przypomnijHaslo($odbiorca) { 

    $username = 'root';
    $password = 'root';

    $mail['subject'] = "Przypomnienie hasła ...";
    $mail['body'] =  $password;
    $mail['sender'] = $_POST['nadawca@gmail.com'];
    $mail['reciptient'] = $odbiorca; // ja odbiorca

    $header = "From: Przypomnienie hasla <". $mail['sender']."\n";
    $header .= "MIME-Version: 1.0\ncontent-Type: text/plain; charset=utf-8\ncontent-Transfer-Encoding:";
    $header .= "X-Sender: <". $mail['sender'].">\n";
    $header .= "X-Mailer: PRAPWWW mail 1.2\n";
    $header .= "X-Priority: 3\n";
    $header .= "Return-Path: <". $mail['sender'].">\n";

    mail($mail['reciptient'], $mail['subject'], $mail['body'], $header);
    echo 'Haslo zostalo wysłane na email : '.$mail["reciptient"].']';
}

echo 'Email do przypomnienia hasla<input type="text" class="form-control" name="emailTOP@gmejl.com">';
echo '<p><form action="" method="POST"><button class="btn btn-info" name="password">Przypomnij haslo</button></form></p>';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password'])) {
        echo "<script>";
        echo "alert('Na maila otrzymałeś wiadomość z kodem !');";
        echo "window.location = 'http://localhost/Application/?url=home';";
        echo "</script>" ;
        przypomnijHaslo($_POST['emailTOP@gmejl.com']);
    }
}
?>

<?php
$reviews = [];
$mysql = new mysqli('localhost', 'root', '', 'site');
$result = $mysql->query("SELECT name_client, message FROM message");
if ($result && $result->num_rows > 0) {
    $reviews = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
}
$mysql->close();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $text = $_POST['text'];
    $to = "your-email@example.com";
    $subject = "Новое сообщение с вашего сайта";
    $name_client = $_POST['name_client'];
    $message = $_POST['message'];
    if (!empty($name) && !empty($email) && !empty($text))
    {
        $body = "Имя: $name\n";
        $body .= "Email: $email\n";
        $body .= "Сообщение:\n$text";
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        mail($to, $subject, $body, $headers);
        header('Location: /index.php');
    }
    if (!empty($name_client) && !empty($message)) {
        $mysql = new mysqli('localhost', 'root', '', 'site'); 
        if ($mysql->connect_error) {
            $mysql->close();
            exit();
        }
        $mysql->query("INSERT INTO message (name_client, message) VALUES ('$name_client', '$message')");
        $mysql->close();
        header('Location: /index.php');
    }
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <link href="style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>Юрист ФИО</title>
        <style>
            .menu_:hover {
                background-color: #426ab3;
            }
            input.example_1:focus {
                color: #4472c4;
                outline:none;
            }
            textarea.example_1:focus {
                color: #4472c4;
                outline:none;
            }
            .modal_form, .modal_1, .modal_2, .modal_3, .modal_4, .modal_5, .modal_6, .modal_7, .modal_8 {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; 
            background-color: rgba(0, 0, 0, 0.4);
            }
            .modal-content {
                background-color: white;
                margin: 15% auto;
                padding: 0 1% 1.5% 1.5%;
                width: 50%;
                border-radius: 10px;
            }
            .modal-content-form {
                width: 40%;
                padding-bottom: 2%;
            }
            .close {
                color: #aaa;
                font-size: 30px;
                font-weight: 600;
                text-align: right;
            }
            .close:hover, .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
        </style>    
    </head>
    <body>
        <div style="margin-top: 1%; display: flex; justify-content: space-between; color: #4472c4; font-family:'Times New Roman', Times, serif; font-size: 30px; font-weight: 600">
            <div style="margin-left: 5%; text-align: center; font-size: 40px; color: #c45911; line-height: 1.3">
                <div style="font-size: 40px">Имя Фамилия</div>
                <div style="font-size: 35px">юрист</div>
            </div>
            <div style="display: flex">
                <img style="margin-top: 5px; margin-right: 5px; width: 30px; height: 30px" src="email.png">
                <div>urist@example.ru</div>
            </div>
            <div style="display: flex">
                <div>
                    <div>номер телефона</div>
                        <div style="display: flex">
                            <img style="margin-right: 3px; width: 30px; height: 30px" src="whatsapp.png">
                            <img style="width: 30px; height: 30px" src="telegram.png">
                        </div>
                </div>
            </div>
            <button id="btn_open_form" style="margin-right: 5%; margin-top: 0.5%; height: 50px; background-color: #c00000; color: white; font-size: 20px; padding-left: 1%; padding-right: 1%; font-weight: 600">ОСТАВИТЬ ЗАЯВКУ</button>
        </div>
        <div style="margin-top: 1%; display: flex; justify-content: center; border: 1px solid silver; background-color: #4472c4; color: white; font-family:'Times New Roman', Times, serif; font-size: 25px; font-weight: 600; text-align: center">
            <div class="menu_" style="padding: 1% 2% 1% 2%"><a style="text-decoration: none; color: white" href="#">ГЛАВНАЯ</a></div>
            <div class="menu_" style="padding: 1% 2% 1% 2%">
                <div><a style="text-decoration: none; color: white" href="#about_me">ВАШ ЮРИСТ</a></div> 
                <div><a style="text-decoration: none; color: white" href="#about_me">(обо мне)</a></div>
            </div>
            <div class="menu_" style="padding: 1% 2% 1% 2%"><a style="text-decoration: none; color: white" href="">ПРАКТИКА, ОТЗЫВЫ</a></div>
            <div class="menu_" style="padding: 1% 2% 1% 2%"><a style="text-decoration: none; color: white" href="#uslugi">УСЛУГИ</a></div>
            <div class="menu_" style="padding: 1% 2% 1% 2%"><a style="text-decoration: none; color: white" href="">ОПЛАТА</a></div>
        </div>
        <div style="margin-top: 2%; color: #c45911; font-family: 'Times New Roman', Times, serif; font-size: 35px; font-weight: 600; text-align: center">Юрист по гражданскому и административному праву </div>
        <div style="display: flex; justify-content: center; color: #bf8f00; font-family:'Times New Roman', Times, serif; font-size: 25px; font-weight: 600; text-align: center">
            <div style="padding: 2%; padding-right: 3%">
                <div>Гражданское право</div>
                <div>Семейные споры</div>
                <div>Наследственные споры</div>
                <div>Трудовые споры</div>
                <div>Жилищные споры</div>
                <div>Взыскание ущерба</div>
                <div>Взыскание долга</div>
            </div>
            <div style="padding: 2%">
                <div>Банкротство физических лиц</div>
                <div>Кредитные споры</div>
                <div>Взыскание компенсации вреда здоровью</div>
                <div>Защита чести и достоинства</div>
                <div>Защита прав автомобилистов</div>
                <div>Защита прав потребителей</div>
                <div>Административные споры</div>
            </div>
        </div>  
        <div id="uslugi" style="display: flex; justify-content: center; font-size: 25px; font-weight: 600; font-family:'Times New Roman', Times, serif">
            <div style="width: 20%; margin: 1%; border: 1px solid silver; border-radius: 10px">
                <img style="width: 100%; height: 250px; border-top-left-radius: 10px; border-top-right-radius: 10px" src="img_1.jpeg">
                <div style="height: 140px; padding: 4%; border-top: 1px solid silver">Исковые заявления, отзывы и возражения на иск</div>
                <button id="btn_modal_1" style="border-radius: 8px; margin-top: 1%; margin-left: 4%; margin-bottom: 5%; padding: 1% 3% 1% 3%; background-color: #4472c4; color: white; border: none; font-family:'Times New Roman', Times, serif; font-size: 20px">Подробнее</button>
            </div>
            <div style="width: 20%; margin: 1%; border: 1px solid silver; border-radius: 10px">
                <img style="width: 100%; height: 250px; border-top-left-radius: 10px; border-top-right-radius: 10px" src="img_2.jpg">
                <div style="height: 140px; padding: 4%; border-top: 1px solid silver">Жалобы, отмена заочного решения, отмена судебного приказа</div>
                <button id="btn_modal_2" style="border-radius: 8px; margin-top: 1%; margin-left: 4%; margin-bottom: 5%; padding: 1% 3% 1% 3%; background-color: #4472c4; color: white; border: none; font-family:'Times New Roman', Times, serif; font-size: 20px">Подробнее</button>
            </div>
            <div style="width: 20%; margin: 1%; border: 1px solid silver; border-radius: 10px">
                <img style="width: 100%; height: 250px; border-top-left-radius: 10px; border-top-right-radius: 10px" src="img_3.jpg">
                <div style="height: 140px; padding: 4%; border-top: 1px solid silver">Представительство в суде и в арбитражном суде</div>
                <button id="btn_modal_3" style="border-radius: 8px; margin-top: 1%; margin-left: 4%; margin-bottom: 5%; padding: 1% 3% 1% 3%; background-color: #4472c4; color: white; border: none; font-family:'Times New Roman', Times, serif; font-size: 20px">Подробнее</button>
            </div>
            <div style="width: 20%; margin: 1%; border: 1px solid silver; border-radius: 10px">
                <img style="width: 100%; height: 250px; border-top-left-radius: 10px; border-top-right-radius: 10px" src="img_4.jpeg">
                <div style="height: 140px; padding: 4%; border-top: 1px solid silver">Подготовка клиента к самостоятельному участию в судебном разбирательстве</div>
                <button id="btn_modal_4" style="border-radius: 8px; margin-top: 1%; margin-left: 4%; margin-bottom: 5%; padding: 1% 3% 1% 3%; background-color: #4472c4; color: white; border: none; font-family:'Times New Roman', Times, serif; font-size: 20px">Подробнее</button>
            </div>
        </div>
        <div style="display: flex; justify-content: center; font-size: 25px; font-weight: 600; font-family:'Times New Roman', Times, serif">
            <div style="width: 20%; margin: 1%; border: 1px solid silver; border-radius: 10px">
                <img style="width: 100%; height: 250px; border-top-left-radius: 10px; border-top-right-radius: 10px" src="img_5.jpg">
                <div style="height: 140px; padding: 4%; border-top: 1px solid silver">Составление договоров</div>
                <button id="btn_modal_5" style="border-radius: 8px; margin-top: 1%; margin-left: 4%; margin-bottom: 5%; padding: 1% 3% 1% 3%; background-color: #4472c4; color: white; border: none; font-family:'Times New Roman', Times, serif; font-size: 20px">Подробнее</button>
            </div>
            <div style="width: 20%; margin: 1%; border: 1px solid silver; border-radius: 10px">
                <img style="width: 100%; height: 250px; border-top-left-radius: 10px; border-top-right-radius: 10px" src="img_6.png">
                <div style="height: 140px; padding: 4%; border-top: 1px solid silver">Претензии</div>
                <button id="btn_modal_6" style="border-radius: 8px; margin-top: 1%; margin-left: 4%; margin-bottom: 5%; padding: 1% 3% 1% 3%; background-color: #4472c4; color: white; border: none; font-family:'Times New Roman', Times, serif; font-size: 20px">Подробнее</button>
            </div>
            <div style="width: 20%; margin: 1%; border: 1px solid silver; border-radius: 10px">
                <img style="width: 100%; height: 250px; border-top-left-radius: 10px; border-top-right-radius: 10px" src="img_7.jpg">
                <div style="height: 140px; padding: 4%; border-top: 1px solid silver">Консультирование</div>
                <button id="btn_modal_7" style="border-radius: 8px; margin-top: 1%; margin-left: 4%; margin-bottom: 5%; padding: 1% 3% 1% 3%; background-color: #4472c4; color: white; border: none; font-family:'Times New Roman', Times, serif; font-size: 20px">Подробнее</button>
            </div>
            <div style="width: 20%; margin: 1%; border: 1px solid silver; border-radius: 10px">
                <img style="width: 100%; height: 250px; border-top-left-radius: 10px; border-top-right-radius: 10px" src="img_8.jpg">
                <div style="height: 140px; padding: 4%; border-top: 1px solid silver">Представление интересов у судебного пристава-исполнителя</div>
                <button id="btn_modal_8" style="border-radius: 8px; margin-top: 1%; margin-left: 4%; margin-bottom: 5%; padding: 1% 3% 1% 3%; background-color: #4472c4; color: white; border: none; font-family:'Times New Roman', Times, serif; font-size: 20px">Подробнее</button>
            </div>
        </div>
        <div style="margin-top: 3%; margin-left: 3%; font-family:'Times New Roman', Times, serif; font-size: 27px; font-weight: 600">ВАШ ЮРИСТ</div>
        <div id="about_me" style="display: flex; justify-content: center; font-family:'Times New Roman', Times, serif">
            <div style="width: 45%; padding: 3%; font-size: 20px;">
                <p style="font-size: 25px; font-weight: 600">Рада Вас видеть на моей странице! Приветствую!</p>
                <p style="font-size: 25px; font-weight: 600">Я - ФИО</p>
                <p>Образование - высшее юридическое, университет, специализация</p>
                <p>Занимаюсь частной юридической практикой</p>
                <p>Основные направления моей деятельности:</p>
                <p>- представление интересов граждан и юридических лиц в судах общей юрисдикции и арбитражных судах по гражданским и административным делам и делам об административных правонарушениях</p>
                <p>- претензионная и договорная работа;</p>
                <p>- представление интересов в ходе исполнительного производства.</p>
                <p>Прием веду по адресу: адрес</p>
                <p>Запись по телефону: номер телефона</p>
                <p>ватсапп и телеграмм: номер телефона</p>
            </div>
        </div>
        <div id="Modal_form" class="modal_form">
            <div class="modal-content modal-content-form shadow">
                <span class="close">&times;</span>
                <form action=" " method="POST" style="padding: 3%; margin: auto; font-family:'Times New Roman', Times, serif; font-size: 27px; font-weight: 600">
                    <div>
                        <div style="margin-bottom: 7%; color: #4472c4; font-family:'Times New Roman', Times, serif; font-size: 27px; font-weight: 600;">Отправить заявку:</div>
                        <input type="text" name="name" class="example_1" style="width: 500px; border: none; border-bottom: 1px solid silver" placeholder="Имя" required>
                        <br>
                        <input type="email" name="email" class="example_1" style="width: 500px; border: none; border-bottom: 1px solid silver" placeholder="email" required>
                        <br>
                        <textarea type="text" name="text" class="example_1" style="width: 500px; border: none; border-bottom: 1px solid silver" placeholder="Опишите ваш вопрос" required></textarea>
                        <br>
                        <button type="submit" name="button" style="margin-top: 5%; padding: 1% 3% 1% 3%; background-color: #4472c4; color: white; border: none; font-family:'Times New Roman', Times, serif">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="Modal_1" class="modal_1">
            <div class="modal-content shadow">
                <span class="close">&times;</span>
                <div style="font-size: 25px; font-family:'Times New Roman', Times, serif">Исковые заявления, отзывы и возражения на иск</div>
            </div>
        </div>
        <div id="Modal_2" class="modal_2">
            <div class="modal-content shadow">
                <span class="close">&times;</span>
                <div style="font-size: 25px; font-family:'Times New Roman', Times, serif">Жалобы, отмена заочного решения, отмена судебного приказа</div>
            </div>
        </div>
        <div id="Modal_3" class="modal_3">
            <div class="modal-content shadow">
                <span class="close">&times;</span>
                <div style="font-size: 25px; font-family:'Times New Roman', Times, serif">Представительство в суде и в арбитражном суде</div>
            </div>
        </div>
        <div id="Modal_4" class="modal_4">
            <div class="modal-content shadow">
                <span class="close">&times;</span>
                <div style="font-size: 25px; font-family:'Times New Roman', Times, serif">Подготовка клиента к самостоятельному участию в судебном разбирательстве</div>
            </div>
        </div>
        <div id="Modal_5" class="modal_5">
            <div class="modal-content shadow">
                <span class="close">&times;</span>
                <div style="font-size: 25px; font-family:'Times New Roman', Times, serif">Составление договоров</div>
            </div>
        </div>
        <div id="Modal_6" class="modal_6">
            <div class="modal-content shadow">
                <span class="close">&times;</span>
                <div style="font-size: 25px; font-family:'Times New Roman', Times, serif">Претензии</div>
            </div>
        </div>
        <div id="Modal_7" class="modal_7">
            <div class="modal-content shadow">
                <span class="close">&times;</span>
                <div style="font-size: 25px; font-family:'Times New Roman', Times, serif">Консультирование</div>
            </div>
        </div>
        <div id="Modal_8" class="modal_8">
            <div class="modal-content shadow">
                <span class="close">&times;</span>
                <div style="font-size: 25px; font-family:'Times New Roman', Times, serif">Представление интересов у судебного пристава-исполнителя</div>
            </div>
        </div>
        <form action=" " method="POST">
            <div class="container" style="width: 500px">
                <h3 style="margin-bottom: 10%">Оставьте свой отзыв!</h3>
                <input type="text" name="name_client" class="form-control" style="width: 500px" placeholder="Имя" required>
                <br>
                <textarea type="text" name="message" class="form-control" style="width: 500px" placeholder="Текст отзыва" required></textarea>
                <button type="submit" name="button1" class="btn btn-primary" style="margin-top: 5%; padding: 1% 3% 1% 3%; background-color: #4472c4; color: white; border: none; font-family:'Times New Roman', Times, serif; font-size: 18px">Оставить отзыв</button>
            </div>
        </form>
        <?php foreach ($reviews as $review): ?>
            <div class="container card mt-5 mb-5" style="color: #3764b3; padding: 1%; width: 700px; font-family:'Times New Roman', Times, serif">
                <h4 style="font-weight: 600"><?= htmlspecialchars($review['name_client']) ?></h4>
                <div style="font-size: 21px"><?= htmlspecialchars($review['message']) ?></div>
            </div>
        <?php endforeach; ?>

        <script typt="text/javascript">
            document.getElementById("btn_open_form").onclick = function() {
                document.getElementById("Modal_form").style.display = "block";
                document.getElementsByClassName("close")[0].onclick = function() {
                    document.getElementById("Modal_form").style.display = "none";
                }
                window.onclick = function(event) {
                    if (event.target == document.getElementById("Modal_form")) {
                        document.getElementById("Modal_form").style.display = "none";
                    }
                }
            }
            document.getElementById("btn_modal_1").onclick = function() {
                document.getElementById("Modal_1").style.display = "block";
                document.getElementsByClassName("close")[1].onclick = function() {
                    document.getElementById("Modal_1").style.display = "none";
                }
                window.onclick = function(event) {
                    if (event.target == document.getElementById("Modal_1")) {
                        document.getElementById("Modal_1").style.display = "none";
                    }
                }
            }
            document.getElementById("btn_modal_2").onclick = function() {
                document.getElementById("Modal_2").style.display = "block";
                document.getElementsByClassName("close")[2].onclick = function() {
                    document.getElementById("Modal_2").style.display = "none";
                }
                window.onclick = function(event) {
                    if (event.target == document.getElementById("Modal_2")) {
                        document.getElementById("Modal_2").style.display = "none";
                    }
                }
            }
            document.getElementById("btn_modal_3").onclick = function() {
                document.getElementById("Modal_3").style.display = "block";
                document.getElementsByClassName("close")[3].onclick = function() {
                    document.getElementById("Modal_3").style.display = "none";
                }
                window.onclick = function(event) {
                    if (event.target == document.getElementById("Modal_3")) {
                        document.getElementById("Modal_3").style.display = "none";
                    }
                }
            }
            document.getElementById("btn_modal_4").onclick = function() {
                document.getElementById("Modal_4").style.display = "block";
                document.getElementsByClassName("close")[4].onclick = function() {
                    document.getElementById("Modal_4").style.display = "none";
                }
                window.onclick = function(event) {
                    if (event.target == document.getElementById("Modal_4")) {
                        document.getElementById("Modal_4").style.display = "none";
                    }
                }
            }
            document.getElementById("btn_modal_5").onclick = function() {
                document.getElementById("Modal_5").style.display = "block";
                document.getElementsByClassName("close")[5].onclick = function() {
                    document.getElementById("Modal_5").style.display = "none";
                }
                window.onclick = function(event) {
                    if (event.target == document.getElementById("Modal_5")) {
                        document.getElementById("Modal_5").style.display = "none";
                    }
                }
            }
            document.getElementById("btn_modal_6").onclick = function() {
                document.getElementById("Modal_6").style.display = "block";
                document.getElementsByClassName("close")[6].onclick = function() {
                    document.getElementById("Modal_6").style.display = "none";
                }
                window.onclick = function(event) {
                    if (event.target == document.getElementById("Modal_6")) {
                        document.getElementById("Modal_6").style.display = "none";
                    }
                }
            }
            document.getElementById("btn_modal_7").onclick = function() {
                document.getElementById("Modal_7").style.display = "block";
                document.getElementsByClassName("close")[7].onclick = function() {
                    document.getElementById("Modal_7").style.display = "none";
                }
                window.onclick = function(event) {
                    if (event.target == document.getElementById("Modal_7")) {
                        document.getElementById("Modal_7").style.display = "none";
                    }
                }
            }
            document.getElementById("btn_modal_8").onclick = function() {
                document.getElementById("Modal_8").style.display = "block";
                document.getElementsByClassName("close")[8].onclick = function() {
                    document.getElementById("Modal_8").style.display = "none";
                }
                window.onclick = function(event) {
                    if (event.target == document.getElementById("Modal_8")) {
                        document.getElementById("Modal_8").style.display = "none";
                    }
                }
            }
        </script>
    </body>
</html>






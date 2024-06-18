<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/contact.css">
    <link rel="stylesheet" href="./assets/css/style-menu-2.css">
    <link rel="stylesheet" href="./assets/css/style-footer.css">
    
    <title>Document</title>
</head>

<body>
    <div class="crapper">
        <?php
        require_once("page/menu-type-2.php");
        ?>
        <div class="banner">
            <img src="https://images.unsplash.com/photo-1616353071588-708dcff912e2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="">
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.4643596238984!2d106.68979851462254!3d10.77570249232202!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f3ab05e47d5%3A0x9c82c3e1a2036ad2!2zVHLGsMahbmcgxJDhu4tuaCwgQuG6v24gVGjDoG5oLCBRdeG6rW4gMSwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1647655964154!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="contact">
            <div class="feedback">
                <p style="font-size: 25px;"><b>Get in Touch</b></p>
                <form action="">
                    <textarea placeholder="Enter Message" name="" id="" cols="30" rows="10"></textarea>
                    <div class="form-fielde">
                        <input type="text" placeholder="Enter your name">
                        <input style="margin-left: 20px;" type="text" placeholder="Email">
                        <input type="text" style="width: 850px;" placeholder="Enter Subject">
                        <button>SEND</button>
                    </div>
                </form>
            </div>
            <div class="info">
                <div class="address" style="margin-top: 30px;">
                    <i class="fa-solid fa-house-chimney"></i>
                    <p><b>Trương Định, TP.HCM</b></p>
                    <p>13A, Phường Bến Nghé, Quận 1</p>
                </div>
                <div class="phone" style="margin-top: 30px;">
                    <i class="fa-solid fa-phone"></i>
                    <p><b>+84 327037178</b></p>
                    <p>Mon to Fri 8am to 21pm</p>
                </div>
                <div class="email" style="margin-top: 30px;">
                    <i class="fa-solid fa-envelope"></i>
                    <p><b>30Phonestore@gmail.com</b></p>
                    <p>Send us your query anytime!</p>
                </div>
            </div>
        </div>
    </div>
    <?php
    include("page/footer.php")
    ?>
    <div class="license">
        <p>Copyright @2021 All right reserved | This Template is madeby <i style="color: red;">30Phonestore</i></p>
    </div>
</body>

</html>
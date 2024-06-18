<?php
require_once ('./src/php/db/dbhelper.php');
require_once ('./src/php/util/utility.php');
require_once ('./src/php/modules/customer.php');

$flag = CustomerDAO::login(getPost('email1'), getPost('password1'));
$flag2 = CustomerDAO::signup(getPost('fullname'), getPost('email'),
getPost('password'), getPost('repass'), getPost('birthday'), getPost('phone'), getPost('question1'), getPost('answer1'));
$flag3 = CustomerDAO::retore(getPost('Email'), getPOST('question'), getPost('anwser'));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    
    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="./assets/css/form-login.css">

</head>

<body>

    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login 
                    <?php 
                        if($flag == 0){
                            echo ("<span style='color:red'>Login Fail</span>");
                        }
                        if($flag == 2) {
                            echo ("<span style='color:red'>Blocked Account</span>");
                        }
                    ?>
                </span>

                <form action="form-login.php" method="post" validate>
                    <div class="input-field">
                        <input type="text" name="email1" placeholder="Enter your email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password1" class="password" placeholder="Enter your password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>

                        <a href="#" class="text restore-link" onclick="appear()">Forgot password?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" value="Login Now">
                    </div>
                </form>

                <div class="login-signup">
                    <a href="didongVN.php" class="text signup-link">Back to home</a>
                    <span class="text">Not a member?
                        <a href="#" class="text signup-link">Signup now</a>
                    </span>
                </div>
            </div>
            <!-- Registration Form -->
            <div class="form signup">
                <span class="title">Registration 
                    <?php
                        if(!$flag2) {echo "<span style='color:red;'>Registration Fail</span>";}
                    ?>
                </span>

                <form action="form-login.php" method="post" validate>
                    <div class="form-content">
                        <div class="form-content-left">
                            <div class="input-field">
                                <input type="text" name="fullname" placeholder="Enter your name" required>
                                <i class="uil uil-user"></i>
                            </div>
                            <div class="input-field">
                                <input type="text" name="email" placeholder="Enter your email" required>
                                <i class="uil uil-envelope icon"></i>
                            </div>
                            <div class="input-field">
                                <input type="text" name="phone" class="" placeholder="Enter phone number" required>
                                <i class="uil uil-phone"></i>
                            </div>
                        </div>
                        <div class="form-content-right">
                            <div class="input-field">
                                <input type="date" name="birthday" class="password" placeholder="Enter birthday" required>
                                <i class="uil uil-gift"></i>

                            </div>
                            <div class="input-field">
                                <input type="password" name="password" class="password" placeholder="Create a password" required>
                                <i class="uil uil-lock icon"></i>
                            </div>
                            <div class="input-field">
                                <input type="password" name="repass" class="password" placeholder="Confirm a password" required>
                                <i class="uil uil-lock icon"></i>
                                <i class="uil uil-eye-slash showHidePw"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-select">
                        <select name="question1" id="" required>
                            <option value="">--Chọn câu hỏi--</option>
                            <option value="Trường cấp 2 của bạn là trường nào?">Trường cấp 2 của bạn là trường nào?</option>
                            <option value="Bạn có người yêu chưa?">Bạn có người yêu chưa?</option>
                            <option value="Món ăn yêu thích của bạn là gì?">Món ăn yêu thích của bạn là gì?</option>
                        </select>
                    </div>

                    <div class="input-field">
                        <input type="text" name="answer1" placeholder="Answer the question" required>
                        <i class="uil uil-question"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" value="Sign up">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">You have an account?
                        <a href="#" class="text login-link">Login</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modal">
        <div class="modal-overlay"></div>

        <div class="modal-body">
            <div class="modal-inner">
                <div class="form-register">
                    <form action="form-login.php" method="post" validate>
                        <span class="title">Retore password</span>
                        <div class="form-field2">
                            <input type="text" placeholder="Email" name="Email" required>
                        </div>
                        <div class="form-field2 select">
                            <select name="question" id="" required>
                                <option value="">--Chọn câu hỏi--</option>
                                <option value="Trường cấp 2 của bạn là trường nào?">Trường cấp 2 của bạn là trường nào?</option>
                                <option value="Bạn có người yêu chưa?">Bạn có người yêu chưa?</option>
                                <option value="Món ăn yêu thích của bạn là gì?">Món ăn yêu thích của bạn là gì?</option>
                            </select>
                        </div>
                        <div class="form-field2">
                            <input type="text" name="anwser" placeholder="Answer the question" required>
                        </div>
                        <div class="form-field button">
                            <input type="submit" value="Reset Password">
                        </div>
                        <div class="login1"><br>
                            <span class="text">Do you already have an account ?</span>
                            <a href="#" onclick="hide()">Login</a>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
    <script src="./src/js/login-signup.js"></script>
</body>

</html>
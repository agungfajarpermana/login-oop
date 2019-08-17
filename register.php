<?php
require_once "core/init.php";

if(Session::exists('username')){
    header("Location: profile.php");
}

if(Input::get("submit")){
    $error = [];
    // validation input
    $validations = new Validation();

    $validation = $validations->checkInput([
        'username' => [
            'required' => true,
            'min'      => 3,
            'max'      => 100
        ],

        'password' => [
            'required' => true,
            'min'      => 3
        ]
    ]);
    
    if($validations->passed()){
        $register = $user->register_user([
            'username' => Input::get('username'),
            'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT)
        ]);
        
        Session::set('username', Input::get('username'));
        header("Location: profile.php");

    }else{
        $error = $validations->errors();
    }
}

require_once "templates/header.php";
?>

<h4>Register Member</h4>

<br>

<form action="register.php" method="post">
    <label for="username">Username</label> <br>
    <input type="text" name="username"><br><br>
    
    <label for="password">Password</label> <br>
    <input type="password" name="password"><br><br>
    
    <input type="submit" name="submit" value="register">
</form>

<?php if(!empty($error)): ?>

    <div style="padding:20px;">
        <ul>
            <?php foreach($error as $errors): ?>
                <li><?php echo $errors; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php endif; ?>

<?php
require_once "templates/footer.php";
?>
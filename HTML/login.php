<?php
    require_once 'header.php';
?>
    <main>
        <div>
            <form action="">
                <div id="logo"><img src="../images/logoazul.png" alt="logo"></div>
                <h1>Login</h1>
                <hr>
                <label for="">email</label><br>
                <input type="email" name="" id=""><br>
                <label for="">senha</label><br>
                <input type="password" name="" id=""><br>
                <input type="checkbox" name="" id=""><p>manter logado</p>
                <input id="confirma" type="button" value="logar">
                <p id="senharecovery">esqueci a senha</p>
            </form>
        </div>
    </main>
    <?php
        require_once 'footer.php';
    ?>
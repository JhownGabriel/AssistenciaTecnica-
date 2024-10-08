<?php
    require_once 'header.php';
?>
    <main>
        <div>
            <form action="index.html">
                <div id="logo"><img src="../images/logoazul.png" alt="logo"></div>
                <h1>Cadastro</h1>
                <hr>
                <label for="">nome</label><br>
                <input type="text"><br>
                <label for="">email</label><br>
                <input type="email" name="" id=""><br>
                <label for="">senha</label><br>
                <input type="password" name="" id=""><br>
                <label for="">confirmar senha</label><br>
                <input type="password"><br>
                <a href="login.html" style="color: #FF9900;">login</a><br>
                <input id="confirma" type="button" value="Confirmar">
            </form>
        </div>
    </main>
    <?php
        require_once 'footer.php';
    ?>
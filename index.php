<!DOCTYPE html>
<html>
    <head>
        <title>Login V8</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">	
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
        <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">	
        <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
        <script src="vendor/animsition/js/animsition.min.js"></script>
        <script src="vendor/bootstrap/js/popper.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="vendor/select2/select2.min.js"></script>
        <script src="vendor/daterangepicker/moment.min.js"></script>
        <script src="vendor/daterangepicker/daterangepicker.js"></script>
        <script src="vendor/countdowntime/countdowntime.js"></script>
        <script src="js/main.js"></script>   
        <link rel="stylesheet" href="csoda.css">
    </head>
    <body>
        <?php
        require('dbcontroller.php');
        session_start();
        ?>
        <nav class="navbar navbar-expand-lg navbar-light bglight" id="navbar">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="navbar-brand" href="?menu=jatek">
                            <img src="kepek/kocsilogo.png" width="60" height="30" class="d-inline-block align-top" alt="">
                                Játék
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="navbar-brand" href="?menu=ranglista">Ranglista</a>
                    </li>
                    <li class="nav-item">
                        <a class="navbar-brand" href="?menu=jatekszabaly">Játékszabály</a>
                    </li>
                </ul>
            </div>
            <?php
            if(isset($_SESSION["Nev"])){
                ?>
                <p class="navbar-brand" style="color: white"><?php 
                    setlocale(LC_ALL, "hu_HU.UTF8");
                    $ido = explode(':', strftime("%X"))[0];
                    if ($ido > 5 and $ido < 9) {
                        echo"Jó reggelt ";
                    } else if ($ido > 8 and $ido < 19) {
                        echo"Jó napot ";
                    } else {
                        echo"Jó estét ";
                    }
                echo $_SESSION["Nev"] ?>!</p>
                <a class="navbar-brand" href="">Saját pontszámaim</a>
                <a class="navbar-brand" href="action.php?action=kijelentkezes">Kijelentkezés</a>
                <?php
            }
            else{
                ?>
                <a class="navbar-brand" href="?menu=bejelentkezes">Bejelentkezés</a>
                <?php
            }
            ?>
        </nav>
        <?php
        $pont = 0;
        switch ($_GET["menu"]) {
            case "bejelentkezes":
        ?>
                    <div class="limiter">
                        <div class="container-login100">
                            <div class="wrap-login100">
                                <form  method='post' class="login100-form validate-form p-l-55 p-r-55 p-t-178" id="form1" title="" action="action.php?action=bejelentkezes">
                                    <span class="login100-form-title">
                                        Bejelentkezés
                                    </span>
                                    <center><p id="hiba"></p></center>
                                    <div class="wrap-input100 validate-input m-b-16"  data-validate = "Kötelező!">
                                        <input class="input100" type="text" id="felh" name="felh" placeholder="Felhasznalónév">
                                        <span class="focus-input100"></span>
                                    </div>
                                    <div class="wrap-input100 validate-input m-b-16"  data-validate = "Kötelező!">
                                        <input class="input100" type="password" id="jelszo" name="jelszo" placeholder="Jelszó">
                                        <span class="focus-input100"></span>
                                    </div>
                                    <div class="container-login100-form-btn">
                                        <button class="login100-form-btn">
                                            Bejelentkezes
                                        </button>
                                    </div>
                                    <div class="flex-col-c p-t-40 p-b-40">
                                        <span class="txt1 p-b-9">
                                            Nincs még fiókod?
                                        </span>

                                        <a href="?menu=regisztrcio" class="txt3">
                                            Regisztrálj
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                    $("#form1").submit(function (event) {
                        event.preventDefault();
                        var a = {felh: $('#felh').val()};
                        var c = {jelszo: $('#jelszo').val()};
                        $.ajax({
                            url: "action.php?action=bejelentkezes",
                            method: "post",
                            data: {felh: a.felh, jelszo: c.jelszo},
                            success: function (data)
                            {
                                if (data == "") {
                                    window.location.assign("?menu=jatek")
                                } else {
                                    $('#hiba').html(data);
                                }
                            }
                        });

                    });
                    </script>
                <?php
            break;
            case "regisztrcio":
                ?>
                    <div class="limiter">
                        <div class="container-login100">
                            <div class="wrap-login100">
                            <form  method='post' class="login100-form validate-form p-l-55 p-r-55 p-t-178" id="form2" title="" action="action.php?action=regisztracio">
                                    <span class="login100-form-title">
                                        Regisztáció
                                    </span>
                                    <center><p id="hiba"></p></center>
                                    <div class="wrap-input100 validate-input m-b-16"  data-validate = "Kötelező!">
                                        <input class="input100" type="text" name="felh" id="felh" placeholder="Felhasznalónév">
                                        <span class="focus-input100"></span>
                                    </div>
                                    <div class="wrap-input100 validate-input m-b-16"  data-validate = "Kötelező!">
                                        <input class="input100" type="password" id="jelszoegy" name="jelszoegy" placeholder="Jelszó">
                                        <span class="focus-input100"></span>
                                    </div>
                                    <div class="wrap-input100 validate-input m-b-16"  data-validate = "Kötelező!">
                                        <input class="input100" type="password" id="jelszoketto" name="jelszoketto" placeholder="Jelszó">
                                        <span class="focus-input100"></span>
                                    </div>
                                    <div class="wrap-input100 validate-input m-b-16"  data-validate = "Kötelező!">
                                        <input class="input100" type="email" id="email" name="email" placeholder="Emailcím">
                                        <span class="focus-input100"></span>
                                    </div>
                                    <div class="container-login100-form-btn">
                                        <button class="login100-form-btn">
                                            Regisztáció
                                        </button>
                                    </div>
                                    <div class="flex-col-c p-t-40 p-b-40">
                                        <span class="txt1 p-b-9">
                                            Van már fiókod?
                                        </span>
                                        <a href="?menu=bejelentkezes" class="txt3">
                                            Bejelentkezés
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                    $("#form2").submit(function (event) {
                        event.preventDefault();
                        var a = {felh: $('#felh').val()};
                        var b = {jelszoegy: $('#jelszoegy').val()};
                        var c = {jelszoketto: $('#jelszoketto').val()};
                        var d = {email: $('#email').val()};
                        $.ajax({
                            url: "action.php?action=regisztracio",
                            method: "post",
                            data: {felh: a.felh, jelszoegy: b.jelszoegy, jelszoketto: c.jelszoketto, email: d.email},
                            success: function (data)
                            {
                                if (data == "") {
                                    window.location.assign("?menu=bejelentkezes")
                                } else {
                                    $('#hiba').html(data);
                                }
                            }
                        });

                    });
                    </script>
                <?php
            break;
            case "jatek":
        ?>
        <div id = "margin">
            <div id="jatekter"><canvas id="canvas" width="0" height="0"></canvas></div>
            <div id="jetekeleje">
                <center><img id="kicsikocsi" src="kepek/kicsikocsi.png"></center>
                <center><button onmousedown="startGame(), JEltuntet()" class="gomb">Start</button></center>
            </div>
            <div id="jatekvege">
                <center id="gratu">Gratulálok</center>
                <center id="Nev">
                    <?php
                        if(isset($_SESSION["Nev"])){
                            echo $_SESSION["Nev"]+"!";
                            $sql = "SELECT * FROM felhasznalo where Név = '" . $_SESSION["Nev"] . "'";
                            $result = $conn->query($sql);
                            $id;
                            if ($result->num_rows > 0) {
                                //-----------------------------------------------------------------------------------------------------------------------------------------
                            }
                        }
                        else{
                            echo "Vendég!";
                        }
                    ?>
                </center>
                <center><table class="customTable">
                <thead>
                    <tr>
                    <th>Összes Pont</th>
                    <th>Felvett érmék száma</th>
                    <th>Megtett út</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                    $ossz = $_COOKIE["megtettut"] + $_COOKIE["coin"];
                    $megtettut =  $_COOKIE["megtettut"] * 3;
                    $coindb = $_COOKIE["coin"] / 50;
                    echo "<td>". $ossz ." Pont</td>";
                    echo "<td>". $coindb ."db</td>";
                    echo "<td>". $megtettut ." m</td>";
                    ?>
                    </tr>
                </tbody>
                </table></center>
                <center><button onmousedown="startGame(), JEltuntet()" class="gomb">Új játék</button></center>
            </div>
        </div>
        <?php
            break;
            case "ranglista":
                ?>

                <?php
            break;
        }
        ?>
    </body>
</html>
<script>
    function JEltuntet() {
        var x = document.getElementById("jetekeleje");
        x.style.display = "none";
        var y = document.getElementById("jatekter");
        y.style.display = "block";
        var z = document.getElementById("jatekvege");
        z.style.display = "none";
    }
    var Kocsi;
    var Hatter;
    var Pontszam;
    var Hatterzaj;

    function startGame() {
        document.cookie = "megtettut=0";
        document.cookie = "coin=0";
        Kocsi = new component(150, 300, "kepek/piroskocsi.png", 500, 600, "image");
        Kocsi1 = new component(150, 300, "kepek/kekkocsi.png", 30000, 600, "image");
        Kocsi2 = new component(150, 300, "kepek/sargakocsi.png", 30000, 600, "image");
        Taxi = new component(150, 300, "kepek/taxi.png", 30000, 600, "image");
        Nyuszi = new component(38, 20, "kepek/nyuszi.png", 30000, 600, "image");
        Baleset = new component(250, 135, "kepek/baleset.png", 30000, 60 , "image");
        Kutya = new component(150, 50, "kepek/kutya.png", 30000, 0 , "image");
        Katyu = new component(50, 40, "kepek/katyu.png", 30000, 0 , "image");
        Busz = new component(160, 450, "kepek/busz.png", 30000, 0 , "image");
        Hatter = new component(1200, 22500, "kepek/ut.png", 0, 0, "background");
        AkadalyBal = new component(0, 2000, "kepek/akadalyszele.png", 175, 0, "image");
        AkadalyJobb = new component(0, 2000, "kepek/akadalyszele.png", 1025, 0, "image");
        AkadalyFent = new component(1200, 0, "kepek/akadalyteto.png", 0, 0, "image");
        AkadalyLent = new component(5000, 4, "kepek/akadalyteto.png", 0, 0, "image");
        Penz = new component(30, 30, "kepek/penz.png", 15000, 0, "image");
        Egyelet = new component(35, 35, "kepek/sziv+.png", 25, 25, "image");
        Ketelet = new component(35, 35, "kepek/sziv+.png", 65, 25, "image");
        Haromelet = new component(35, 35, "kepek/sziv+.png", 105, 25, "image");
        Egyeletminusz = new component(35, 35, "kepek/sziv-.png", 15000, 25, "image");
        Kettoeletminusz = new component(35, 35, "kepek/sziv-.png", 15000, 25, "image");
        Haromeletminusz = new component(35, 35, "kepek/sziv-.png", 15000, 25, "image");
        Pontszam = new component("25px", "Consolas", "black", 1050, 50, "text");
        Hatterzaj = new sound("kepek/hatterzaj.mp3");
        Coin = new sound("kepek/coin.mp3");
        Utkozes = new sound("kepek/utkozes.mp3");
        Uthiba = new sound("kepek/katyu.mp3");
        Hatterzaj.play();
        Jatekter.start();
    }

    var Jatekter = {
        canvas : document.getElementById("canvas"),
        start : function() {
            this.canvas.width = 1200;
            this.canvas.height = 750;
            this.context = this.canvas.getContext("2d");
            this.Megtettut = 0;
            this.penzszamol = 0;
            this.coinszamol = 0;
            this.elet = 0;
            this.sebesseg = 10;
            this.interval = setInterval(updateGameArea, 20);
            window.addEventListener('keydown', function (e) {
                e.preventDefault();
                Jatekter.keys = (Jatekter.keys || []);
                Jatekter.keys[e.keyCode] = (e.type == "keydown");
            })
            window.addEventListener('keyup', function (e) {
                Jatekter.keys[e.keyCode] = (e.type == "keydown");
            })
            },
        clear : function() {
            this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
        },
        stop : function() {
            clearInterval(this.interval);
        }
    }

    function component(width, height, color, x, y, type) {
        this.type = type;
        if (type == "image" || type == "background") {
            this.image = new Image();
            this.image.src = color;
        }
        this.width = width;
        this.height = height;
        this.speedX = 0;
        this.speedY = 0;    
        this.x = x;
        this.y = y;    
        this.update = function() {
            ctx = Jatekter.context;
            if(type == "text"){
                ctx.font = this.width + " " + this.height;
                ctx.fillStyle = color;
                ctx.fillText(this.text, this.x, this.y);
            }
            if (type == "image" || type == "background" ) { 
                ctx.drawImage(this.image, 
                this.x, 
                this.y,
                this.width, this.height);
                if (type == "background") { 
                    ctx.drawImage(this.image, 
                    this.x , 
                    this.y - this.height,
                    this.width, this.height);
                }
            } else {
                ctx.fillStyle = color;
                ctx.fillRect(this.x, this.y, this.width, this.height);
            }
        }
        this.newPos = function() {
            this.y += this.speedX;
            this.x += this.speedY;
            if (this.type == "background") {
                if (this.y == (this.height)) {
                    this.y = 0;
                }
            }
        }
        this.crashWith = function(otherobj) {
            var myleft = this.x;
            var myright = this.x + (this.width);
            var mytop = this.y;
            var mybottom = this.y + (this.height);
            var otherleft = otherobj.x;
            var otherright = otherobj.x + (otherobj.width);
            var othertop = otherobj.y;
            var otherbottom = otherobj.y + (otherobj.height);
            var crash = true;
            if ((mybottom < othertop) || (mytop > otherbottom) || (myright < otherleft) || (myleft > otherright)) {
                crash = false;
            }
            return crash;
        }    
    }

    function updateGameArea() {
        let hiba=0;
        if (Kocsi.crashWith(Baleset) || Kocsi.crashWith(Kutya) || Kocsi.crashWith(Kocsi1) || Kocsi.crashWith(Kocsi2) || Kocsi.crashWith(Nyuszi) || Kocsi.crashWith(Taxi) || Kocsi.crashWith(Busz)) {
            if(Kocsi.crashWith(Busz)){
                Busz.y=20000;
                Jatekter.elet++;
            }
            if(Kocsi.crashWith(Taxi)){
                Utkozes.play();
                Taxi.y=20000;
                Jatekter.elet++;
            }
            if(Kocsi.crashWith(Nyuszi)){
                Utkozes.play();
                Nyuszi.y=20000;
                Jatekter.elet++;
            }
            if(Kocsi.crashWith(Kutya)){
                Utkozes.play();
                Kutya.y=20000;
                Jatekter.elet++;
            }
            if(Kocsi.crashWith(Kocsi1)){
                Utkozes.play();
                Kocsi1.y=20000;
                Jatekter.elet++;
            }
            if(Kocsi.crashWith(Kocsi2)){
                Utkozes.play();
                Kocsi2.y=20000;
                Jatekter.elet++;
            }
            if(Kocsi.crashWith(Baleset)){
                Utkozes.play();
                Baleset.y=20000;
                Jatekter.elet++;
            }
            if(Kocsi.crashWith(Busz)){
                Utkozes.play();
                Busz.y=20000;
                Jatekter.elet++;
            }
            if(Jatekter.elet == 1){
                Egyeletminusz.x = 105;
                Haromelet.x = 20000;
            }
            if(Jatekter.elet == 2){
                Kettoeletminusz.x = 65;
                Ketelet.x = 20000;
            }
            if(Jatekter.elet == 3){
                Haromeletminusz.x = 25;
                Haromelet.x = 20000;
            }
            //--------------------------------------------------------------------------------------------------------------------------------------------------------------
            if(Jatekter.elet >= 4){
                Hatterzaj.stop();
                Jatekter.stop();
                var y = document.getElementById("jatekter");
                y.style.display = "none";
                
                //--------------------------------------------------------------------------------------------------------------------------------------------------------------
                document.cookie = "megtettut="+Math.round(Jatekter.Megtettut)+"";
                document.cookie = "coin="+Jatekter.coinszamol+"";
                var x = document.getElementById("jatekvege");
                x.style.display = "block";
                //--------------------------------------------------------------------------------------------------------------------------------------------------------------
            
            }
        } 
        
        else {
            if(Kocsi.crashWith(Katyu)){
                if(Math.floor(Math.random() * 10) % 2 == 0){
                    Uthiba.play();
                    hiba++;
                    Kocsi.speedX = -5;
                }else{
                    Uthiba.play();
                    hiba++;
                    Kocsi.speedY = 5;
                }
            }
            if(Jatekter.Megtettut % 50 == 0 && Jatekter.sebesseg <= 17){
                Jatekter.sebesseg += 1;
            }
            Jatekter.clear();
            Jatekter.Megtettut += 0.1;
            AkadalyBal.y = 0;
            AkadalyJobb.y = 0;
            AkadalyFent.y = -100;
            AkadalyLent.y = 1000;
            Kutya.y += 10;
            Kutya.x += 10;
            Nyuszi.y += 10;
            Nyuszi.x -= 8;
            Baleset.y += 10;
            Katyu.y += 10;
            Busz.y += 5;
            Penz.y += 10;
            Kocsi1.y +=  Jatekter.sebesseg-4;
            Kocsi2.y +=  Jatekter.sebesseg-3;
            Taxi.y +=  Jatekter.sebesseg-3;
            if(Penz.y > 2000){
                penzszamol = 0;
                Penz.y = -500;
                Penz.x = Math.floor(Math.random() * 300)+200;
            }
            if (Kocsi.crashWith(Penz) && penzszamol == 0){
                penzszamol ++;
                Jatekter.coinszamol += 50;
                Coin.play();
                Penz.x = 20000
            }
            if(Baleset.y > 37633){
                Baleset.y = -500;
                Baleset.x = Math.floor(Math.random() * 300)+200;
            }
            if(Katyu.y > 750){
                Katyu.y = -500;
                Katyu.x = Math.floor(Math.random() * 300)+200;
            }
            if(Kutya.y > 65713){
                Kutya.y = -250;
                Kutya.x = 0;
            }
            if(Nyuszi.y > 69313 ){
                Nyuszi.y = -75;
                Nyuszi.x = 2000;
            }
            if(Busz.y > 13669 ){
                Busz.y = -500;
                Busz.x = Math.floor(Math.random() * 300)+200;
            }
            if(Kocsi1.y > 1501){
                Kocsi1.y = -650;
                Kocsi1.x = Math.floor(Math.random() * 300)+200;
            }
            if(Kocsi2.y > 5281){
                Kocsi2.y = -650;
                Kocsi2.x = Math.floor(Math.random() * 300)+200;
            }
            if(Taxi.y > 9461){
                Taxi.y = -500;
                Taxi.x = Math.floor(Math.random() * 300)+200;
            }
            if(Kocsi.crashWith(AkadalyBal)){
                Kocsi.speedY = 10
            }
            Hatter.speedX = 10;
            Hatter.newPos();    
            Hatter.update();
            //-----------------------------------------------------------------------------------
            //--------------------             Irányítás            -----------------------------
            //-----------------------------------------------------------------------------------
            if (Jatekter.keys && Jatekter.keys[37]) {
                if(Kocsi.crashWith(AkadalyBal)){
                    Kocsi.speedY = 0;
                }else{
                    Kocsi.speedY = -Jatekter.sebesseg;
                }
            }
            else if (Jatekter.keys && Jatekter.keys[39]) {
                if(Kocsi.crashWith(AkadalyJobb)){
                    Kocsi.speedY = 0;
                }else{
                    Kocsi.speedY = Jatekter.sebesseg;
                }
            }
            
            else if (Jatekter.keys && Jatekter.keys[38]) 
            {
                if(Kocsi.crashWith(AkadalyFent)){
                    Kocsi.speedX = 0;
                }else{
                    Kocsi.speedX = -Jatekter.sebesseg;
                }
            }
            else if (Jatekter.keys && Jatekter.keys[40]) 
            { 
                if(Kocsi.crashWith(AkadalyLent)){
                    Kocsi.speedX = 0;
                }else{
                    Kocsi.speedX = Jatekter.sebesseg; 
                } 
            }
            else if (hiba == 0)
            {
                Kocsi.speedY = 0;
                Kocsi.speedX = 0;
            }
            Baleset.update();
            Kutya.update();
            Katyu.update();
            Busz.update();
            Kocsi1.update();
            Kocsi2.update();
            Taxi.update();
            Nyuszi.update();
            AkadalyBal.update();
            AkadalyJobb.update();
            AkadalyFent.update();
            Penz.update();
            AkadalyLent.update();
            Pontszam.text = "Pont: " + Math.round(Jatekter.Megtettut+Jatekter.coinszamol);
            Pontszam.update();
            Egyelet.update();
            Ketelet.update();
            Haromelet.update();
            Egyeletminusz.update();
            Kettoeletminusz.update();
            Haromeletminusz.update();
            Kocsi.newPos();    
            Kocsi.update();
            
        }
    }

    function sound(src) {
        this.sound = document.createElement("audio");
        this.sound.src = src;
        this.sound.setAttribute("preload", "loop");
        this.sound.setAttribute("controls", "none");
        this.sound.style.display = "none";
        document.body.appendChild(this.sound);
        this.play = function(){
            this.sound.play();
        }
        this.stop = function(){
            this.sound.pause();
        }    
    }
</script>
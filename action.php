<?php
session_start();
require('dbcontroller.php');
switch ($_GET["action"]) {
    case "regisztracio":
        if(!$_POST["felh"]){
            echo"Kötelező a felhasználónév!";
            break;
        }
        if(!$_POST["jelszoegy"]){
            echo"Kötelező a jelszó!";
            break;
        }
        if(!$_POST["jelszoketto"]){
            echo"Kötelező a jelszó!";
            break;
        }
        if(!$_POST["email"]){
            echo"Kötelező az email!";
            break;
        }
        $felh = $_POST["felh"];
        $jelszo1 = $_POST["jelszoegy"];
        $jelszo2 = $_POST["jelszoketto"];
        $email = $_POST["email"];
        if($jelszo1==$jelszo2){
            if(strlen($jelszo1) >= 6){
                $sql = "SELECT * FROM felhasznalo where Név = '" . $felh . "'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo"Ilyen felhasználónév már létezik!";
                    break;
                }
                else{
                    $sql = "SELECT * FROM felhasznalo where email = '" . $email . "'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo"Ilyen email már létezik!";
                        break;
                    }
                    else{
                        $sql = "INSERT INTO `felhasznalo` (`ID`, `Név`, `Email`, `Jelszo`) VALUES (NULL, '".$felh."', '".$email."', MD5('".$jelszo1."'));";
                        $result = $conn->query($sql);
                    }
                }
            }
            else{
                echo"Legalább 6 karakteres jelszó kell!";
            }
        }
        else{
            echo"A két jelszó nem eggyezik!";
        }
        
        break;
    case "bejelentkezes":
        if(!$_POST["felh"]){
            echo"Kötelező a felhasználónév!";
            break;
        }
        if(!$_POST["jelszo"]){
            echo"Kötelező a jelszó!";
            break;
        }
        else{
            $felh = $_POST["felh"];
            $jelszo = $_POST["jelszo"];
            $sql = "SELECT * FROM felhasznalo where Név = '" . $felh . "'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if (MD5($jelszo) == $row["Jelszo"]) {
                        $_SESSION["Nev"] = $row["Név"];
                        echo"Sikeres bejelentkézes";
                        ?>
                        <script>
                        window.location.assign("index.php?menu=jatek");
                        </script>
                        <?php
                    } 
                }
            } 
            else{
                echo"Hibás felhasználónév vagy jelszó!";
            }
        }
        break;
    case "kijelentkezes":
        session_destroy();
        header('Location: index.php?menu=bejelentkezes');
        break;
}
?>
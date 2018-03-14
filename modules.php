<?php
    
function site(){
    $site=filter_input(INPUT_GET, "site", FILTER_SANITIZE_SPECIAL_CHARS);
                    switch ($site){
                        case'':
                            Startseite();
                            break;
                        case'Kategorie':
                            KategorieSeite();
                            break;
                        case'showfrage':
                            showfrage();
                            break;
                        case'Eintragen':
                            Eintragen();
                            break;
                        case'uebermich':
                            uebermich();
                            break;
                        case'Suche':
                            Suche();
                            break;
                        case'loeschen': 
                            beitragloeschen();
                            break;
                        case'register':
                            registersite();
                            break;
                        case'fragestellen':
                            fragesite();
                            break;
                        default:
                            echo "<h1>(/.__.)/ ERROR 404 \(.__.\) </h1><br /><br />Die Seite kann leider nicht aufgerufen werden.  <a href=\"index.php\">Home</a>";
                            break;
                    }
}




/*---------------------------------Register Formular------------------------------------*/

function registerform(){
    echo "<form method=\"post\" id=\"loginform\">
            
            <label for=\"username\">Username: </label><input type=\"text\" name=\"username\" id=\"username\" class=\"login\" placeholder=\"Username\" /><br /><br />
            
            <label for=\"Email\">E-Mail: </label><input type=\"email\" name=\"email\" id=\"email\" class=\"login\" placeholder=\"E-Mail\" />  <br /><br />
            
            <label for=\"password\">Passwort: </label><input type=\"password\" name=\"password\" id=\"password\" class=\"login\" placeholder=\"Passwort\" />  <br /><br />
            <label for=\"passwordrepeat\">Passwort wiederholen: </label><input type=\"password\" name=\"passwordrepeat\" id=\"passwordrepeat\" class=\"login\" placeholder=\"Passwort\" />  <br /><br />
            
            <input type=\"submit\" class=\"buttons\" name=\"submitregister\" class=\"login\" value=\"Registrieren\"/>
    </form>";
}

/*------------------------------------------Register------------------------------------*/

function register($Benutzername, $email, $password){
     $password = password_hash($password, PASSWORD_DEFAULT);
     $eintrag = "INSERT INTO user (Username, Password, Email) VALUES ('$Benutzername', '$password', '$email')";
     global $verbindung;
     $eintragen = mysqli_query($verbindung, $eintrag);

     if($eintragen == true)
     {
        return true;
     }

}

/*---------------------------------Register Überprüfung---------------------------------*/

function issetregister(){
    if(isset ($_POST['submitregister'])){
        $Benutzername = $_POST['username'];
        $password=$_POST['password'];
        $anrede=$_POST['anrede'];
        $name=$_POST['name'];
        $vorname=$_POST['vorname'];
        $email=$_POST['email'];
        $adresse=$_POST['adress'];
        $plz=$_POST['plz'];
        $ort=$_POST['ort'];
        if(register ($Benutzername, $password, $anrede, $name, $vorname, $email, $adresse, $plz, $ort) == true){
            echo "Sie sind nun Registriert";
        }
        else{
            ?>
            <div id="Mitteilungreg">Geben sie bitte einen anderen Username ein dieser ist schon vergeben.</div>
            <?php
        }
    }
}


/* ----------------- Kontakt --------------------------------------*/


    function WebsiteText(){
        echo"
            <p class=\"WebsiteText\">Mein name ist Adrian Betschart. 
            Diese Seite habe ich in meiner Ausbildung als Informatiker im 2. Lehrjahr erstellt. 
            Der Auftrag wurde im Modul 133 von R. Hirschi erteilt. </p>
          ";
    }
    
    

  
    
/* -------------------------- Startseite Kategorien auslesen ----------------------- */

function Startseite(){
    
        $Startseiteinhalt = "
            SELECT * FROM StartseiteKategorien 
            ORDER BY ID;
        ";                 
        
        
        global $verbindung;
        $result = mysqli_query($verbindung, $Startseiteinhalt);


        while ($row = mysqli_fetch_assoc($result))
        {
            $KategorieName = $row['KategorieName'];
            $TrimmedName = str_replace(' ','',$KategorieName);
            $KategorieID = $row['ID'];   
            
            echo " <a href=\"index.php?site=Kategorie&category=$KategorieID\">        
                        <div class=\"box $TrimmedName\">
                            <div class=\"boxoverlay\">
                                $KategorieName
                            </div>
                        </div>
                    </a>";
        }


 
}
    
    
        
/* -------------------------- Suche anzeigen ----------------------- */

function Suche(){

        $Suchbegriff = $_POST['Suchbegriff'];
        if(str_replace(' ','',$Suchbegriff) == ""){
            header('Location: index.php');
        }
        
        $Shopinhalt = "
            SELECT * FROM nachrichten 
            WHERE Nachricht LIKE '%$Suchbegriff%'
            OR Autor LIKE '%$Suchbegriff%'
            OR Email LIKE '%$Suchbegriff%'
            OR IP LIKE '%$Suchbegriff%'
            OR Datum LIKE '%$Suchbegriff%'
            ORDER BY Datum DESC 
        ";                 
        
        global $verbindung;
        $Shopinhalt1 = mysqli_query($verbindung, $Shopinhalt);


        echo"<div class=\"beitraege-box\">";
        while($row = $Shopinhalt1->fetch_assoc())
        {   
            $ID = $row['ID'];
            $Autor = $row['Autor'];
            $Email =  $row['Email'];
            $IP = $row['IP'];
            $Nachricht = $row['Nachricht'];   
            $Datum = $row['Datum'];  
           
            echo "  
                    <div class=\"beitrag\">
                        <span class=\"beitragtext\">
                            Autor: $Autor<br />
                            Email: $Email<br />
                            Datum: $Datum<br />
                            IP: $IP<br /><br />
                            <hr>
                            <span class=\"nachricht\">$Nachricht</span><br />";
                            
            if($IP == $_SERVER['REMOTE_ADDR']){
                echo "</br><form action=\"index.php?site=loeschen\" method=\"post\">
                            <input type=\"hidden\" value=\"$ID\" name=\"id\">
                            <input type=\"submit\" value=\"Beitrag löschen\" name=\"submitloeschen\" id=\"loeschbutton\">
                        </form>
                
                ";
            }             
            echo "  
                        <span>
                    </div>";

        }

        echo "</div>";
}
    
/* -------------------------- Suchfeld ----------------------- */

function Suchfeld(){
    echo "
        <form action=\"index.php?site=Suche\" method=\"post\" id=\"suchform\">
            <input type=\"submit\" name=\"submitsuche\" value=\"\" id=\"suchesubmit\" />
            <input type=\"text\" name=\"Suchbegriff\" placehold er=\"Suche...\"  id=\"suchefeld\"/>
        </form>
        </br></br>
    ";
}




/* -------------------------- Form Beitrag erfassen ----------------------- */

function Eintragen(){
    echo "<form action=\"index.php\" method=\"post\" id=\"loginform\">
        <label for=\"name\">Name: </label><input type=\"text\" name=\"name\" id=\"name\" class=\"beitrageintrag\" placeholder=\"Name\" required /><br /><br />
        <label for=\"email\">E-Mail: </label><input type=\"email\" name=\"email\" id=\"email\" class=\"beitrageintrag\" placeholder=\"E-Mail\" required />  <br /><br />
        <label for=\"nachricht\">Nachricht: </label><br/>
        <textarea rows=\"4\" cols=\"50\"  name=\"nachricht\" id=\"nachricht\" class=\"login\" placeholder=\"Nachricht\" required></textarea> 
        <input type=\"submit\" class=\"buttons\" name=\"submitbeitrag\" class=\"login\" value=\"Beitrag posten\"/>
    </form>";
}



/* -------------------------- Beitrag erfassen ----------------------- */

function EintragErfassen(){
    if(isset ($_POST['submitbeitrag'])){
            if (! isset($_SERVER['HTTP_X_FORWARDED_FOR']) OR $_SERVER['HTTP_X_FORWARDED_FOR'] == "") {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            else {
                if(! isset($_SERVER['HTTP_X_FORWARDED_FOR']) OR $_SERVER['HTTP_X_FORWARDED_FOR'] == ""){
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                }    
                else{
                    $ip = "IP wurde nicht gefunden!";
                }
            }
            
            $Nachricht = $_POST['nachricht'];
            $Autor = $_POST['name'];
            $Email = $_POST['email'];
            $timestamp = time();
            $datum = date("Y-m-d H:i:s", $timestamp);
            $eintrag = "INSERT INTO nachrichten (Autor, Email, IP, Nachricht, Datum) VALUES ('$Autor', '$Email', '$ip', '$Nachricht', '$datum')";
            global $verbindung;
            $eintragen = mysqli_query($verbindung, $eintrag);
            
            if($eintragen == true)
            {
                header('Location: index.php');
            }
    }
}


/* -------------------------- Beitrag löschen ----------------------- */
function beitragloeschen(){
    if(isset($_POST['submitloeschen'])){
        $ID = $_POST['id'];
        $sql = "DELETE FROM nachrichten WHERE ID=$ID";
        global $verbindung;
        if (mysqli_query($verbindung, $sql)) {
            echo "Ihr Beitrag wurde gelöscht";
        } else {
            echo "Es gab einen Fehler beim Löschen: " . mysqli_error($verbindung);
        }
        
        
    }
}


/* -------------------------- Fragen der Kategorien anzeigen ----------------------- */

function KategorieSeite(){

    
    $kategorie=filter_input(INPUT_GET, "category", FILTER_SANITIZE_SPECIAL_CHARS);
                    switch ($kategorie){
                        case'':
                        case'1':
                            $KategorieInhalt = "SELECT * FROM Fragen ORDER BY Datum DESC";
                            break;
                        case'2':
                            $KategorieInhalt = "SELECT * FROM Fragen AS f WHERE (SELECT COUNT(*) FROM antworten AS a WHERE f.ID = a.FrageID) = 0 ORDER BY Datum";
                            break;
                        default:
                            $KategorieInhalt = "SELECT * FROM Fragen WHERE KategorieID = $kategorie ORDER BY Datum DESC";
                            break;
                    }
        global $verbindung;
        $result = mysqli_query($verbindung, $KategorieInhalt);


        while ($row = mysqli_fetch_assoc($result))
        {
            $Titel = $row['Titel'];
            $ID = $row['ID'];
            $Text = $row['Text'];
            if(strlen($Text)>43){
                $Teiltext = substr($Text, 0, 40);
                $Text = $Teiltext. "...";
            }
            
            echo "  
                    <a href=\"index.php?site=showfrage&frage=$ID\">  
                        <div class=\"box blue\">
                            <div class=\"boxoverlay\">
                                <span class=\"titel\">$Titel</span>
                                <br/>
                                <span class=\"text\">$Text </span> 
                            </div>
                        </div>
                    </a>";
        }


 
}



/* ------------------------------------- Seite auf welcher einzelne Fragen und Antowrten dazu angezeigt werden -------------- */


function showfrage(){
echo "<div class=\"tempsite\">";
    $frageID = $_GET['frage'];
    global $verbindung;
    $FrageInhalt = "SELECT * FROM Fragen WHERE ID = $frageID";
    $frageresult = mysqli_query($verbindung, $FrageInhalt);
    
    
    $row = mysqli_fetch_assoc($frageresult);
    $Titel = $row['Titel'];
    $Text = $row['Text'];
    $UserID = $row['UserId'];
    
    
    $UserInhalt = "SELECT Username FROM user WHERE ID = $UserID";
    $userresult = mysqli_query($verbindung, $UserInhalt);
    
    
    $userrow = mysqli_fetch_assoc($userresult);
    $username = $userrow['Username'];
            
    
    echo "  <h1>$Titel</h1>
            $Text <br/><br/> Frage von $username<br /><br /><br /><br />" ;
            
            
    $antwortenInhalt = "SELECT * FROM Antworten WHERE FrageID = $frageID";
    $antwortenresult = mysqli_query($verbindung, $antwortenInhalt);


    while ($antwortenrow = mysqli_fetch_assoc($antwortenresult))
    {
        $Antwort = $antwortenrow['Antwort'];
        $UserID = $antwortenrow['UserID'];
    
        $UserInhalt = "SELECT Username FROM user WHERE ID = $UserID";
        $userresult = mysqli_query($verbindung, $UserInhalt);
        
        $userrow = mysqli_fetch_assoc($userresult);
        $username = $userrow['Username'];
        
        echo " -------------------------------------------- </br></br> $Antwort</br></br> Answer by $username </br></br>";
    }
    
    if(isset($_SESSION['$username'])){ 
        if(isset($_POST['submitantwort'])){
            if(antwortgeben($_POST['antwort'], $frageID)){
                header("Location:".$_SERVER['REQUEST_URI']); 
            }   
            else{
                echo "Es ist etwas schief gelaufen, bitte versuchen sie noch einmal";
            }
        }
        
        antwortform();
        
    }
    else{
        echo "--------------------------------------------<br /><br />
            Bitte loggen sie sich ein um eine Antwort zu geben!";
    }   
    echo "</div>";
}


/* --------------------------- Form um auf Fragen zu antworten --------------------------------- */

function antwortform(){
    echo "  
        --------------------------------------------<br /><br />
            <form id=\"loginform\" method=\"post\">
                <textarea name = \"antwort\"  placeholder=\"Ihre Antwort...\"></textarea>
                <input type=\"submit\" name=\"submitantwort\" value=\"Antwort geben\" />
            </form>";
    
}

/* --------------------------- Eintragen der Antwort in die Datenbank --------------------------------- */


function antwortgeben($Antwort, $FrageID){
    
    global $verbindung;
    
    $Datum = date('Y-m-d H:i:s');
   
    $UserID = $_SESSION['$benutzerid'];
   
    $eintrag = "INSERT INTO antworten (Antwort, Datum, UserID, FrageID) VALUES ('$Antwort', '$Datum', '$UserID', '$FrageID')";
    
    $eintragen = mysqli_query($verbindung, $eintrag);

    if($eintragen == true)
    {
        return true;
    }  
}


/* -------------------------- Loginform oder Logindaten in Mitte der Navbox ----------------------- */

function Loginform(){
    if(isset($_SESSION['$username'])){
        echo "Sie sind eingeloggt als ". $_SESSION['$username'];
        echo "  
                    <form id=\"logoutform\" method=\"post\">
                        <input type=\"submit\" class=\"loginbutton\" name=\"logout\" value=\"LOG OUT\" />
                    </form>";
    }
    else{
        echo "  
                <div id=\"logindiv\">
                    <span class = \"LoginTitle\">Login</span>
                    <form id=\"loginform\" method=\"post\">
                        <input type=\"text\"  name = \"username\" class=\"input\" placeholder=\"Username\" /> 
                        <input type=\"password\" name = \"password\" class=\"input\" placeholder=\"Password\" />
                        <input type=\"submit\" class=\"loginbutton\" name=\"loginsubmit\" value=\"SIGN IN\" />
                    </form>
                    <a href=\"index.php?site=register\" class = \"LoginRegister\">Account erstellen!</a>
                </div>";
    }
}



/* ---------------------------------------------- Menu in der Navbox ----------------------------------- */

function menu(){

        $Menuinhalt = "
            SELECT * FROM menupunkte 
            ORDER BY ID;
        ";                 
        global $verbindung;
        $result = mysqli_query($verbindung, $Menuinhalt);

        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result))
        {
            $Menupunkt = $row['Name'];        
            $MenuLink = $row['Link']; 
            
            echo " <a href=\"$MenuLink\"><li>$Menupunkt</li></a>";
        }
        
        echo "</ul>";

 
}




/* ------------------------------- Funktionen für die Registrierungsseite --------------------------------*/

function registersite(){
    echo "<div class=\"tempsite\">";
    if(isset($_POST['submitregister'])){
        if($_POST['password'] == $_POST['passwordrepeat']){
            if(register($_POST['username'], $_POST['email'], $_POST['password'])){
                echo "Sie haben sich erfolgreich registriert!";
            }   
            else{
                echo "Es ist etwas schief gelaufen, bitte versuchen sie noch einmal";
            }
        }
        else{
            echo "Die Passwörter stimmen nicht überein!";
        }
    }
    else{
        registerform();
    }
    echo "</div>";
}


/* ------------------------------- Überprüft das Login --------------------------------------------------*/

function loginfunction(){
    if(isset($_POST['loginsubmit'])){
        login($_POST['username'], $_POST['password']);
    }
}


/*------------------------------- Setzt die Session beim Login ---------------------------------------- */

function login($username, $password ){
    $abfrage = "SELECT Password, ID FROM user WHERE Username = '$username'";
    global $verbindung;
    $ergebnis = mysqli_query($verbindung, $abfrage);        
    $row = mysqli_fetch_object($ergebnis);
    if($row) {
        if(password_verify ($password, $row->Password))
        {
            $_SESSION['$username'] = $username;
            $_SESSION['$benutzerid']= $row->ID;
            return true;
        }        
    }
}

/* --------------------------------- Zerstört Session -------------------------------------------------- */

function logoutfunction(){
    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        $_SESSION = array();
    }
}

/* ------------------------------------ Seite zum Fragen stellen --------------------------------------- */

function fragesite(){
    echo "<div class=\"tempsite\">";
    if(isset($_SESSION['$username'])){ 
        if(isset($_POST['submitfrage'])){
            if(fragestellen($_POST['Titel'], $_POST['Frage'], $_POST['Kategorie'])){
                echo "Ihre Frage wurde eingetragen!";
            }   
            else{
                echo "Es ist etwas schief gelaufen, bitte versuchen sie noch einmal";
            }
        }
        else{
            frageform();
        }
    }
    else{
        echo "Bitte loggen sie sich ein um eine Frage zu stellen!";
    }
    echo "</div>";
}


/* --------------------------------- Frageform --------------------------------------------- */

function frageform(){
    echo "<form method=\"post\" id=\"frageform\">
            
            <label for=\"Titel\">Ueberschrift für ihre Frage: </label><input type=\"text\" name=\"Titel\" id=\"Titel\" class=\"login\" placeholder=\"Ueberschrift\" /><br /><br />
            <label for=\"Frage\">Ihre Frage genauer erklärt: </label><br /><textarea name=\"Frage\" id=\"Frage\" class=\"login\" placeholder=\"Frage\"></textarea>  <br /><br />
            
            <label for=\"Kategorie\">Wählen Sie eine Kategorie: </label><select name=\"Kategorie\" id=\"Kategorie\">
            
            ";
            
            $KategorieInhalt = "SELECT * FROM startseitekategorien WHERE Auswahl = 1";
            global $verbindung;
            $result = mysqli_query($verbindung, $KategorieInhalt);


            while ($row = mysqli_fetch_assoc($result))
            {   
                
                echo "  <option>".$row['KategorieName']."</option> ";
            }
               
    echo "  </select>
            <input type=\"submit\"  name=\"submitfrage\" value=\"Frage stellen\" />
        
        </form>";
}

/* --------------------------- Die Frage in die Datenbank eintragen ----------------------------------- */

function fragestellen($Titel, $Frage, $Kategorie){
    global $verbindung;
    
    $KategorieInhalt = "SELECT ID FROM startseitekategorien WHERE KategorieName = '$Kategorie'";
            
    $result = mysqli_query($verbindung, $KategorieInhalt);
    $row = mysqli_fetch_assoc($result);
    
    $KategorieID = $row['ID'];
    
    $Datum = date('Y-m-d H:i:s');
   
    $UserID = $_SESSION['$benutzerid'];
   
    $eintrag = "INSERT INTO fragen (Titel, Text, KategorieID, Datum, UserId) VALUES ('$Titel', '$Frage', '$KategorieID', '$Datum', $UserID)";
    
    $eintragen = mysqli_query($verbindung, $eintrag);

    if($eintragen == true)
    {
        return true;
    }  
}
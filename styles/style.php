<?php
header("Content-type: text/css");
?>

html{
    padding: 0;
    margin: 0;
}


body{
    color: black;
    background-size: 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;
    font-family: Calibri; 
    padding: 0;
    margin: 0;
}


.box{
    width: 33.333%;
    height: 20vw;
    float: left;
    margin: 0;
    background-color: red;
    overflow: hidden; 
    color: rgba(0,0,0,0);
    font-size: 3vw;
    text-align: center;
}

.box:hover{
    color: white;
}

.boxoverlay{
    background-color: rgba(0,0,0,0);
    width: 100%;
    height: 100%;
    padding-top: 20%;
}

.boxoverlay:hover{
    background-color: rgba(0,0,0,0.8);
}


.text{
    font-size: 1.5vw;
}

.titel{
    color: white;
}


#nachricht{
	resize: none;
}


section{
    padding: 0;
}

main{
    position: absolute;
    left: 25%;
    height: 100%;
    width: 75%;
}

nav{
    position: fixed;
    width: 25%;
    height: 100%;
}


.navbox{
    height: 33.33%;
    width: 100%;
    float: left;
    background-color: #0E3DA8;
}


nav ul{
    width: 100%;
    float: left;
    padding: 0;
    margin: 0;
}

nav ul a{
    list-style-type: none;
    text-decoration: none;
    width: 100%;
}




<?php
    $verbindung = mysqli_connect("localhost", "root" , "", "besserefrageDB")
    or die("Verbindung zur Datenbank konnte nicht hergestellt werden");
    
        $Menuinhalt = "
            SELECT * FROM menupunkte 
            ORDER BY ID;
        ";                 
        
        $result = mysqli_query($verbindung, $Menuinhalt);
        $num_rows = mysqli_num_rows($result);
        
        $menuheight = 100 / 3 / $num_rows;
        
?>

nav ul li{
    background-color: #0E3DA8;
	color:#f5f5f5;
	display:inline-block;
	font-family:"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
	font-size:1.8vh;
	font-weight:bold;
	width:100%;
	text-align:center;
	line-height:<?php echo $menuheight; ?>vh;
	text-decoration:none;
	height: <?php echo $menuheight; ?>vh;
	border:none;
	outline:0;
	cursor: pointer;
}

nav ul li:hover{
    background-color: #0A3085;
}

.WebsiteText{
    color:#f5f5f5;
    text-decoration:none;
    font-family:"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
	font-size:1.8vh;
    margin: 10%; 
}

a{
    font-style: none;
}


footer{
}


#suchefeld{
  padding: 10px;
  border: solid 1px #dcdcdc;
  transition: box-shadow 0.3s, border 0.3s;
  float: right;
  margin-right: 10px;
}


#suchefeld:focus,
#suchefeld.focus {
  border: solid 1px blue;
  box-shadow: 0 0 5px 1px blue;
}


#suchesubmit{
    height: 35px;
    width: 35px;
    float: right;
    margin-right: 30px;
    background-image: url("../images/Suche.png"); 
    background-size: 93% 93%;
    background-repeat: no-repeat;
    background-position: 1px 1px;
    border-radius: 3px;
}


.beitrageintrag{
    position: absolute;
    left: 130px;
}


.nachricht{
    font-size: 25px;
    font-weight: semi bold;
}

.yellow{
    background-color: yellow;
}

.green{
    background-color: green;
}

.blue{
    background-color: darkblue;
}

#logindiv{
    background-color: lightgrey;
    padding-top: 3%;
    height: 100%;
    text-align: center;
}


#loginform{
	width:100%;
}
	
.input{
	width: 16vw;
    padding:1.6vh 1vw;
    font-family:"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
	background: #f5f5f5;
	border:none;
	color: #333;
	font-size: 1.2vh;
	margin-top:1.6vh;
}

.loginbutton{
	background-color:#0E3DA8;
	color: #f5f5f5;
	display:inline-block;
	font-family:"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
	font-size:1.4vh;
	font-weight:bold;
	width:18vw;
	text-align:center;
	line-height:1.6vh;
	text-decoration:none;
	height: 5.6vh;
	margin-top: 1.6vh;
	margin-bottom: 2.2vh;
	border:none;
	outline:0;
	cursor: pointer;
}

.loginbutton:active {
	position:relative;
	top:1px;
}

.loginbutton:hover{
	background-color:#0A3085;
}

.LoginTitle{
    font-family:"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
	font-size:2.6vh;
	font-weight:bold; 
    color: #0E3DA8;  
}

.LoginRegister{
    font-family:"Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
	font-size:1.6vh;
	font-weight:bold; 
    color: #0E3DA8;  
    text-decoration: none;
}

.LoginRegister{
    color: #0A3085;
}

.LoginContainer{
    width: 100%;
    text-align: center;
}

.lightgrey{
    background-color: lightgrey;
}




.fragebox{
    width: 100%;
    height: 20%;
    border: solid 2px black;
}

.tempsite{
    margin: 5%;
}

<?php
    $verbindung = mysqli_connect("localhost", "root" , "", "besserefrageDB")
    or die("Verbindung zur Datenbank konnte nicht hergestellt werden");
    
        $Startseiteinhalt = "
            SELECT * FROM StartseiteKategorien 
            ORDER BY ID;
        ";                 
        
        $result = mysqli_query($verbindung, $Startseiteinhalt);


        while ($row = mysqli_fetch_assoc($result))
        {
            $KategorieName = $row['KategorieName'];        
            $TrimmedName = str_replace(' ','',$KategorieName);
            
            echo ".$TrimmedName{
                    background-image: url(../images/$TrimmedName.jpg);
                    background-position: 0 0;
                    background-size: auto 100% ;
                    background-repeat: no-repeat;
                    background-color: white;
              }
              ";
        }
        ?>
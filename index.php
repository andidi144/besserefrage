<?php
/******************************
 * Autor: Adrian Betschart    *
 * Date: 17.12.2015           *
 * Time: 08:21                *
 ******************************/
include("dbconnect.php");

require_once("modules.php");
session_start();
date_default_timezone_set("Europe/Berlin");
loginfunction();
logoutfunction();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>besserefrage</title>
        <link rel="stylesheet" href="styles/style.php" />
    </head>
    <body> 
        <header>
            <nav>
                <div class="navbox menu">
                    <?php 
                        menu();
                    ?>
                </div>
                <div class="navbox lightgrey">
                    <?php 
                        loginform();
                      /*  <footer>
                        <a href="index.php?site=rechte" class="footer">Adrian Betschart &copy; 2015 </a>   
                    </footer> */
                    ?>   
                </div>
                <div class="navbox">
                    <?php 
                        WebsiteText();
                    ?>
                </div>
            </nav>
            
        </header>
        <main>
            <?php 
                site();
            ?>
        </main> 
        
    </body>        
</html>
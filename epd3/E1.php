<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            function radio($x){
                $num = $x;
                while(round($num, 1) >= 87.5){
                    $array[]= $num;
                    $num -= 0.2;
                }
                
                $num = $x + 0.2;
                while(round($num, 1) <= 108){
                    $array2[] = $num;
                    $num += 0.2;
                }             
                return $array + $array2;     
            }

            echo print_r(radio(100));
        ?>
    </body>
</html>

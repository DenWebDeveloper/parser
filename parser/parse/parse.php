<?php
if ($curl = curl_init()) {
    curl_setopt($curl, CURLOPT_URL, "http://avtobazar.infocar.ua/rastamozhka.html?type=1&valuta=1&price=" . $_GET['price'] . "&power=80&fuel=" . $_GET['fuel'] . "&motor=" . $_GET['motor'] . "&motor2=150&age=" . $_GET['age'] . "&newlaw=1");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $out = curl_exec($curl);
    curl_close($curl);

    if (preg_match_all('#<div id="countres">(.+?)</div>#is', mb_convert_encoding($out, "UTF-8", "windows-1251"), $data)) {
        echo $data[0][0];
    } else {
        echo "На данный момент недоступно или не все поля заполнени";
    }


} else {
    echo "На данный момент недоступно или не все поля заполнени";
}


?>

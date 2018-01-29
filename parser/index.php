<?php
// Настройки
$add_cost = 1200 + 30 + 280; // Добавочная цена
$undefinedPrice = 'На данный момент недоступно'; // если невозможно получить цену
// Полчаем аукционные сборы
if (isset($_POST['getCost'])) {
    $auction_id = $_POST['auction_id'];
    $auction_id = trim($auction_id);
    $auction_id = intval($auction_id);
    $price = $_POST['price'];
    $price = trim($price);
    $price = intval($price);
    if ($curl = curl_init()) {
        curl_setopt($curl, CURLOPT_URL, 'https://www.iaa.ge/?ajax=1&get=auction_fee&auction_id=' . $auction_id . '&car_price=' . $price . '');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $out = curl_exec($curl);
        curl_close($curl);
    } else {
        die(json_encode(['cost' => 0]));
    }
    SetCookie("insurance", (($out + $price) * 2 / 100));
    SetCookie("iaa", $out);
    $cost = $add_cost + $out + (($out + $price) * 2 / 100);
    die(json_encode(['cost' => $cost]));
}

if (isset($_GET['JSON'])) {
    json_encode(['response' => $response]);
}


?>
<!doctype html>
<html>

<head>
    <title>A-Cars Odessa</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/style.css"/>
</head>

<body>
<div class="left_form container" style="height:auto;">
    <div class="mf_inside col-sm-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
        <div class="lf_form form-horizontal">
            <div class="lff_part">
                <h3>A-Cars Odessa</h3>
                <h5>Тел/Viber: <a class="link" href="tel:+380634605550">+380 63 460 5550</a></h5>
                <hr>
                <div class="form-group">
                    <label>Аукцион</label>
                    <select class="custom-select auction form-control" id="calc_data1_select" name="calc_data1_select"
                            onchange="select_auction(this);get_calc();">
                        <option value="">Выберите аукцион</option>
                        <option value="4">COPART</option>
                        <option value="6">I A A I</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Цена</label>
                    <input type="text" name="price" class="form-control price-c" placeholder="Укажите цену">
                </div>
                <div class="form-group">
                    <label>Локация</label>
                    <select class="custom-select subauction form-control" style="width: 100%" id="calc_data2_select"
                            name="calc_data2_select" onchange="select_location(this);get_calc(this);">
                        <option value="">Выберите локацию</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Порт</label>
                    <select class="custom-select exit_port form-control" style="width: 100%" id="calc_data2_select"
                            name="calc_data2_select" onchange="get_calc(this);">
                        <option value="">Выберите порт</option>
                        <option value="1;USA Maiami;">FL Maiami</option>
                        <option value="2;USA GA;">GA Georgia</option>
                        <option value="3;USA NJ;07108">NJ New Jersey</option>
                        <option value="4;USA TX;">TX Texas</option>
                        <option value="5;US CA;">CA California</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Тип автомобиля</label>
                <select class="form-control price_selects" onchange="get_calc(this);">
                    <option value="price_3cars">Sedan (4CONT)</option>
                    <option value="price_2cars">SUV (3CONT)</option>
                </select>
            </div>
            <div class="select new_calc select_country" style="z-index:90000;">
                <div class="form-group">
                    <label>Страна</label>
                    <select class="form-control" onchange="select_country(this);get_calc();">
                        <option selected disabled>Выберите страну</option>
                        <option value="2">Ukraine</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label>Портовый город</label>
                <select class="custom-select subcountry form-control" style="width: 100%" id="calc_data2_select"
                        name="calc_data2_select" onchange="get_calc(this);">
                    <option value="">Выберите портовый город
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label>Тип двигателя</label>
                <select class="custom-select form-control" name="motor" id="motor">
                    <option value="500">0.5</option>
                    <option value="600">0.6</option>
                    <option value="700">0.7</option>
                    <option value="800">0.8</option>
                    <option value="900">0.9</option>
                    <option value="1000">1.0</option>
                    <option value="1100">1.1</option>
                    <option value="1200">1.2</option>
                    <option value="1300">1.3</option>
                    <option value="1400">1.4</option>
                    <option value="1500">1.5</option>
                    <option value="1600" selected="selected">1.6</option>
                    <option value="1700">1.7</option>
                    <option value="1800">1.8</option>
                    <option value="1900">1.9</option>
                    <option value="2000">2.0</option>
                    <option value="2100">2.1</option>
                    <option value="2200">2.2</option>
                    <option value="2300">2.3</option>
                    <option value="2400">2.4</option>
                    <option value="2500">2.5</option>
                    <option value="2600">2.6</option>
                    <option value="2700">2.7</option>
                    <option value="2800">2.8</option>
                    <option value="2900">2.9</option>
                    <option value="3000">3.0</option>
                    <option value="3100">3.1</option>
                    <option value="3200">3.2</option>
                    <option value="3300">3.3</option>
                    <option value="3400">3.4</option>
                    <option value="3500">3.5</option>
                    <option value="3600">3.6</option>
                    <option value="3700">3.7</option>
                    <option value="3800">3.8</option>
                    <option value="3900">3.9</option>
                    <option value="4000">4.0</option>
                    <option value="4100">4.1</option>
                    <option value="4200">4.2</option>
                    <option value="4300">4.3</option>
                    <option value="4400">4.4</option>
                    <option value="4500">4.5</option>
                    <option value="4600">4.6</option>
                    <option value="4700">4.7</option>
                    <option value="4800">4.8</option>
                    <option value="4900">4.9</option>
                    <option value="5000">5.0</option>
                    <option value="5100">5.1</option>
                    <option value="5200">5.2</option>
                    <option value="5300">5.3</option>
                    <option value="5400">5.4</option>
                    <option value="5500">5.5</option>
                    <option value="5600">5.6</option>
                    <option value="5700">5.7</option>
                    <option value="5800">5.8</option>
                    <option value="5900">5.9</option>
                    <option value="6000">6.0</option>
                    <option value="6100">6.1</option>
                    <option value="6200">6.2</option>
                    <option value="6300">6.3</option>
                    <option value="6400">6.4</option>
                    <option value="6500">6.5</option>
                    <option value="6600">6.6</option>
                    <option value="6700">6.7</option>
                    <option value="6800">6.8</option>
                    <option value="6900">6.9</option>
                    <option value="7000">7.0</option>
                    <option value="7100">7.1</option>
                    <option value="7200">7.2</option>
                    <option value="7300">7.3</option>
                    <option value="7400">7.4</option>
                    <option value="7500">7.5</option>
                    <option value="7600">7.6</option>
                    <option value="7700">7.7</option>
                    <option value="7800">7.8</option>
                    <option value="7900">7.9</option>
                    <option value="8000">8.0</option>
                    <option value="8100">8.1</option>
                    <option value="8200">8.2</option>
                    <option value="8300">8.3</option>
                    <option value="8400">8.4</option>
                    <option value="8500">8.5</option>
                    <option value="8600">8.6</option>
                    <option value="8700">8.7</option>
                    <option value="8800">8.8</option>
                    <option value="8900">8.9</option>
                    <option value="9000">9.0</option>
                    <option value="9100">9.1</option>
                    <option value="9200">9.2</option>
                    <option value="9300">9.3</option>
                    <option value="9400">9.4</option>
                    <option value="9500">9.5</option>
                    <option value="9600">9.6</option>
                    <option value="9700">9.7</option>
                    <option value="9800">9.8</option>
                    <option value="9900">9.9</option>
                    <option value="10000">10.0</option>
                    <option value="10100">10.1</option>
                    <option value="10200">10.2</option>
                    <option value="10300">10.3</option>
                    <option value="10400">10.4</option>
                    <option value="10500">10.5</option>
                    <option value="10600">10.6</option>
                    <option value="10700">10.7</option>
                    <option value="10800">10.8</option>
                    <option value="10900">10.9</option>
                    <option value="11000">11.0</option>
                    <option value="11100">11.1</option>
                    <option value="11200">11.2</option>
                    <option value="11300">11.3</option>
                    <option value="11400">11.4</option>
                    <option value="11500">11.5</option>
                    <option value="11600">11.6</option>
                    <option value="11700">11.7</option>
                    <option value="11800">11.8</option>
                    <option value="11900">11.9</option>
                    <option value="12000">12.0</option>
                    <option value="12100">12.1</option>
                    <option value="12200">12.2</option>
                    <option value="12300">12.3</option>
                    <option value="12400">12.4</option>
                    <option value="12500">12.5</option>
                    <option value="12600">12.6</option>
                    <option value="12700">12.7</option>
                    <option value="12800">12.8</option>
                    <option value="12900">12.9</option>
                    <option value="13000">13.0</option>
                    <option value="13100">13.1</option>
                    <option value="13200">13.2</option>
                    <option value="13300">13.3</option>
                    <option value="13400">13.4</option>
                    <option value="13500">13.5</option>
                    <option value="13600">13.6</option>
                    <option value="13700">13.7</option>
                    <option value="13800">13.8</option>
                    <option value="13900">13.9</option>
                    <option value="14000">14.0</option>
                    <option value="14100">14.1</option>
                    <option value="14200">14.2</option>
                    <option value="14300">14.3</option>
                    <option value="14400">14.4</option>
                    <option value="14500">14.5</option>
                    <option value="14600">14.6</option>
                    <option value="14700">14.7</option>
                    <option value="14800">14.8</option>
                    <option value="14900">14.9</option>
                    <option value="15000">15.0</option>
                    <option value="15100">15.1</option>
                    <option value="15200">15.2</option>
                    <option value="15300">15.3</option>
                    <option value="15400">15.4</option>
                    <option value="15500">15.5</option>
                    <option value="15600">15.6</option>
                    <option value="15700">15.7</option>
                    <option value="15800">15.8</option>
                    <option value="15900">15.9</option>
                    <option value="16000">16.0</option>
                    <option value="16100">16.1</option>
                    <option value="16200">16.2</option>
                    <option value="16300">16.3</option>
                    <option value="16400">16.4</option>
                    <option value="16500">16.5</option>
                    <option value="16600">16.6</option>
                    <option value="16700">16.7</option>
                    <option value="16800">16.8</option>
                    <option value="16900">16.9</option>
                    <option value="17000">17.0</option>
                    <option value="17100">17.1</option>
                    <option value="17200">17.2</option>
                    <option value="17300">17.3</option>
                    <option value="17400">17.4</option>
                    <option value="17500">17.5</option>
                    <option value="17600">17.6</option>
                    <option value="17700">17.7</option>
                    <option value="17800">17.8</option>
                    <option value="17900">17.9</option>
                    <option value="18000">18.0</option>
                    <option value="18100">18.1</option>
                    <option value="18200">18.2</option>
                    <option value="18300">18.3</option>
                    <option value="18400">18.4</option>
                    <option value="18500">18.5</option>
                    <option value="18600">18.6</option>
                    <option value="18700">18.7</option>
                    <option value="18800">18.8</option>
                    <option value="18900">18.9</option>
                    <option value="19000">19.0</option>
                    <option value="19100">19.1</option>
                    <option value="19200">19.2</option>
                    <option value="19300">19.3</option>
                    <option value="19400">19.4</option>
                    <option value="19500">19.5</option>
                    <option value="19600">19.6</option>
                    <option value="19700">19.7</option>
                    <option value="19800">19.8</option>
                    <option value="19900">19.9</option>
                    <option value="20000">20.0</option>
                </select>
            </div>
            <div class="form-group">
                <label>Топливо</label>
                <select class="custom-select form-control" id="fuel">
                    <option value="1">бензин</option>
                    <option value="2">дизель</option>
                </select>
            </div>
            <div class="form-group">
                <label>Возраст авто</label>
                <select class="custom-select form-control" id="age">
                    <option value="0">новое</option>
                    <option value="1">до 5 лет</option>
                    <option value="2">старше 5 лет</option>
                </select>
            </div>
            <div class="js-load">
                <div id="preloader">Загрузка...</div>
                <p class="error btn btn-danger" style="display:none;">Проверьте все поля</p>
                <button type="button" name="button" class="btn btn-success" id="sendparse">Рассчитать</button>
            </div>
            <div style="display:none;">
                <div class="total price_total" style="display:none;">
                    Итоговая цена: <b>-</b> <span>(за 1 авто)</span>
                </div>
            </div>
            <div class="total price_total_none" style="display:none;">
                Итоговая цена: <b><?php echo $undefinedPrice; ?></b>
            </div>
        </div>
    </div>
</div>
<div class="container list-price">
    <div class="list-price-title">
        <h3>A-Cars Odessa</h3>
        <h5>Тел/Viber: <a class="link" href="tel:+380634605550">+380 63 460 5550</a></h5>
    </div>
    <div class="row">
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Финальная ставка
                    <span class="badge badge-primary badge-pill" id="js-price"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Сбор аукциона
                    <span class="badge badge-primary badge-pill" id="iaa"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Страховка 2%
                    <span class="badge badge-primary badge-pill" id="insurance"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Доставка в Одессу
                    <span class="badge badge-primary badge-pill" id="type-odessa"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Доставка по США
                    <span class="badge badge-primary badge-pill" id="type-ground"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Вознаграждение A-Cars
                    <span class="badge badge-primary badge-pill" id="js-services"></span>
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Порт и таможня
                    <span class="badge badge-primary badge-pill">1200</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Возможный простой
                    <span class="badge badge-primary badge-pill">30</span>
                </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Растаможка
                    <span class="badge badge-primary badge-pill" id="customs-clearance"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Сертификация
                    <span class="badge badge-primary badge-pill">280</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Постановка на учет (налог в ПФ)
                    <span class="badge badge-primary badge-pill" id="js-tax"></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <strong>Итоговая цена "под-ключ" с
                        A-Cars Odessa</strong>
                    <span class="badge badge-primary badge-pill" id="type-ground"><div class="total_price">
                            <div class="text-center font-weight-bold">
                               <strong></strong>
                            </div>
                        </div></span>
                </li>
            </ul>
        </div>
        <div class="col-md-12 contacts">
            Тел/Viber: <a class="link" href="tel:+380634605550">+380 63 460 5550</a><br>
            Одесса, Сегедская 18
        </div>
    </div>
    <div class="user-btn">
        <button type="button" id="print" class="btn btn-warning">Печатать</button>
        <button type="button" id="btn-screenshot" class="btn btn-info">Cохранить</button>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="js/FileSaver.js"></script>
<script src="js/canvas-toBlob.js"></script>
<script src="js/screenshot.js"></script>
<!-- CalcJS -->
<script src="js/data.js"></script>
<script src="js/js.js"></script>
<script src="js/calc2.js"></script>
</body>

</html>

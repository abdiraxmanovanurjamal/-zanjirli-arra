if($data == "oplata"){
        bot('editMessageText',[
        'chat_id'=>$cid2,
        'message_id'=>$mid2,
        'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
       bot('editMessageText',[
      'chat_id'=>$cid2,
     'message_id'=>$mid2 + 1,
'text'=>"⏱ <b>Yuklanmoqda...</b>",
       'parse_mode'=>'html',
]);
     bot('editMessageText',[
        'chat_id'=>$cid2,
       'message_id'=>$mid2,
        'text'=>"*📋Quyidagilardan birini tanlang:*",
'parse_mode'=>"Markdown",
        'reply_markup'=>json_encode([
        'inline_keyboard'=>[
[['text'=>"🐤 Qiwi",'callback_data'=>"qiwi"],['text'=>"💠 Click",'callback_data'=>"click"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"menyu"]],
]
])
]);
}

if($data == "qiwi"){
$qiwi = file_get_contents("admin/qiwi.txt");
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"<b>📋 To'lov tizimi:</b> QIWI RUBL

<i>💳 Hamyon ( yoki karta ):</i> <code>+9989</code>
<i>📝 Izoh:</i> <code>$cid2</code>
<b>📊 B. V. Kursi:</b> <i>145 $valyuta</i>

<b>Qo'shimcha:</b> Almashuvingiz muvaffaqiyatli bajarilishi uchun quyidagi harakatlarni amalga oshiring: 
1) Istalgan pul miqdorini tepadagi Hamyonga tashlang
2) «✅ To'lov qildim» tugmasini bosing; 
3) Qancha pul miqdoni yuborganingizni kiriting;
4) Toʻlov haqidagi suratni botga yuboring;
5) Operator tomonidan almashuv tasdiqlanishini kuting.",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ To'lov qildim",'callback_data'=>"money"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]
])
]);
}

if($data == "click"){
$click = file_get_contents("admin/click.txt");
	bot('editMessageText',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	'text'=>"<b>📋 To'lov tizimi:</b> CLICK

<i>💳 Hamyon ( yoki karta ):</i> <code>$click</code>
<i>📝 Izoh:</i> <code>$cid2</code>
<b>📊 B. V. Kursi:</b> <i>1 $valyuta</i>

<b>Qo'shimcha:</b> Almashuvingiz muvaffaqiyatli bajarilishi uchun quyidagi harakatlarni amalga oshiring: 
1) Istalgan pul miqdorini tepadagi Hamyonga tashlang
2) «✅ To'lov qildim» tugmasini bosing; 
3) Qancha pul miqdoni yuborganingizni kiriting;
4) Toʻlov haqidagi suratni botga yuboring;
5) Operator tomonidan almashuv tasdiqlanishini kuting.",
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ To'lov qildim",'callback_data'=>"money"]],
[['text'=>"◀️ Orqaga",'callback_data'=>"orqa"]],
]
])
]);
}

if($data == "money"){

	bot('DeleteMessage',[
	'chat_id'=>$cid2,
	'message_id'=>$mid2,
	]);
	bot('SendMessage',[
	'chat_id'=>$cid2,
	'text'=>"<b>To'lov miqdorini kiriting:</b>",
	'parse_mode'=>'html',
'reply_markup'=>$back,
	]);
	file_put_contents("step/$cid2.step",'oplata');
}

if($step == "oplata"){
if(is_numeric($text)=="true"){
	file_put_contents("step/inew.txt",$text);
	file_put_contents("step/id.txt",$cid);
	bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>To'lovingizni chek yoki skreenshotini shu yerga yuboring:</b>",
	'parse_mode'=>'html',
	]);
	file_put_contents("step/$cid.step",'rasm');
}else{
bot('SendMessage',[
	'chat_id'=>$cid,
	'text'=>"<b>Qiymat qabul qilinmadi, qayta urinib ko'ring:</b>",
	'parse_mode'=>'html',
]);
}
}

if($step == "rasm"){
$photo = $message->photo;
$file = $photo[count($photo)-1]->file_id;
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"*Hisobni to'ldirganingiz haqida ma'lumot asosiy adminga yuborildi. Agar to'lovni amalga oshirganingiz haqida ma'lumot mavjud bo'lsa, hisobingiz to'ldiriladi.*",
'parse_mode'=>'MarkDown',
'reply_markup'=>$main_menu
]);
unlink("step/$cid.step");
    bot('sendPhoto',[
        'chat_id'=>$admin,
        'photo'=>$file,
        'caption'=>"📄 <b>Foydalanuvchidan check:

👮‍♂️ Foydalanuvchi:</b> <a href='https://t.me/$username'>$name</a>
🔎 <b>iD raqami:</b> $fid
💵 <b>To'lov miqdori:</b> $saved",
'disable_web_page_preview'=>true,
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"✅ Qabul qilindi",'callback_data'=>"on"],['text'=>"❌ Qabul qilinmadi",'callback_data'=>"off"]],
]
])
]);
}
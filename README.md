<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">php >= 8.0.2</p>
<p align="center">no database required</p>
<br/>
<p align="center">git clone https://github.com/MaximBrewer/chatbot.git</p>
<p align="center">composer install</p>
<br/>
<p align="center">put to .env</p>
<p align="center">TELEGRAM_BOT_KEY=bot_api_key</p>
<p align="center">TELEGRAM_BOT_HASH=create_own_hash_for_connect_group</p>
<p align="center">.env must contain</p>
<p align="center">APP_URL=https://your_domain</p>
<p align="center">for webhook</p>
<br/>
<p align="center">php artisan tg:webhookset</p>
<p align="center">it set webhook to https://your_domain/tg/webhook</p>
<p align="center">php artisan tg:webhookget</p>
<p align="center">to check webhook</p>
<br/>
<p align="center">add the bot to the group</p>
<p align="center">send a message from group with the hash above (create_own_hash_for_connect_group)</p>
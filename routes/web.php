<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Есть веб-api, непрерывно принимающее события (ограничимся 10000 событий) для группы аккаунтов (1000 аккаунтов) и складывающее их в очередь.
Каждое событие связано с определенным аккаунтом и важно, чтобы события аккаунта обрабатывались в том же порядке, в котором поступили в очередь.
Обработка события занимает 1 секунду (эмулировать с помощью sleep).
Сделать обработку очереди событий максимально быстрой на данной конкретной машине.
Код писать на PHP. Можно использовать фреймворки и инструменты такие как RabbitMQ, Redis, MySQL и т. д.

Решение(ссылку на github) отправить на почту i.sumbaev@bothelp.io
 */

Route::get('/', function () {
    return view('welcome');
});

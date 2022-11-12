<?php

namespace App\Http\Controllers;

use App\Models\User;
use RuntimeException;
use Illuminate\Http\Request;
use App\Jobs\HandleUserEventsJob;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreEventRequest;

class UserController extends Controller
{
    /**
     * @param StoreEventRequest $request
     *
     * @return JsonResponse
     */
    public function storeEvent(StoreEventRequest $request): JsonResponse
    {
        /*
         * здесь можно добавить доп. проверку на существование пользователя
         * Но это создаст доп. нагрузку на БД и более медленную отработку запроса
         * Поэтому я это делаю в самой задаче, при ее выполнении
         */

        $userEventJob = new HandleUserEventsJob($request->all());

        //определяем в какую очередь нам сохранить пользователя для сохранения упорядоченности пришедших событий
        $queueNum = (int)$request->get('userId') % HandleUserEventsJob::queueCount;
        $userEventJob->onQueue('user-events-'.$queueNum);
        $this->dispatch($userEventJob);

        return response()->json(['received' => true]);
    }
}

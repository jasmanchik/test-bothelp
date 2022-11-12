<?php

namespace App\Jobs;

use JsonException;
use App\Models\User;
use RuntimeException;
use App\Models\UserEvent;
use Illuminate\Bus\Queueable;
use App\Models\UserEventType;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class HandleUserEventsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $eventData;

    /*
     * Кол-во очередей
     */
    public const queueCount = 3;

    /**
     * @param array $eventData
     */
    public function __construct(array $eventData)
    {
        $this->eventData = $eventData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        sleep(1);
        $userId = (int)$this->eventData['userId'];
        $user = User::where('id', '=', $userId)->first();
        if ( is_null($user) )
        {
            $this->fail(throw new RuntimeException("Пользователь с id $userId не найден"));
        }
        $eventType = $this->eventData['event'];

        $event = UserEventType::where('xml_id', '=', $eventType)->first();
        if ( is_null($event) )
        {
            /*
             * Если изначально список событий неизвестен, то делаем создание этого события, если его нет в БД
             */
            $event = UserEventType::create([
                'xml_id' => $eventType['xmlId'],
                'name'   => $eventType['name'],
            ]);
        }

        $registeredEvent = $user->registerEvent($event);

        app('log')->info("Обработано событие {$event->xml_id} для пользователя {$user->id}. Записано под id {$registeredEvent->id}.");
    }
}

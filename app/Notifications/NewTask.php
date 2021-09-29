<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Ventas\CRM;

class NewTask extends Notification implements ShouldQueue
{
  use Queueable;

  protected $task;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  public function __construct(CRM $task)
  {
    $this->task = $task;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function via($notifiable)
  {
    return ['database'];
  }

  /**
   * Get the array representation of the notification.
   *
   * @param  mixed  $notifiable
   * @return array
   */
  public function toArray($notifiable)
  {
    return [
      'icon' => 'fas fa-tasks',
      'from' => $this->task->creador->usuario,
      'to' => $this->task->contacto->full_name,
      'mssg' => $this->task->actividad->nombre,
      'route' => route('crm'),
    ];
  }
}

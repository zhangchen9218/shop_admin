<?php

namespace App\Listeners\AdminBackgroundLog;

use App\Events\AdminBackgroundLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\AdminActionLog as ALog;

class AdminActionLog
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param AdminBackgroundLog $event
     */
    public function handle(AdminBackgroundLog $event)
    {
        $aLog = new ALog();
        $aLog->admin_id = session()->get('admin_id');
        $aLog->route  = $event->data['route'];
        $aLog->param  = $event->data['param'] ? json_encode($event->data['param']) : "";
        $aLog->describe  = $event->data['describe'] ? $event->data['describe'] : "";
        $aLog->save();
    }
}

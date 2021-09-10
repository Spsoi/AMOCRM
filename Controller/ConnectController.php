<?php

namespace App\Controllers\ConnectController;
use Components\Request;
use Components\Auth;
use App\Controllers\Authenticate;
use App\Jobs\ConnectsJob;

class ConnectController extends \Core\Controllers\Controller
{
    public function load()
    {
        ajaxSuccess(true);
    }

    public function save()
    {
        ajaxSuccess(true);
    }
}
?>

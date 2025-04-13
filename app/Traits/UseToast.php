<?php

namespace App\Traits;

trait UseToast
{
    public function toast($toast)
    {
        $this->dispatch('toast', $toast);
    }
}

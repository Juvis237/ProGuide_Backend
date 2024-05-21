<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait Localization {

    protected $i18n_fields = [];

    public function byLocale() {
        if (App::getLocale() == 'fr') {
            foreach ($this->i18n_fields as $field) {
                $this[$field] = $this[$field.'_fr'] ?: $this[$field];
            }
        }
        return $this;
    }

}
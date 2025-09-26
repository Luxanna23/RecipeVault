<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

trait Encryptable
{

    public static function bootEncryptable(): void
    {
        //les select
        static::retrieved(function (Model $model) {
            if (!property_exists($model, 'encryptable')) {
                return;
            }

            foreach ($model->encryptable as $key) {

                $raw = $model->getRawOriginal($key);

                $model->attributes[$key] = Crypt::decryptString($raw);
            }
        });

        //create et update
        static::saving(function (Model $model) {
            if (!property_exists($model, 'encryptable')) {
                return;
            }

            foreach ($model->encryptable as $key) {
                $plain = $model->attributes[$key] ?? null;

                $model->attributes[$key] = Crypt::encryptString($plain);
            }
        });
    }

}
<?php

namespace App\Traits;

trait Encryptable
{
    /**
     * Liste des champs à crypter/décrypter automatiquement.
     *
     * @var array
     */
    protected $encryptable = [];

    /**
     * Surcharge du setter d'attributs pour crypter avant sauvegarde.
     */
    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptable) && !is_null($value)) {
            $value = encrypt($value);
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Surcharge du getter d'attributs pour décrypter à la lecture.
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        if (in_array($key, $this->encryptable) && !is_null($value)) {
            try {
                return decrypt($value);
            } catch (\Exception $e) {
                return $value;
            }
        }

        return $value;
    }
}

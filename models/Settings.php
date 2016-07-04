<?php namespace Bedard\Contact\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'bedard_contact_settings';

    public $settingsFields = 'fields.yaml';
}

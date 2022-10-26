<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

/**
 * Properties:
 * @property int $id
 * @property int $number_two
 * @property int $number_three
 * @property string $first_name
 * @property string $last_name
 * @property string|null $middle_name
 * @property string $email
 * @property enum|null $prefix
 * @property enum|null $suffix
 * @property string|null $title
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * Relationships
 * @property PhoneNumber[] $phone_numbers
 */
class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email', 'middle_name', 'prefix', 'suffix', 'title'];

    /**
     * @return HasMany
     */
    public function phoneNumbers(): HasMany
    {
        return $this->hasMany(PhoneNumber::class);
    }

    /**
     * Default phone number of this contact.
     *
     * @return string
     */
    public function getDefaultPhoneNumberAttribute()
    {
        $defaultPhoneNumber = DB::table('phone_numbers')
            ->where('contact_id', $this->id)
            ->where('is_default', 1)
            ->first(['number']);

        return $defaultPhoneNumber?->number;
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['default_phone_number'];

}

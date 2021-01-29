<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    /**
     * Define table name
     *
     * @var string
     */
    protected $table = 'Members';

    /**
     * Define a primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Define the table field information
     *
     * @var array
     */
    public $columns = [
        'id',
        'username',
        'email',
        'salt',
        'password',
        'nickname',
        'avatar',
        'sex',
        'first_name',
        'last_name',
        'created_at',
        'updated_at',
    ];

    /**
     * A property that cannot be batched.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $dateFormat = "U";
}

<?php

namespace App\Models;


class Members extends Orm
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


}

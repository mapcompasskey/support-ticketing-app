<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PublicContact extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_id',
        'email'
    ];

    /**
     * Scope query for ordering contacts by created_at
     *
     * @param $query
     */
    public function scopeOrderByCreated($query)
    {
        $query->orderBy('created_at', 'asc');
    }

    /**
     * Scope query for getting contacts by ticket_id and email
     *
     * @param $query
     */
    public function scopeWhereTicketEmail($query, Array $input)
    {
        $query->where('ticket_id', '=', $input['ticket_id'])->where('email', '=', $input['email']);
    }

    /**
     * A public contact is owned by a ticket
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

}

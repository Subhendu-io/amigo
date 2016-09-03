<?php

namespace Amigo\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
	protected $table = 'statuses';

	protected $fillable = [ 'body' ];

	public function user()
	{
		return $this->belongsTo('Amigo\Models\User', 'user_id');
	}

	public function scopeNotReply($query)
	{
		return $query->whereNull('parent_id');
	}

	public function replies()
	{
		return $this->hasMany('Amigo\Models\Status', 'parent_id');
	}

	public function likes()
	{
		return $this->morphMany('Amigo\Models\Like', 'likeable');
	}
}
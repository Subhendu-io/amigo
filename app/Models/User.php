<?php

namespace Amigo\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'location',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getName()
    {
        if ($this->first_name && $this->last_name)
        {
            return "{$this->first_name} {$this->last_name}";
        }

        if ($this->first_name)
        {
            return $this->first_name;
        }
        return null;
    }

    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }

    public function getFirstnameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }

    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/{{ md5($this->email) }}?d=mm&s=40";
    }

    //Users Relationships
        public function statuses()
        {
            return $this->hasMany('Amigo\Models\Status', 'user_id');
        }

        public function likes ()
        {
            return $this->hasMany('Amigo\Models\Like', 'user_id');
        }

        public function friendsOfMine()
        {
            return $this->belongsToMany('Amigo\Models\User', 'friends', 'user_id', 'friend_id');
        }

        public function friendsOf()
        {
            return $this->belongsToMany('Amigo\Models\User', 'friends', 'friend_id', 'user_id');
        }

        public function friends()
        {
            return $this->friendsOfMine()->wherePivot('accepted', true)->get()->merge($this->friendsOf()->wherePivot('accepted', true)->get());
        }

    //Friend Requests
        public function friendRequests()
        {
            return $this->friendsOfMine()->wherePivot('accepted', false)->get();
        }

        public function friendRequestsPending()
        {
            return $this->friendsOf()->wherePivot('accepted', false)->get();
        }

        public function hasFriendRequestPending(User $user)
        {
            return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
        }

        public function hasFriendRequestReceived(User $user)
        {
            return (bool) $this->friendRequests()->where('id', $user->id)->count();
        }

        public function addFriend(User $user)
        {
            $this->friendsOf()->attach($user->id);
        }

        public function deleteFriend(User $user)
        {
            $this->friendsOf()->detach($user->id);
            $this->friendsOfMine()->detach($user->id);
        }

        public function acceptFriendRequest(User $user)
        {
            $this->friendRequests()->where('id', $user->id)->first()->pivot->update(
            [
                'accepted' => true,
            ]);
        }

        public function isFriendWith(User $user)
        {
            return (bool) $this->friends()->where('id', $user->id)->count();
        }

//Likes...
    public function hasLikedStatus(Status $status)
    {
        return (bool) $status->likes->where('user_id', $this->id)->count();
    }
}

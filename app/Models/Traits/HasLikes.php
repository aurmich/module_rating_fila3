<?php

declare(strict_types=1);

namespace Modules\Rating\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Rating\Models\Like;

trait HasLikes
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function likes()
    {
        return $this->likesRelation;
    }

    /**
     * param \Modules\Xot\Contracts\UserContract|null $user.
     *
     * @param  \Modules\Xot\Contracts\UserContract|null  $user
     */
    public function likedBy($user): void
    {
<<<<<<< HEAD
<<<<<<< HEAD
        $this->likesRelation()->create(['user_id' => $user->id]);
=======
        $this->likesRelation()->create(['user_id' => $user?->id]);
>>>>>>> aaced3e (.)
=======
        $this->likesRelation()->create(['user_id' => $user->id]);
>>>>>>> 0519a60 (.)

        $this->unsetRelation('likesRelation');
    }

    /**
     * param \Modules\Xot\Contracts\UserContract|null $user.
     *
     * @param  \Modules\Xot\Contracts\UserContract|null  $user
     */
    public function dislikedBy($user): void
    {
        /**
         * @var Like
         */
<<<<<<< HEAD
<<<<<<< HEAD
        $where = $this->likesRelation()->where('user_id', $user->id)->first();
=======
        $where = $this->likesRelation()->where('user_id', $user?->id)->first();
>>>>>>> aaced3e (.)
=======
        $where = $this->likesRelation()->where('user_id', $user->id)->first();
>>>>>>> 0519a60 (.)
        if ($where !== null) {
            $where->delete();
        }

        $this->unsetRelation('likesRelation');
    }

    /**
     * It's important to name the relationship the same as the method because otherwise
     * eager loading of the polymorphic relationship will fail on queued jobs.
     *
     * @see https://github.com/laravelio/laravel.io/issues/350
     */
    public function likesRelation(): MorphMany
    {
        return $this->morphMany(Like::class, 'likesRelation', 'likeable_type', 'likeable_id');
    }

    /**
     * param \Modules\Xot\Contracts\UserContract|null $user.
     *
     * @param  \Modules\Xot\Contracts\UserContract|null  $user
     * @return bool
     */
    public function isLikedBy($user)
    {
<<<<<<< HEAD
<<<<<<< HEAD
        return $this->likesRelation()->where('user_id', $user->id)->exists();
=======
        return $this->likesRelation()->where('user_id', $user?->id)->exists();
>>>>>>> aaced3e (.)
=======
        return $this->likesRelation()->where('user_id', $user->id)->exists();
>>>>>>> 0519a60 (.)
    }

    /**
     * Undocumented function.
     *
     * @return void
     */
    protected static function bootHasLikes()
    {
        static::deleting(function ($model): void {
            $model->likesRelation()->delete(); /** @phpstan-ignore method.nonObject */
            $model->unsetRelation('likesRelation');
        });
    }
}

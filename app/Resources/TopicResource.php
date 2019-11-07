<?php

namespace App\Resources;

use App\Model\Forum;
use App\Model\User;
use App\Utils\Date;

class TopicResource 
{

    protected static function map($item)
    {
        return [
            'id' => $item->id,
            'subject' => $item->subject,
            'posted' => Date::get($item->posted),
            'num_replies' => $item->num_replies,
            'num_views' => $item->num_views,
            'sticky' => $item->sticky,
            'closed' => $item->closed,
            'forum' => ForumResource::single(Forum::find($item->forum_id)),
            'poster' => User::byUsernameResource($item->poster),
            'last_poster' => User::byUsernameResource($item->last_poster),
        ];
    }

    public static function single($item)
    {
        return self::map($item);
    }

    public static function collection($items)
    {
        return $items->map(function($item)
        {
            return self::map($item);
        });
    }
    
}


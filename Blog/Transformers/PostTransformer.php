<?php

namespace Modules\Blog\Transformers;

use Illuminate\Support\Str;
use League\Fractal\TransformerAbstract;
use Modules\Blog\Entities\Post;

/**
 * Class PostTransformer.
 *
 * @package namespace App\Transformers;
 */
class PostTransformer extends TransformerAbstract
{
    /**
     * Transform the Post entity.
     *
     * @param \Modules\Blog\Entities\Post $model
     *
     * @return array
     */
    public function transform(Post $model)
    {
        return [
            'id'         => (int) $model->id,
            /* place your other model properties here */
            'title' => $model->title,
            'body' => $this->getBody($model->body),
            'created_at' => $model->created_at->format('Y/m/d H:i')
        ];
    }

    protected function getBody(string $body) : string
    {
        if (request()->is('blog')) {
            return Str::limit($body, 30);
        }

        return $body;
    }
}

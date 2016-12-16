<?php
/**
 * ArticleTransformer.php
 *
 * @author  lianginet<lianginet@gmail.com>
 * @date    2016/12/15 15:43
 */

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Article;

class ArticleTransformer extends TransformerAbstract
{
    public function transform(Article $article)
    {
        return $article;
    }
}

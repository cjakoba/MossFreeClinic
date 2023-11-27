<?php

class RatingController extends RatingModel
{
    public function updateRating($post_id, $rating)
    {

        $ratings = $this->getRating($post_id)[0];
        if ($ratings)
        {
            $count = $ratings['count'];
            if ($count > 0)
            {
                $totalRating = $ratings['total'];
                $newTotalRating = $totalRating + floatval($rating);
                $newAvgRating = $newTotalRating / ($count + 1);

                $this->updateNewRating($newAvgRating, $post_id);
            }
            else
            {
                $this->addRating($post_id, $rating);
            }
        }
    }
}
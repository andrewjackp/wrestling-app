<?php

namespace Database\Factories\Concerns;

use App\Models\Promotion;

trait ForPromotion
{   
    //factory state for promotions; guarantees grouping
    public function forPromotion(Promotion $promotion): static
    {
        return $this->state(fn () => [
            'promotion_id' => $promotion->id,
        ]);
    }
}

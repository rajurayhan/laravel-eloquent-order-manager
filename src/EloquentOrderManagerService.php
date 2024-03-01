<?php

namespace App\Services;
use Illuminate\Support\Facades\DB;

class EloquentOrderManagerService
{
    private $modelClass;

    public function __construct(string $modelClass)
    {
        $this->modelClass = $modelClass;
    }

    public function addOrUpdateItem(array $newItem)
    {
        DB::transaction(function () use ($newItem) {
            $model = app($this->modelClass);

            if (isset($newItem['id'])) {
                $this->updateExistingItem($model, $newItem);
            } else {
                $this->insertNewItem($model, $newItem);
            }
        });
    }

    private function updateExistingItem($model, $newItem)
    {
        $instance = $model->find($newItem['id']);

        if ($instance->order > $newItem['order']) {
            $shiftData = $model->where('order', '>=', $newItem['order'])
                ->where('order', '<', $instance->order)
                ->get();

            $this->shiftOrder($shiftData, 1);
        } else {
            $shiftData = $model->where('order', '<=', $newItem['order'])
                ->where('order', '>', $instance->order)
                ->get();

            $this->shiftOrder($shiftData, -1);
        }

        $instance->order = $newItem['order'];
        $instance->save();
    }

    private function insertNewItem($model, $newItem)
    {
        $existingData = $model->where('order', '>=', $newItem['order'])
            ->get();

        $this->shiftOrder($existingData, 1);

        $model->create($newItem);
    }

    private function shiftOrder($data, $shiftValue)
    {
        foreach ($data as $item) {
            $item->order = $item->order + $shiftValue;
            $item->save();
        }
    }
}

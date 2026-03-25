<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBlog extends CreateRecord
{
    protected static string $resource = BlogResource::class;

    // 🔄 Change to afterSave, not beforeSave
    public function afterSave()
    {
        if (isset($this->data['categories'])) {
            $this->record->categories()->sync($this->data['categories']);
        }
    }
}

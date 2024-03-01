<?php

namespace App\Models\Category\Operations;

use App\Models\Class\ClassType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkCategory extends Model
{
    use HasFactory;
    public function setAddLinkAttribute($category_id, $category_name): void
    {
        $category_type = ClassType::getIdCategory($category_name);
        $this->category_id = $category_id;
        $this->type = $category_type;
        $this->save();
    }
}

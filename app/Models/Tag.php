<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    use HasFactory;

    protected $table = 'tag';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function rules() {
        return [
            'name' => 'required|unique:tag,name,' . $this->id,
        ];
    }

    public function feedback() {
        return [
            'name.required' => 'Preencha o nome da tag.',
            'name.unique' => 'Tag já existe.'
        ];
    }

}

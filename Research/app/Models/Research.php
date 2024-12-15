<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Department;
 
class Research extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
	protected $table = 'research';
	
	/**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = ['researcher_id','dept_name','research_title','research_description','grant_amount_requested'];

	/**
    * Write code on Method
    *
    * @return response()
    */
    protected function casts(): array
    {
        return [
            'dept_name' => Department::class,
        ];
    }	
}

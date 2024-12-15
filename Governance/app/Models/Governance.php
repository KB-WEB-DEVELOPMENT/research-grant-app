<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Department;
 
class Governance extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
	protected $table = 'governance';
	
	/**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = ['id','dept_name','dept_initial_budget','dept_current_budget'];

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

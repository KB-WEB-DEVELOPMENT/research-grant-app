<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\GrantRequestStatus;

class Finance extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
	protected $table = 'finance';
	
	/**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = ['researcher_grant_id','researcher_grant_status','staff_comment'];

	/**
    * Write code on Method
    *
    * @return response()
    */
    protected function casts(): array
    {
        return [
            'researcher_grant_status' => GrantRequestStatus::class,
        ];
    }
	
}
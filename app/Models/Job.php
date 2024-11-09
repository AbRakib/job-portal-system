<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'category_id',
        'job_type_id',
        'vacancy',
        'salary',
        'location',
        'description',
        'benefits',
        'responsibility',
        'qualifications',
        'keywords',
        'experience',
        'company_name',
        'company_location',
        'company_website',

        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted',
        'deleted_at',
        'deleted_by',
    ];

    /**
     * Get the user that owns the Job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the category that owns the Job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get the jobType that owns the Job
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function jobType(): BelongsTo {
        return $this->belongsTo(JobType::class, 'job_type_id', 'id');
    }
}

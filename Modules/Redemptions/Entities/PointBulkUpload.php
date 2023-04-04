<?php

namespace Modules\Redemptions\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PointBulkUpload extends Model
{
    use HasFactory;

    protected $fillable = ['csv_filename', 'reason', 'uuid', 'csv_header', 'csv_data', 'unique_file_name'];
    protected $table = 'point_bulk_uploads';
    
    protected static function newFactory()
    {
        return \Modules\Redemptions\Database\factories\PointBulkUploadFactory::new();
    }
}

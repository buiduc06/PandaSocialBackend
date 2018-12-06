<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;

class video extends Model
{
    use TraitMain;
    protected $table = 'videos';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::check() ? Auth::user()->id : '';
            $model->status = 1;
        });
    }

    public function adminUser()
    {
        return $this->belongsTo('App\AdminUser', 'created_by', 'id');
    }
    public function getNameVideoS3()
    {
        if ($this->link) {
            $link_video = 'uploads/videos/' . $this->link;
            $link_video = \Storage::disk('s3')->url(link_video);
            return $link_video;
        }
    }
    public function getVideoS3()
    {
        if ($this->link) {
            $link_video = 'uploads/videos/' . $this->link;

            $s3 = \Storage::disk('s3');
            $client = $s3->getDriver()->getAdapter()->getClient();
            $bucket = \Config::get('filesystems.disks.s3.bucket');

            $command = $client->getCommand('GetObject', [
                'Bucket' => $bucket,
                'Key' => $link_video
            ]);

            $request = $client->createPresignedRequest($command, '+20 minutes');

            return (string)$request->getUri();
        }
    }

    public function deleteVideoS3()
    {
        if ($this->link) {
            $link_video = 'uploads/videos/' . $this->link;
            $s3 = \Storage::disk('s3')->delete($link_video);
            return true;
        }
    }
    // public function downloadVideoS3()
    // {
    //     if ($this->link) {
    

    //         return (string)$request->getUri();
    //     }
    // }
}

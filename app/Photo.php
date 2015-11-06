<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{

    protected $table = 'flyer_photos';

    protected $fillable = ['path'];

    protected $baseDir = 'flyers/photos';

    /**
     *  A Photo belongs to a Flyer
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer()
    {
        return $this->belongsTo(Flyer::class);
    }


    public static function fromForm(UploadedFile $file)
    {
        $photo = new static;

        $name = time() . $file->getClientOriginalName();


        $photo->path = $photo->baseDir . '/' . $name;

        $file->move($photo->baseDir, $name);

        return $photo;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $fillable = ['title', 'content'];

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'category_id', 'id');
    }

    /**
	 * @param  Media|null  $media
	 * @throws \Spatie\Image\Exceptions\InvalidManipulation
	 */
	public function registerMediaConversions(Media $media = null): void
	{
		$this->addMediaConversion('thumb')->fit('crop', 50, 50);
		$this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    /**
	 * @return mixed
	 */
	public function getPhotoAttribute()
	{
		$file = $this->getMedia('photo')->last();

		if ($file) {
			$file->url = $file->getUrl();
			$file->thumbnail = $file->getUrl('thumb');
			$file->preview = $file->getUrl('preview');
		}

		return $file;
    }

    /**
	 * @param $value
	 */
	public function setImageAttribute($value): void
	{
		$attribute_name = 'image';
		// or use your own disk, defined in config/filesystems.php
		$disk = config('backpack.base.root_disk_name');
		// destination path relative to the disk above
		$destination_path = "storage/app/public/uploads/images";

		// if the image was erased
		if ($value === null) {
			// delete the image from disk
			Storage::disk('local')->delete($this->{$attribute_name});

			// set null in the database column
			$this->attributes[$attribute_name] = null;
		}

		// if a base64 was sent, store it in the db
		if (Str::startsWith($value, 'data:image')) {
			// 0. Make the image
			$image = \Image::make($value)->encode('jpg', 90);

			// 1. Generate a filename.
			$filename = md5($value.time()).'.jpg';

			// 2. Store the image on disk.
			Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

			// 3. Delete the previous image, if there was one.
			Storage::disk($disk)->delete($this->{$attribute_name});

			// 4. Save the public path to the database
			// but first, remove "public/" from the path, since we're pointing to it
			// from the root folder; that way, what gets saved in the db
			// is the public URL (everything that comes after the domain name)
			$public_destination_path = Str::after($destination_path,  'storage/app/public/');
			$this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
		}
	}

}


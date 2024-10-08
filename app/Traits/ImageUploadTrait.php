<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

trait ImageUploadTrait {
  public function uploadImage(Request $request, $inputName, $path) {

    if ($request->hasFile($inputName)) {
      $image = $request->{$inputName};
      $extension = $image->getClientOriginalExtension();
      $imageName = 'media_' . uniqid() . '.' . $extension;

      $image->move(public_path($path), $imageName);

      return $path . '/' . $imageName;
    }
  }

  public function uploadMultiImage(Request $request, $inputName, $path) {
    $imagePaths = [];

    if ($request->hasFile($inputName)) {
      $images = $request->{$inputName};

      foreach ($images as $image) {
        $extension = $image->getClientOriginalExtension();
        $imageName = 'media_' . uniqid() . '.' . $extension;

        $image->move(public_path($path), $imageName);

        $imagePaths[] = $path . '/' . $imageName;
      }

      return $imagePaths;
    }
  }


  public function updateImage(Request $request, $inputName, $path, $oldPath = null) {

    if ($request->hasFile($inputName)) { // If new image is uploaded
      if (File::exists(public_path($oldPath))) { // If old image exists then delete it
        File::delete(public_path($oldPath));
      }

      $image = $request->{$inputName};
      $extension = $image->getClientOriginalExtension();
      $imageName = 'media_' . uniqid() . '.' . $extension;

      $image->move(public_path($path), $imageName);

      return $path . '/' . $imageName;
    }
  }

  // Handle image delete
  public function deleteImage(string $path) {
    if (File::exists(public_path($path))) {
      File::delete(public_path($path));
    }
  }
}

<?php
namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return //\Illuminate\Http\Response
     */
    public function index()
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        $files = $disk->files(config('backup.backup.name'));

        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $file_name = str_replace(config('backup.backup.name') . '/', '', $f);
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => $file_name,
                    'file_size' => $this->bytesToHuman($disk->size($f)),
                    'created_at' => Carbon::parse($disk->lastModified($f))->diffForHumans(),
                    'download_link' => action('Admin\Settings\BackupController@download', [$file_name]),
                ];
            }
        }

        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);
        $role = Auth::user()->id;
        return view('admin.pages.settings.backup',compact('backups', 'role'));
    }

    /**
     * Convert bytes to human readable
     * @param $bytes
     * @return string
     */
    private function bytesToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // start the backup process
        \Artisan::call('backup:run');

        $notification=array(
            'messege'=>'Backup Successfully Created',
            'alert-type'=>'success'
        );
        return back()->with($notification);

    }

    /**
     * Downloads a backup zip file.
     *
     * @param  int  $file_name
     * @return \Illuminate\Http\Response
     */
    public function download($file_name)
    {
        $file = config('backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $file_name
     * @return void
     */
    public function destroy($file_name)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);

        if ($disk->exists(config('backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('backup.backup.name') . '/' . $file_name);
        }
        $notification=array(
            'messege'=>'Backup Successfully Deleted.',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

    /**
     * Clean all old backups
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clean()
    {
        // start the backup process
        Artisan::call('backup:clean');

        $notification=array(
            'messege'=>'All Old Backups Successfully Deleted',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }
}

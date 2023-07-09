<?php

namespace App\Jobs;

use App\Models\alumni as ModelsAlumni;
use Illuminate\Auth\Events\Validated;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class alumni implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $key;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        
        $this->key= $request;
    

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $nisn = ModelsAlumni::firstWhere('nisn',$this->key);
        $nik =  ModelsAlumni::firstWhere('nisn',$this->key);
        $nis =  ModelsAlumni::firstWhere('nisn',$this->key);
       
        if ($nisn) {
            $this->key->session()->put('key', $nisn);
            return redirect()->route('auth-login');
        } elseif ($nik) {
            $this->key->session()->put('key', $nik);
            return redirect()->route('auth-login');
        } elseif ($nis) {
            $this->key->session()->put('key', $nis);
            return redirect()->route('auth-login');
        }

       return back()->with('loginError', 'Data anda Tidak Ditemukan');
    }
}

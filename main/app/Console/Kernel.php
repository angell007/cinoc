<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

use App\Job;
use App\Alert;
use App\Industry;
use DB;
use App\Mail\AlertJobsMail;
use Carbon\Carbon;


class Kernel extends ConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\CallRoute',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        
        try{
	
        $schedule->call(function () {
               
        $alerts = Alert::get();
    	

    	if(null!==($alerts)){
    		foreach ($alerts as $key => $alert) {
    			$search = $alert->search_title;
    			$country_id = $alert->country_id;
    			$state_id = $alert->state_id;
    			$city_id = $alert->city_id;
    			$functional_area_id = $alert->functional_area_id;
    		   	$query = Job::select('*');
    		   	
    		  // 	$query->where('created_at', '>=', Carbon::now()->subDay());
    		   	
	           	if ($search != '') {
	                     $query->Where('title', 'like', '%' . $search . '%');
	            }
	            if ($country_id != '') {
	                
	                $query->where('country_id',$country_id);
	                       
	            }
	            if ($state_id != '') {
	                
	                $query->where('state_id',$state_id);
	                       
	            }
	            if ($city_id != '') {
	                
	                $query->where('city_id',$city_id);
	                       
	            }
	            if ($functional_area_id	!= '') {
	                
	                $query->where('functional_area_id',$functional_area_id);
	                       
	            }

	            
                $query->orderBy('jobs.id', 'DESC'); 
                

            	$jobs = $query->active()->take(10)->get();
            	

            	if(null!==($jobs) && count($jobs)>0){
            	    
            // 		if($search_location != '') {
            // 			$loca = $search_location;
            // 		}else{
            // 			$loca = 'United Kingdom';
            // 		}
			        $data['email'] = $alert->email;
			        $data['subject'] = count($jobs).' nuevo '.$alert->search_title;
			        $data['jobs'] = $jobs;

			        Mail::send(new AlertJobsMail($data));
            	}

            	
    		}
    	}
            
        })->everyMinute()->onSuccess(function () {
                                $this->info('ejecutado correcto');
                                  })
                                 ->onFailure(function () {
                                  $this->info('ejecutado incorrecto');
                                 })->sendOutputTo(storage_path() . '/logs/queue-jobs.log');
                                 
                                 
          echo 'Alertas enviadas correctamente';
        
        } catch(\Exception $th){
            
            echo $th->getMessage();
        }
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }

}

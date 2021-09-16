<?php

namespace App\Console\Commands;

use App\Institutional;
use App\Travel;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TravelInactive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:travelinactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deshabilitando viajes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $curren_date = Carbon::now();
        $travels = Travel::all()->where('estado', 'ACTIVO');

        foreach ($travels as $key => $item) {

            $date_llegada = Carbon::parse($item->llegada);

            // lessThan menor que
            if ($date_llegada->lessThan($curren_date)) {

                echo 'date_llegada_:' . $date_llegada;
                echo '<br>';
                echo 'curren_date__:' . $curren_date;
                echo '<br>';
                echo 'si es menor';

                //dd($item->llegada);

                $item->estado = 'INACTIVO';
                $item->save();
            } else {
                echo 'date_llegada_:' . $date_llegada;
                echo '<br>';
                echo 'curren_date__:' . $curren_date;
                echo '<br>';
                echo 'no es menor';
            }
            echo '<br>';
            echo '<br>';
            echo '<br>';
        }
    }
}

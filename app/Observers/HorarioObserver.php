<?php

namespace App\Observers;

use App\Models\Horario;
use App\Models\Asiento;

class HorarioObserver
{
    /**
     * Handle the Horario "created" event.
     */
    public function created(Horario $horario): void
    {
        // crea asientos para la sala del horario
        $sala = $horario->sala;

        // arreglo con el abecedario
        $filas = range('A', 'Z');
        $filas = array_slice($filas, 0, $sala->filas);



        for ($i = 0; $i < count($filas); $i++) {
            for ($j = 1; $j <= $sala->asientos_por_fila; $j++) {
                $asiento = new Asiento();
                $asiento->identificador = $filas[$i] . $j;
                $asiento->horario_id = $horario->id;
                $asiento->save();
            }
        }
    }

    /**
     * Handle the Horario "updated" event.
     */
    public function updated(Horario $horario): void
    {
        //
    }

    /**
     * Handle the Horario "deleted" event.
     */
    public function deleted(Horario $horario): void
    {
        //
    }

    /**
     * Handle the Horario "restored" event.
     */
    public function restored(Horario $horario): void
    {
        //
    }

    /**
     * Handle the Horario "force deleted" event.
     */
    public function forceDeleted(Horario $horario): void
    {
        //
    }
}

<?php


use Tests\TestCase;
use App\Models\Horario;
use App\Models\Asiento;
use App\Observers\HorarioObserver;

class HorarioObserverTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Horario::observe(HorarioObserver::class);
    }

    public function testAsientosCreados()
    {
        // Crea un horario
        $horario = Horario::factory()->create();

        // Verifica que los asientos se hayan creado
        foreach ($horario->asientos as $asiento) {
            $this->assertDatabaseHas('asientos', [
                'id' => $asiento->id,
                'horario_id' => $horario->id,
            ]);
        }
    }
}

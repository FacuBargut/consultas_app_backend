<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ConsultasFakerFactory extends Factory
{   
    private static $idDocente = 2;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
        return [
            'estado' => $this->faker->randomElement(['pendiente','confirmado','bloqueado']),
            'fecha_hora' => Carbon::createFromTimestamp($this->faker->dateTimeBetween($startDate = '+2 days', $endDate = '+1 week')->getTimeStamp()),
            'motivoBloqueo' => $this->faker->sentence(9),
            'id_docente' => self::$idDocente++,
            'id_rol' => $this->faker->randomElement(['1','2','3'])
        ];
    }

    function autoIncrement(){

    }
}

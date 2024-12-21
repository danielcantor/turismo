<?php
// database/factories/CategoryFactory.php
namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
            'description' => $this->faker->sentence,
            'subtitle' => $this->faker->sentence,
            'image' => $this->faker->imageUrl,
            'home_image' => $this->faker->imageUrl,
        ];
    }

    public function nacional()
    {
        return $this->state([
            'name' => 'Turismo Nacional',
            'slug' => 'nacional',
            'description' => 'El Turismo Nacional construye y preserva la identidad de cada destino, así como también pone en valor cada uno de sus Patrimonios. Te invitamos a recorrer juntos nuestro hermoso país.',
            'subtitle' => '',
            'image' => '/img/home/Turismo-nacional-banner.jpg',
            'home_image' => '/img/home/Turismo-nacional-banner.jpg',
        ]);
    }

    public function internacional()
    {
        return $this->state([
            'name' => 'Turismo Internacional',
            'slug' => 'internacional',
            'description' => 'Recorrer el mundo es una experiencia que requiere de un buen asesoramiento y recomendación para poder optimizar los tiempos y de esa forma concretar los deseos y expectativas de cada uno de ustedes. Los invitamos a conocer los circuitos internacionales junto a nosotros.',
            'subtitle' => 'Internacionales',
            'image' => '/img/home/internacional.png',
            'home_image' => '/img/home/internacional.png',
        ]);
    }

    public function aereo()
    {
        return $this->state([
            'name' => 'Pasajes Aéreos',
            'slug' => 'aereos',
            'description' => '',
            'subtitle' => 'Aéreos',
            'image' => '/img/home/aereo.jpg',
            'home_image' => '/img/home/aereo.jpg',
        ]);
    }

    public function micro()
    {
        return $this->state([
            'name' => 'Pasajes en Micro',
            'slug' => 'micro',
            'description' => '',
            'subtitle' => 'en Micro',
            'image' => '/img/home/micro.jpg',
            'home_image' => '/img/home/micro.jpg',
        ]);
    }

    public function escapada()
    {
        return $this->state([
            'name' => 'Escapadas',
            'slug' => 'escapadas',
            'description' => 'El miniturismo representa una porción sustancial de las economías de muchas regiones, ciudades o pueblos; con recorridos de pocos kilómetros, donde lo importante es siempre conectar con la identidad del lugar y regresar renovado.',
            'subtitle' => 'Escapadas',
            'image' => '/img/home/escapada.jpg',
            'home_image' => '/img/home/escapada.jpg',
        ]);
    }

    public function finde()
    {
        return $this->state([
            'name' => 'Fin de Semana',
            'slug' => 'finde',
            'description' => '',
            'subtitle' => 'Semana',
            'image' => '/img/home/findelargo.jpg',
            'home_image' => '/img/home/findelargo.jpg',
        ]);
    }
    public function withId($id)
    {
        return $this->state([
            'id' => $id,
        ]);
    }
}
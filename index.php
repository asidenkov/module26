<?php

// Интерфейс спецспособностей (закись, ковш и т.д.)
interface SpecialAbilityInterface
{
    public function useSpecialAbility(): void;
}

// Интерфейс дополнительных функций (гудок, дворники)
interface ExtraFunctionsInterface
{
    public function honk(): void;
    public function useWipers(): void;
}

// Абстрактный класс для всех машин
abstract class Vehicle
{
    protected string $name; // название транспортного средства
    protected string $interior; // индивидуальность: отделка салона

    public function __construct(string $name, string $interior)
    {
        $this->name = $name;
        $this->interior = $interior;
    }

    public function moveForward(): void
    {
        echo "{$this->name} едет вперёд<br>";
    }

    public function moveBackward(): void
    {
        echo "{$this->name} едет назад<br>";
    }

    abstract public function info(): void;
}

// Легковая машина
class Car extends Vehicle implements SpecialAbilityInterface, ExtraFunctionsInterface
{
    public function useSpecialAbility(): void
    {
        echo "{$this->name} активирует закись азота! 💨<br>";
    }

    public function honk(): void
    {
        echo "{$this->name} сигналит: Бип-бип! 🔊<br>";
    }

    public function useWipers(): void
    {
        echo "{$this->name} включает дворники! 💦<br>";
    }

    public function info(): void
    {
        echo "Это легковой автомобиль: {$this->name}<br>";
        echo "Салон: {$this->interior}<br>";
    }
}

// Бульдозер
class Bulldozer extends Vehicle implements SpecialAbilityInterface, ExtraFunctionsInterface
{
    public function useSpecialAbility(): void
    {
        echo "{$this->name} поднимает ковш! 🛠<br>";
    }

    public function honk(): void
    {
        echo "{$this->name} ревёт: ГРОМ! 💥<br>";
    }

    public function useWipers(): void
    {
        echo "{$this->name} чистит лобовое стекло! 🌧<br>";
    }

    public function info(): void
    {
        echo "Это бульдозер: {$this->name}<br>";
        echo "Салон: {$this->interior}<br>";
    }
}

// Танки (без спецспособности, но с гудком и дворниками)
class Tank extends Vehicle implements ExtraFunctionsInterface
{
    public function honk(): void
    {
        echo "{$this->name} гудит: БРРРР! 🚨<br>";
    }

    public function useWipers(): void
    {
        echo "{$this->name} включает военные дворники! 🧽<br>";
    }

    public function info(): void
    {
        echo "Это танк: {$this->name}<br>";
        echo "Салон: {$this->interior}<br>";
    }
}

// Полиморфная функция, которая принимает любую технику
function controlMachine(Vehicle $vehicle): void
{
    $vehicle->info();
    $vehicle->moveForward();

    if ($vehicle instanceof SpecialAbilityInterface) {
        $vehicle->useSpecialAbility();
    }

    if ($vehicle instanceof ExtraFunctionsInterface) {
        $vehicle->honk();
        $vehicle->useWipers();
    }

    $vehicle->moveBackward();
    echo "<hr>";
}

// Тест — создаём разные машины
$car = new Car("BMW M3", "кожаный салон с красной прострочкой");
$bulldozer = new Bulldozer("CAT D9", "металлический интерьер с кондиционером");
$tank = new Tank("Т-90", "бронированный салон с цифровой панелью");

// Проверка
controlMachine($car);
controlMachine($bulldozer);
controlMachine($tank);

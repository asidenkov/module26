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
    protected string $name;     // название транспортного средства
    protected string $interior; // индивидуальность: отделка салона

    public function __construct(string $name, string $interior)
    {
        $this->name = $name;
        $this->interior = $interior;
    }

    // Метод движения вперёд
    public function moveForward(): void
    {
        // логика движения вперёд
    }

    // Метод движения назад
    public function moveBackward(): void
    {
        // логика движения назад
    }

    // Абстрактный метод для вывода информации
    abstract public function info(): void;
}

// Легковая машина
class Car extends Vehicle implements SpecialAbilityInterface, ExtraFunctionsInterface
{
    public function useSpecialAbility(): void
    {
        // реализация закиси азота
    }

    public function honk(): void
    {
        // реализация сигнала
    }

    public function useWipers(): void
    {
        // реализация дворников
    }

    public function info(): void
    {
        // информация о машине и салоне
    }
}

// Бульдозер
class Bulldozer extends Vehicle implements SpecialAbilityInterface, ExtraFunctionsInterface
{
    public function useSpecialAbility(): void
    {
        // реализация ковша
    }

    public function honk(): void
    {
        // реализация сигнала
    }

    public function useWipers(): void
    {
        // реализация дворников
    }

    public function info(): void
    {
        // информация о бульдозере и салоне
    }
}

// Танки (без спецспособности, но с гудком и дворниками)
class Tank extends Vehicle implements ExtraFunctionsInterface
{
    public function honk(): void
    {
        // реализация сигнала
    }

    public function useWipers(): void
    {
        // реализация дворников
    }

    public function info(): void
    {
        // информация о танке и салоне
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
}

// Тест — создаём разные машины с индивидуальностью салона
$car = new Car("BMW M3", "кожаный салон с красной прострочкой");
$bulldozer = new Bulldozer("CAT D9", "металлический интерьер с кондиционером");
$tank = new Tank("Т-90", "бронированный салон с цифровой панелью");

// Управляем техникой
controlMachine($car);
controlMachine($bulldozer);
controlMachine($tank);

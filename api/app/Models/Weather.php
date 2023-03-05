<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Notifications\Notifiable;
use DateTime;

class Weather extends Model
{
    use HasFactory, Notifiable;

    protected $table = "weathers";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'weather',
        'temperature',
        'humidity',
        'wind'
    ];

    # --------------------------------------------------------------------------
    # Relationships
    # --------------------------------------------------------------------------
    
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    # --------------------------------------------------------------------------
    # Setters
    # --------------------------------------------------------------------------

    /**
     * @return void
     */
    public function setUser(User $user): void
    {
        $this->User()->associate($user);
    }

    /**
     * @return void
     */
    public function setWeather(string $weather): void
    {
        $this->weather = $weather;
    }
    /**
     * @return void
     */
    public function setTemperature(float $temperature): void
    {
        $this->temperature = $temperature;
    }
    /**
     * @return void
     */
    public function setHumidity(float $humidity): void
    {
        $this->humidity = $humidity;
    }
    /**
     * @return void
     */
    public function setWind(float $wind): void
    {
        $this->wind = $wind;
    }

    # --------------------------------------------------------------------------
    # Getters
    # --------------------------------------------------------------------------
    /**
     * @return int
     */
    public function getId(): int
    {
       return $this->id; 
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->User()->first();
    }

    /**
     * @return string
     */
    public function getWeather(): string
    {
        return $this->weather;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @return float
     */
    public function getHumidity(): float
    {
        return $this->humidity;
    }
    /**
     * @return float
     */
    public function getWind(): float
    {
        return $this->wind;
    }

    /**
     * @return Datetime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

}

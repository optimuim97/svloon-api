<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Collection;

/**
 * @OA\Schema(
 *      schema="Salon",
 *      required={},
 *      @OA\Property(
 *          property="name",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="email",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="owner_fullname",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="dialCode",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="password",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="scheduleStart",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="scheduleEnd",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="scheduleStr",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="city",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="phoneNumber",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="phone",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="postalCode",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="localNumber",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="bailDocument",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="salon_type_id",
 *          description="",
 *          readOnly=false,
 *          nullable=true,
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="created_at",
 *          description="",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="updated_at",
 *          description="",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */ class Salon extends Model
{
    use HasFactory;
    public $table = 'salons';

    public $fillable = [
        'user_id',
        'name',
        'email',
        'owner_fullname',
        'dialCode',
        'password',
        'scheduleStart',
        'scheduleEnd',
        'scheduleStr',
        'city',
        'phoneNumber',
        'phone',
        'postalCode',
        'localNumber',
        'bailDocument',
        'salon_type_id'
    ];

    protected $casts = [
        'user_id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'owner_fullname' => 'string',
        'dialCode' => 'string',
        'password' => 'string',
        'scheduleStr' => 'string',
        'city' => 'string',
        'phoneNumber' => 'string',
        'phone' => 'string',
        'postalCode' => 'string',
        'localNumber' => 'string',
        'bailDocument' => 'string',
        'salon_type_id' => 'integer'
    ];

    public static array $rules = [
        "user_id",
        "name",
        "email"
    ];

    protected $appends = ['quick_service_list', "address", 'availabilities', 'commodities', 'staff', 'pictures', 'porfolio'];

    /**
     * Get the user that owns the Salon
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getQuickServiceListAttribute()
    {
        $serviceList = new Collection();
        $servicesSalon = ServicesSalon::where(["salon_id" => $this->id, "is_active" => true])->get();

        if (!empty($servicesSalon)) {

            foreach ($servicesSalon as $value) {
                $serviceList->add(Service::where(["id" => $value->service_id])->first());
            }

            return $serviceList->unique("id", true);
        }

        return $serviceList;
    }

    public function getAddressAttribute()
    {
        $address = SalonAddress::where("salon_id", $this->id)->get();
        return $address;
    }

    public function getStaffAttribute()
    {
        return StaffMember::where('salon_id', $this->id)->get();
    }

    public function getPorfolioAttribute()
    {
        return Portfolio::where('salon_id', $this->id)->get();
    }

    public function getCommoditiesAttribute()
    {
        $commoditySalon = CommoditySalon::where("salon_id", $this->id)->get();
        $commodities = [];

        foreach ($commoditySalon as $value) {
            $x = $value->commodity_id;
            $commodity = Commodities::find($x);
            array_push($commodities, $commodity);
        }

        return $commodities;
    }

    public function getAvailabilitiesAttribute()
    {
        $salonAvailabilities = SalonAvailabily::where("salon_id", $this->id)->get();
        $valideDate = [];

        foreach ($salonAvailabilities as $item) {

            $day = Carbon::parse($item->date)->format('Y-m-d');
            $date = Carbon::parse("$day $item->hour_end")->isPast();

            if (!$date) {
                array_push($valideDate, $item);
            }
        }

        return $valideDate;
    }

    public function getPicturesAttribute()
    {
        $salonPictures = SalonPicture::where("salon_id", $this->id)->get();
        return $salonPictures;
    }
}

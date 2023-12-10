<?php

namespace App\Http\Resources;

use App\Models\AppointmentStatus;
use App\Models\Order;
use App\Models\SalonService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "creator_id" => $this->creator_id,
            "user_id" => $this->user_id,
            "artist_id" => $this->artist_id,
            "appointment_status" => AppointmentStatus::find($this->appointment_status_id),
            "date" => $this->date,
            "hour" => $this->hour,
            "date_time" => $this->date_time,
            "reference" => $this->reference,
            "is_confirmed" => $this->is_confirmed,
            "is_report" => $this->is_report,
            "is_cancel" => $this->is_cancel,
            "services" => SalonService::where(["id" => $this->salon_service_id])->get(),
            "report_date" => $this->report_date,
            "order" => new OrderResource(
                Order::where("appointement_id", $this->appointement_id)->first()
            )
        ];
    }
}

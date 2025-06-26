<?php

namespace App\Rules;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\Post;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;

class DateRangeAvailable implements DataAwareRule, InvokableRule
{
    /**
     * Post yang sedang divalidasi.
     */
    protected Post $post;

    /**
     * Semua data dari request.
     * @var array
     */
    protected $data = [];

    /**
     * Buat instance rule baru.
     * Kita akan menerima Post yang ingin divalidasi.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Atur data yang sedang divalidasi.
     * Ini penting agar kita bisa mengakses 'start_date' dan 'end_date'.
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Jalankan validasi.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function __invoke(string $attribute, mixed $value, Closure $fail): void
    {
        // Ambil start_date dan end_date dari data request
        $startDate = Carbon::parse($this->data['start_date']);
        $endDate = Carbon::parse($this->data['end_date']);

        // Hitung jumlah booking yang aktif dan tumpang tindih dengan rentang tanggal yang diminta
        $conflictingBookingsCount = Booking::where('post_id', $this->post->id)
            ->whereIn('status', [
                BookingStatus::Confirmed,
                BookingStatus::Completed,
                BookingStatus::WaitingPaymentConfirmation,
                BookingStatus::Payment,
            ])
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('start_date', [$startDate, $endDate]);
                })->orWhere(function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('end_date', [$startDate, $endDate]);
                })->orWhere(function ($q) use ($startDate, $endDate) {
                    $q->where('start_date', '<', $startDate)->where('end_date', '>', $endDate);
                });
            })
            ->count();

        // Jika jumlah booking yang konflik SUDAH SAMA DENGAN atau LEBIH dari kuantitas total, maka validasi GAGAL.
        if ($conflictingBookingsCount >= $this->post->quantity) {
            $fail('Sorry, the post is not available in the date range you selected.');
        }
    }
}

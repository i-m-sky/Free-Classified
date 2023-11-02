<?php

namespace App\Http\Livewire\Members\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Analytics extends Component
{
    public $timePeriodOptions = [];
    public $timePeriodOptionLevels = [];
    public $selectedOption;
    public $userId;

    public function mount()
    {
        try {
            $this->selectedOption = 'today';
            $this->userId = Auth::id();
            $this->getTimePeriodDropdown();
        } catch (\Throwable $th) {
            //throw $th;
        }
    } //end mount

    public function searchByTimePeriod($val)
    {
        try {
            $this->selectedOption = $val;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getTimePeriodDropdown()
    {
        try {
            $dt = Carbon::now();
            $today = $dt->format('Y-m-d');
            $yesterday = $dt->subDay(1)->format('Y-m-d');
            $last7Days = $dt->subDay(7)->format('Y-m-d');
            $last14Days = $dt->subDay(14)->format('Y-m-d');
            $last30Days = $dt->subDay(30)->format('Y-m-d');
            $this->timePeriodOptions = [
                "today" => $today,
                "yesterday" => $yesterday,
                "last7Days" => $last7Days,
                "last14Days" => $last14Days,
                "last30Days" => $last30Days,
                "allTime" => ''
            ];

            $this->timePeriodOptionLevels = [
                "today" => "Today",
                "yesterday" => 'Yesterday',
                "last7Days" => 'Last 7 days',
                "last14Days" => 'Last 14 days',
                "last30Days" => 'Last 30 days',
                "allTime" => 'All time'
            ];
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function render()
    {
        $data = [];
        if (!empty($this->selectedOption) && $this->selectedOption != 'allTime') {
            $reachQuery = "SELECT count(id) as total FROM `post_view_histories` WHERE `post_id` IN(SELECT id from posts USE INDEX (user_id) where user_id='" . $this->userId . "') AND `created_at`>='" . $this->timePeriodOptions[$this->selectedOption] . " 00:00:00' ";
            $data['reachView'] = DB::select($reachQuery);
            $phoneQuery = "SELECT SUM(IF(visitor_type=1,1,0)) as phone, SUM(IF(visitor_type=2,1,0)) as whatsApp FROM `post_phone_view_histories` WHERE `post_id` IN(SELECT id from posts USE INDEX (user_id) where user_id='" . $this->userId . "') AND `created_at`>='" . $this->timePeriodOptions[$this->selectedOption] . " 00:00:00' ";
            $data['phoneWhatsAppView'] = DB::select($phoneQuery);
            $emailQuery = "SELECT count(id) as total FROM `post_sent_email_histories` WHERE `post_id` IN(SELECT id from posts USE INDEX (user_id) where user_id='" . $this->userId . "') AND`created_at`>='" . $this->timePeriodOptions[$this->selectedOption] . " 00:00:00' ";
            $data['emailView'] = DB::select($emailQuery);
        } else {
            $reachQuery = "SELECT count(id) as total FROM `post_view_histories` WHERE `post_id` IN(SELECT id from posts USE INDEX (user_id) where user_id='" . $this->userId . "') ";
            $data['reachView'] = DB::select($reachQuery);
            $phoneQuery = "SELECT SUM(IF(visitor_type=1,1,0)) as phone, SUM(IF(visitor_type=2,1,0)) as whatsApp FROM `post_phone_view_histories` WHERE `post_id` IN(SELECT id from posts USE INDEX (user_id) where user_id='" . $this->userId . "')";
            $data['phoneWhatsAppView'] = DB::select($phoneQuery);
            $emailQuery = "SELECT count(id) as total FROM `post_sent_email_histories` WHERE `post_id` IN(SELECT id from posts USE INDEX (user_id) where user_id='" . $this->userId . "') ";
            $data['emailView'] = DB::select($emailQuery);
        }
        return view('livewire.members.dashboard.analytics', $data);
    }
}

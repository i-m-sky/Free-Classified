<div class="row analytics-graph-bg g-6 mb-6 mt-5 ">
    <div class="col-md-12 my-3">
        <div class="d-flex justify-content-between">
            <div class="d-flex justify-content-start">
                <span class="mr-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                    </svg>
                </span>
                <h1 style="margin-left:10px;font-size:16px">Analytics</h1>
            </div>
            <div class="custom-select custom-select-ads">
                @if (count($timePeriodOptionLevels))
                    <div class="select-title">{{ $timePeriodOptionLevels[$selectedOption] }}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" width="16px" height="16px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                        </svg>
                    </div>
                    <ul>
                        @foreach ($timePeriodOptionLevels as $key => $val)
                            <li><a href="javascript:;" wire:click.prevent="searchByTimePeriod('{{ $key }}')">
                                    {{ $val }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12 mb-3  pr-0">
        <div class="card border-0">
            <div class="card-body reserch-color p-2">
                <div class="d-flex justify-content-end">
                    <aside class="more-info">
                        <span class="tooltiptext">Number of times users clicked to see your
                            ad.</span>
                    </aside>
                </div>
                <div class="px-3">
                    <h2 class="my-fw-bolder">Reaches </h2>
                    <h1 class="reaches-no ">
                        {{ isset($reachView) && count($reachView) > 0 ? number_format($reachView[0]->total) : 0 }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12 mb-3  pr-0">
        <div class="card border-0">
            <div class="card-body call-color p-2">
                <div class="d-flex justify-content-end">
                    <aside class="more-info2">
                        <span class="tooltiptext">Number of times users clicked to see your
                            Mobile Number.</span>
                    </aside>
                </div>
                <div class="px-3">
                    <h2 class="my-fw-bolder">Call </h2>
                    <h1 class="call-no ">
                        {{ isset($phoneWhatsAppView) && count($phoneWhatsAppView) > 0 ? number_format($phoneWhatsAppView[0]->phone) : 0 }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12 mb-3  pr-0">
        <div class="card border-0">
            <div class="card-body whatsapp-color p-2">
                <div class="d-flex justify-content-end">
                    <aside class="more-info3">
                        <span class="tooltiptext">Number of times users clicked to see your
                            Whatsapp Number.</span>
                    </aside>
                </div>
                <div class="px-3">
                    <h2 class="my-fw-bolder">Whatsapp </h2>
                    <h1 class="whatsapp-no ">
                        {{ isset($phoneWhatsAppView) && count($phoneWhatsAppView) > 0 ? number_format($phoneWhatsAppView[0]->whatsApp) : 0 }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 col-12 mb-3  pr-0">
        <div class="card border-0">
            <div class="card-body mail-color p-2">
                <div class="d-flex justify-content-end">
                    <aside class="more-info4">
                        <span class="tooltiptext">Number of times users clicked to send you
                            mail.</span>
                    </aside>
                </div>
                <div class="px-3">
                    <h2 class="my-fw-bolder">Mail </h2>
                    <h1 class="mail-no ">
                        {{ isset($emailView) && count($emailView) > 0 ? number_format($emailView[0]->total) : 0 }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>

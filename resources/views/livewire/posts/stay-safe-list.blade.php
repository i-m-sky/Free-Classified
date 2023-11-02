<div class="stay-safe">
    @if (count($staySafes) > 0)
        <div class="safe_icon d-flex justify-content-start">
            <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 pr-3">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
            </svg>
            <h5>Stay Safe</h5>
        </div>
        <div class="divs mt-3">
            @foreach ($staySafes as $item)
                <div class="cls1">Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. Lorem Ipsum has been the industry's standard dummy text 1
                </div>
            @endforeach
        </div>
        @if (count($staySafes) > 0)
            @if ($staySafes->hasPages())
                <div style="font-size:20px" class="d-flex justify-content-end">
                    {{ $staySafes->links() }}
                </div>
            @endif
        @endif
    @endif
</div>

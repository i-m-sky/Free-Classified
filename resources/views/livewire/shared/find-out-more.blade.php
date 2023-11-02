<div>
    <hr>
    @if ($page == 'list' || $page == 'home')
        @if (isset($categories) && count($categories) > 0)
            <div class="location-heading mt-5"><span>Find out</span> More</div>
            @foreach ($categories as $c)
                <div class="market-heding">
                    <h2 class="more-title">{{ strtoupper($c['name']) }}</h2>
                    @php
                        $subCats = collect($subCategories)->where('parent_id', $c['id']);
                    @endphp
                    @if (count($subCats) > 0)
                        <h3>
                            @foreach ($subCats as $sc)
                                <a
                                    href="{{ route('post-list', ['location' => $location, 'category' => $sc['slug']]) }}">{{ ($sc['name']) }}</a>
                                @if (!$loop->last)
                                    &nbsp;-&nbsp;
                                @endif
                            @endforeach
                        </h3>
                    @else
                        <h4></h4>
                    @endif
                </div>
            @endforeach
        @endif
    @else
        {{-- <div class="market-heding">
            <h2 class="more-title">MARKET</h2>
            <h4>Cat - Golden retriever - French bulldog - Dogs - Border collie - Labrador - Pitbull - Folding
                bike - Folding electric bike - Used racing bike - Pedal assisted bicycle - Bike accessories -
                Used exercise bike - Ikea cabinets - Ikea shelves - Poltrona frau - School library - Used chairs
                - Used mobile phones - Used iPhones -Used smartphones - Used mobile phones Milan</h4>
        </div>
        <div class="market-properties">
            <h2 class="more-title">PROPERTIES</h2>
            <h4>Houses for sale - Houses for rent - Houses for sale Bolzano - Rent to buy - Rent Rome - Rent
                Milan - Houses for sale Genoa - Houses for sale Bologna - Rentals Turin - Studio apartment for
                rent Milan - Houses for sale Lodi - Rentals Palermo - Rentals Bolzano - Apartments for sale
                Milan - Rent Genoa - Apartments for sale in Palermo - Apartments for sale Rome - Rent Naples-
                Apartments for sale in Turin - Houses for sale in central Naples</h4>
        </div>
        <div class="market-work">
            <h2 class="more-title">WORK</h2>
            <h4 class="work-para">Job offers - Summer season - Job Rome - Work from home - Job offers Turin -
                Job Milan - Job Palermo - Job offers Bergamo - Job Bologna - Job Naples - Online job - Social
                health worker - Gas station - Bricklayer - Job Lecco - Job Pisa - Receptionist - Part time job -
                Real estate agent -Administrative assistant - Carpenter - Representative - Housekeeping -
                Steward - Assembly line - Secretary - Part time job Rome - Coachbuilder - Barista - Worker -
                Waiter - Part time job Milan - Cohabitant caregiver - Baby sitter Milan - Nanny Rome - House
                maid - Internship Milan - Caregiver Milan - Internship Turin</h4>
        </div> --}}
    @endif
</div>

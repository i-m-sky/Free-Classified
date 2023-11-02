<form wire:submit.prevent="formSubmit()" enctype="multipart/form-data">
    <div class="form-flex-container col-md-6">
        <div class="label-container">
            <label for="#" class="ads-labels">Category</label>
        </div>
        <div class="col-md-12 ads-para">
            <p>
                @php
                $catSlugArr = [];
                @endphp
                @if (count($catNav))
                @foreach (collect($catNav)->sortKeysDesc() as $navItem)
                {{ $navItem['name'] }}
                @php array_push($catSlugArr,$navItem['slug'] ); @endphp
                @if (!$loop->last)
                >
                @endif
                @endforeach
                @endif
                @if (count($catSlugArr) > 0)
                @if (empty($post))
                <a href="{{ route('new-post', implode('/', $catSlugArr)) }}">(Change
                category)</a>
                @endif
                @else
                @if (empty($post))
                <a href="{{ route('new-post') }}">(Change category)</a>
                @endif
                @endif
            </p>
        </div>
    </div>
    {{-- @foreach ($errors->all() as $message)
    {{ $message }} <br />
    @endforeach --}}
    @if (in_array($catRow['id'], [20, 21, 26, 27]))
    {{--  
    Property > Property For Rent > Houses for Rent => 20
    For Property > Property For Rent > Flats for Rent => 21 
    Property > Property To Share > Houses for Share => 26
    Property > Property To Share > Flats for Share => 27
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="bedroom" class="ads-label">Bedroom</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('bedroom') is-invalid @enderror" name="bedroom"
                    wire:model.defer="bedroom">
                    <option value="">Please select</option>
                    @if (count($mBedrooms) > 0)
                    @foreach ($mBedrooms as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('bedroom')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="bathroom" class="ads-label">Bathroom</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('bathroom') is-invalid @enderror" name="bathroom"
                    wire:model.defer="bathroom">
                    <option value="">Please select</option>
                    @if (count($mBathrooms) > 0)
                    @foreach ($mBathrooms as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('bathroom')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="furnishing" class="ads-label">Furnishing</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('furnishing') is-invalid @enderror" name="furnishing"
                    wire:model.defer="furnishing">
                    <option value="">Please select</option>
                    @if (count($mFurnishing) > 0)
                    @foreach ($mFurnishing as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('furnishing')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="listedBy" class="ads-label">Listed by</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('listedBy') is-invalid @enderror" name="listedBy"
                    wire:model.defer="listedBy">
                    <option value="">Please select</option>
                    @if (count($mListedBy) > 0)
                    @foreach ($mListedBy as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('listedBy')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="superBuiltupArea" class="ads-label">Super Builtup area*</label>
            </div>
            <div class="input-fields-container">
                <input type="text"
                    class="ads-inputp-field square-bx @error('superBuiltupArea') is-invalid @enderror"
                    name="superBuiltupArea" wire:model.defer="superBuiltupArea"
                    oninput="onlyNumber('superBuiltupArea')" id="superBuiltupArea" />
                <span class="square-feet">ft<sup>2</sup></span>
                @error('superBuiltupArea')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="carpetArea" class="ads-label">Carpet Area*</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field square-bx @error('carpetArea') is-invalid @enderror"
                    name="carpetArea" wire:model.defer="carpetArea" oninput="onlyNumber('carpetArea')"
                    id="carpetArea" />
                <span class="square-feet">ft<sup>2</sup></span>
                @error('carpetArea')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="isBachelorsAllowed" class="ads-label">Bachelors Allowed</label>
            </div>
            <div class="input-fields-container">
                <input type="radio" name="isBachelorsAllowed" wire:model.defer="isBachelorsAllowed"
                    class="radio-field" value="2" />&nbsp;<span class="new">No</span>
                <input type="radio" name="isBachelorsAllowed" wire:model.defer="isBachelorsAllowed"
                    class="radio-field" value="1" />&nbsp;<span class="new">Yes</span>
                @error('isBachelorsAllowed')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="totalFloor" class="ads-label">Total Floors</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('totalFloor') is-invalid @enderror"
                    name="totalFloor" wire:model.defer="totalFloor" />
                @error('totalFloor')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="floorNo" class="ads-label">Floor No</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('floorNo') is-invalid @enderror"
                    name="floorNo" wire:model.defer="floorNo" />
                @error('floorNo')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="carParking" class="ads-label">Car Parking</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('carParking') is-invalid @enderror" name="carParking"
                    wire:model.defer="carParking">
                    <option value="">Please select</option>
                    @if (count($mCarParking) > 0)
                    @foreach ($mCarParking as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('carParking')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="facing" class="ads-label">Facing</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('facing') is-invalid @enderror" name="facing"
                    wire:model.defer="facing">
                    <option value="">Please select</option>
                    @if (count($mFacing) > 0)
                    @foreach ($mFacing as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('facing')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')" id="price"
                        maxlength="15" oninput="onlyNumber('price')" id="price" maxlength="15"
                        oninput="onlyNumber('price')" id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @elseif ($catRow['id'] == 22)
    {{--  
    Property > Property For Rent > Roommates & Rooms for Rent => 22
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="bedroom" class="ads-label">Bedroom</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('bedroom') is-invalid @enderror" name="bedroom"
                    wire:model.defer="bedroom">
                    <option value="">Please select</option>
                    @if (count($mBedrooms) > 0)
                    @foreach ($mBedrooms as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('bedroom')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="bathroom" class="ads-label">Bathroom</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('bathroom') is-invalid @enderror" name="bathroom"
                    wire:model.defer="bathroom">
                    <option value="">Please select</option>
                    @if (count($mBathrooms) > 0)
                    @foreach ($mBathrooms as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('bathroom')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="furnishing" class="ads-label">Furnishing</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('furnishing') is-invalid @enderror" name="furnishing"
                    wire:model.defer="furnishing">
                    <option value="">Please select</option>
                    @if (count($mFurnishing) > 0)
                    @foreach ($mFurnishing as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('furnishing')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="listedBy" class="ads-label">Listed by</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('listedBy') is-invalid @enderror" name="listedBy"
                    wire:model.defer="listedBy">
                    <option value="">Please select</option>
                    @if (count($mListedBy) > 0)
                    @foreach ($mListedBy as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('listedBy')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="superBuiltupArea" class="ads-label">Super Builtup area*</label>
            </div>
            <div class="input-fields-container">
                <input type="text"
                    class="ads-inputp-field square-bx @error('superBuiltupArea') is-invalid @enderror"
                    name="superBuiltupArea" wire:model.defer="superBuiltupArea"
                    oninput="onlyNumber('superBuiltupArea')" id="superBuiltupArea" />
                <span class="square-feet">ft<sup>2</sup></span>
                @error('superBuiltupArea')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="carpetArea" class="ads-label">Carpet Area*</label>
            </div>
            <div class="input-fields-container">
                <input type="text"
                    class="ads-inputp-field square-bx @error('carpetArea') is-invalid @enderror"
                    name="carpetArea" wire:model.defer="carpetArea" oninput="onlyNumber('carpetArea')"
                    id="carpetArea" />
                <span class="square-feet">ft<sup>2</sup></span>
                @error('carpetArea')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')" id="price"
                        maxlength="15" oninput="onlyNumber('price')" id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @elseif (in_array($catRow['id'], [17, 18, 23, 24]))
    {{--  
    Property > Property For Sale > Land for Sale => 17
    Property > Property For Sale > Parking for Sale => 18
    Property > Property For Rent > Parking for Rent => 23
    Property > Property For Rent > Land for Rent => 24
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="listedBy" class="ads-label">Listed by</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('listedBy') is-invalid @enderror" name="listedBy"
                    wire:model.defer="listedBy">
                    <option value="">Please select</option>
                    @if (count($mListedBy) > 0)
                    @foreach ($mListedBy as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('listedBy')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="plotArea" class="ads-label">Plot Area*</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field square-bx @error('plotArea') is-invalid @enderror"
                    name="plotArea" wire:model.defer="plotArea" oninput="onlyNumber('plotArea')"
                    id="plotArea" />
                @error('plotArea')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="length" class="ads-label">Length</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('length') is-invalid @enderror"
                    name="length" wire:model.defer="length" oninput="onlyNumber('length')" id="length" />
                @error('length')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="breadth" class="ads-label">Breadth</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('breadth') is-invalid @enderror"
                    name="breadth" wire:model.defer="breadth" oninput="onlyNumber('breadth')" id="breadth" />
                @error('breadth')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="facing" class="ads-label">Facing</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('facing') is-invalid @enderror" name="facing"
                    wire:model.defer="facing">
                    <option value="">Please select</option>
                    @if (count($mFacing) > 0)
                    @foreach ($mFacing as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('facing')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')" id="price"
                        maxlength="15" oninput="onlyNumber('price')" id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @elseif (in_array($catRow['id'], [25, 28]))
    {{--  
    Property > Property For Rent > Commercial Space for Rent => 25
    Property > Property To Share > Commercial Space for Shared => 28
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="furnishing" class="ads-label">Furnishing</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('furnishing') is-invalid @enderror" name="furnishing"
                    wire:model.defer="furnishing">
                    <option value="">Please select</option>
                    @if (count($mFurnishing) > 0)
                    @foreach ($mFurnishing as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('furnishing')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="listedBy" class="ads-label">Listed by</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('listedBy') is-invalid @enderror" name="listedBy"
                    wire:model.defer="listedBy">
                    <option value="">Please select</option>
                    @if (count($mListedBy) > 0)
                    @foreach ($mListedBy as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('listedBy')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="superBuiltupArea" class="ads-label">Super Builtup area*</label>
            </div>
            <div class="input-fields-container">
                <input type="text"
                    class="ads-inputp-field square-bx @error('superBuiltupArea') is-invalid @enderror"
                    name="superBuiltupArea" wire:model.defer="superBuiltupArea"
                    oninput="onlyNumber('superBuiltupArea')" id="superBuiltupArea" />
                <span class="square-feet">ft<sup>2</sup></span>
                @error('superBuiltupArea')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="carpetArea" class="ads-label">Carpet Area*</label>
            </div>
            <div class="input-fields-container">
                <input type="text"
                    class="ads-inputp-field square-bx @error('carpetArea') is-invalid @enderror"
                    name="carpetArea" wire:model.defer="carpetArea" oninput="onlyNumber('carpetArea')"
                    id="carpetArea" />
                <span class="square-feet">ft<sup>2</sup></span>
                @error('carpetArea')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="carParking" class="ads-label">Car Parking</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('carParking') is-invalid @enderror" name="carParking"
                    wire:model.defer="carParking">
                    <option value="">Please select</option>
                    @if (count($mCarParking) > 0)
                    @foreach ($mCarParking as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('carParking')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="washroom" class="ads-label">Washrooms</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('washroom') is-invalid @enderror"
                    name="washroom" wire:model.defer="washroom" oninput="onlyNumber('washroom')"
                    id="washroom" />
                @error('washroom')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')" id="price"
                        maxlength="15" oninput="onlyNumber('price')" id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @elseif (in_array($catRow['id'], [15, 16]))
    {{--  
    Property > Property For Sale > Houses for Sale => 15
    Property > Property For Sale > Flats for Sale => 16 
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="bedroom" class="ads-label">Bedroom</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('bedroom') is-invalid @enderror" name="bedroom"
                    wire:model.defer="bedroom">
                    <option value="">Please select</option>
                    @if (count($mBedrooms) > 0)
                    @foreach ($mBedrooms as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('bedroom')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="bathroom" class="ads-label">Bathroom</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('bathroom') is-invalid @enderror" name="bathroom"
                    wire:model.defer="bathroom">
                    <option value="">Please select</option>
                    @if (count($mBathrooms) > 0)
                    @foreach ($mBathrooms as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('bathroom')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="furnishing" class="ads-label">Furnishing</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('furnishing') is-invalid @enderror" name="furnishing"
                    wire:model.defer="furnishing">
                    <option value="">Please select</option>
                    @if (count($mFurnishing) > 0)
                    @foreach ($mFurnishing as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('furnishing')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="constructionStatus" class="ads-label">Construction status</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('constructionStatus') is-invalid @enderror"
                    name="constructionStatus" wire:model.defer="constructionStatus">
                    <option value="">Please select</option>
                    @if (count($mConstructionStatus) > 0)
                    @foreach ($mConstructionStatus as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('constructionStatus')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="listedBy" class="ads-label">Listed by</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('listedBy') is-invalid @enderror" name="listedBy"
                    wire:model.defer="listedBy">
                    <option value="">Please select</option>
                    @if (count($mListedBy) > 0)
                    @foreach ($mListedBy as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('listedBy')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="superBuiltupArea" class="ads-label">Super Builtup area*</label>
            </div>
            <div class="input-fields-container">
                <input type="text"
                    class="ads-inputp-field square-bx @error('superBuiltupArea') is-invalid @enderror"
                    name="superBuiltupArea" wire:model.defer="superBuiltupArea"
                    oninput="onlyNumber('superBuiltupArea')" id="superBuiltupArea" />
                <span class="square-feet">ft<sup>2</sup></span>
                @error('superBuiltupArea')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="carpetArea" class="ads-label">Carpet Area*</label>
            </div>
            <div class="input-fields-container">
                <input type="text"
                    class="ads-inputp-field square-bx @error('carpetArea') is-invalid @enderror"
                    name="carpetArea" wire:model.defer="carpetArea" oninput="onlyNumber('carpetArea')"
                    id="carpetArea" />
                <span class="square-feet">ft<sup>2</sup></span>
                @error('carpetArea')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="totalFloor" class="ads-label">Total Floors</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('totalFloor') is-invalid @enderror"
                    name="totalFloor" wire:model.defer="totalFloor" oninput="onlyNumber('totalFloor')"
                    id="totalFloor" />
                @error('totalFloor')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="floorNo" class="ads-label">Floor No</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('floorNo') is-invalid @enderror"
                    name="floorNo" wire:model.defer="floorNo" oninput="onlyNumber('floorNo')" id="floorNo" />
                @error('floorNo')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="carParking" class="ads-label">Car Parking</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('carParking') is-invalid @enderror" name="carParking"
                    wire:model.defer="carParking">
                    <option value="">Please select</option>
                    @if (count($mCarParking) > 0)
                    @foreach ($mCarParking as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('carParking')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="facing" class="ads-label">Facing</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('facing') is-invalid @enderror" name="facing"
                    wire:model.defer="facing">
                    <option value="">Please select</option>
                    @if (count($mFacing) > 0)
                    @foreach ($mFacing as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('facing')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')" id="price"
                        maxlength="15" oninput="onlyNumber('price')" id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderroran>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @elseif (in_array($catRow['id'], [19]))
    {{--  
    Property > Property For Sale > Commercial Space for Sale => 19
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="furnishing" class="ads-label">Furnishing</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('furnishing') is-invalid @enderror" name="furnishing"
                    wire:model.defer="furnishing">
                    <option value="">Please select</option>
                    @if (count($mFurnishing) > 0)
                    @foreach ($mFurnishing as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('furnishing')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="constructionStatus" class="ads-label">Construction status</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('constructionStatus') is-invalid @enderror"
                    name="constructionStatus" wire:model.defer="constructionStatus">
                    <option value="">Please select</option>
                    @if (count($mConstructionStatus) > 0)
                    @foreach ($mConstructionStatus as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('constructionStatus')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="listedBy" class="ads-label">Listed by</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('listedBy') is-invalid @enderror" name="listedBy"
                    wire:model.defer="listedBy">
                    <option value="">Please select</option>
                    @if (count($mListedBy) > 0)
                    @foreach ($mListedBy as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('listedBy')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="superBuiltupArea" class="ads-label">Super Builtup area*</label>
            </div>
            <div class="input-fields-container">
                <input type="text"
                    class="ads-inputp-field square-bx @error('superBuiltupArea') is-invalid @enderror"
                    name="superBuiltupArea" wire:model.defer="superBuiltupArea"
                    oninput="onlyNumber('superBuiltupArea')" id="superBuiltupArea" />
                <span class="square-feet">ft<sup>2</sup></span>
                @error('superBuiltupArea')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="carpetArea" class="ads-label">Carpet Area*</label>
            </div>
            <div class="input-fields-container">
                <input type="text"
                    class="ads-inputp-field square-bx @error('carpetArea') is-invalid @enderror"
                    name="carpetArea" wire:model.defer="carpetArea" oninput="onlyNumber('carpetArea')"
                    id="carpetArea" />
                <span class="square-feet">ft<sup>2</sup></span>
                @error('carpetArea')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="carParking" class="ads-label">Car Parking</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('carParking') is-invalid @enderror" name="carParking"
                    wire:model.defer="carParking">
                    <option value="">Please select</option>
                    @if (count($mCarParking) > 0)
                    @foreach ($mCarParking as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('carParking')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="washroom" class="ads-label">Washrooms</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('washroom') is-invalid @enderror"
                    name="washroom" wire:model.defer="washroom" oninput="onlyNumber('washroom')"
                    id="washroom" />
                @error('washroom')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')" id="price"
                        maxlength="15" oninput="onlyNumber('price')" id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @elseif (in_array($catRow['id'], [29]))
    {{--  
    Property > Guest Houses & PG => 29
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="furnishing" class="ads-label">Furnishing</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('furnishing') is-invalid @enderror" name="furnishing"
                    wire:model.defer="furnishing">
                    <option value="">Please select</option>
                    @if (count($mFurnishing) > 0)
                    @foreach ($mFurnishing as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('furnishing')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="listedBy" class="ads-label">Listed by</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('listedBy') is-invalid @enderror" name="listedBy"
                    wire:model.defer="listedBy">
                    <option value="">Please select</option>
                    @if (count($mListedBy) > 0)
                    @foreach ($mListedBy as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('listedBy')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="carParking" class="ads-label">Car Parking</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('carParking') is-invalid @enderror" name="carParking"
                    wire:model.defer="carParking">
                    <option value="">Please select</option>
                    @if (count($mCarParking) > 0)
                    @foreach ($mCarParking as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('carParking')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="isMealIncluded" class="ads-label">Meals Included</label>
            </div>
            <div class="input-fields-container">
                <input type="radio" name="isMealIncluded" wire:model.defer="isMealIncluded"
                    class="radio-field" value="2" />&nbsp;<span class="new">No</span>
                <input type="radio" name="isMealIncluded" wire:model.defer="isMealIncluded"
                    class="radio-field" value="1" />&nbsp;<span class="new">Yes</span>
                @error('isMealIncluded')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')" id="price"
                        maxlength="15" oninput="onlyNumber('price')" id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @elseif (in_array($catRow['id'], [36]))
    {{--  
    Vehicles > Cars => 36
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="regYear" class="ads-label">Reg. Year*</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('regYear') is-invalid @enderror"
                    name="regYear" wire:model.defer="regYear" />
                @error('regYear')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="fuelType" class="ads-label">Fuel type*</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('fuelType') is-invalid @enderror" name="fuelType"
                    wire:model.defer="fuelType">
                    <option value="">Please select</option>
                    @if (count($mFuelTypes) > 0)
                    @foreach ($mFuelTypes as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('fuelType')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="transmission" class="ads-label">Transmission*</label>
            </div>
            <div class="input-fields-container">
                @if (count($mTransmissions) > 0)
                @foreach ($mTransmissions as $item)
                <input id="transmission-{{ $item['id'] }}" type="radio" class="radio-field"
                    value="{{ $item['id'] }}" name="transmission" wire:model.defer="transmission" />
                &nbsp;<span for="transmission-{{ $item['id'] }}"
                    class="new">{{ $item['name'] }}</span>
                @endforeach
                @endif
                @error('transmission')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="kmDriven" class="ads-label">KM driven*</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('kmDriven') is-invalid @enderror"
                    name="kmDriven" wire:model.defer="kmDriven" oninput="onlyNumber('kmDriven')" id="kmDriven"
                    maxlength="6" />
                @error('kmDriven')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="owner" class="ads-label">No. of Owners*</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('owner') is-invalid @enderror" name="owner"
                    wire:model.defer="owner">
                    <option value="">Please select</option>
                    @if (count($mOwners) > 0)
                    @foreach ($mOwners as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('owner')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')" id="price"
                        maxlength="15" oninput="onlyNumber('price')" id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @elseif (in_array($catRow['id'], [37, 38]))
    {{--  
    Vehicles > Motorcycles => 37
    Vehicles > Scooters => 38
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="regYear" class="ads-label">Reg. Year*</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('regYear') is-invalid @enderror"
                    name="regYear" wire:model.defer="regYear" oninput="onlyNumber('regYear')" id="regYear"
                    maxlength="4" />
                @error('regYear')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="#" class="ads-label">Fuel type*</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('fuelType') is-invalid @enderror" name="fuelType"
                    wire:model.defer="fuelType">
                    <option value="">Please select</option>
                    @if (count($mFuelTypes) > 0)
                    @foreach ($mFuelTypes as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('fuelType')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="kmDriven" class="ads-label">KM driven*</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('kmDriven') is-invalid @enderror"
                    name="kmDriven" wire:model.defer="kmDriven" />
                @error('kmDriven')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="owner" class="ads-label">No. of Owners*</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('owner') is-invalid @enderror" name="owner"
                    wire:model.defer="owner">
                    <option value="">Please select</option>
                    @if (count($mOwners) > 0)
                    @foreach ($mOwners as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('owner')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')" id="price"
                        maxlength="15" oninput="onlyNumber('price')" id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @elseif (in_array($catRow['id'], [39]))
    {{--  
    Vehicles > Motorcycles => 39
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="fuelType" class="ads-label">Fuel type*</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('fuelType') is-invalid @enderror" name="fuelType"
                    wire:model.defer="fuelType">
                    <option value="">Please select</option>
                    @if (count($mFuelTypes) > 0)
                    @foreach ($mFuelTypes as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('fuelType')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="kmDriven" class="ads-label">KM driven*</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('kmDriven') is-invalid @enderror"
                    name="kmDriven" wire:model.defer="kmDriven" />
                @error('kmDriven')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')" id="price"
                        maxlength="15" oninput="onlyNumber('price')" id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @elseif (in_array($catRow['id'], [40]))
    {{--  
    Vehicles > Tractors => 40
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="regYear" class="ads-label">Reg. Year*</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('regYear') is-invalid @enderror"
                    name="regYear" wire:model.defer="regYear" />
                @error('regYear')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="hpPower" class="ads-label">HP Power</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('hpPower') is-invalid @enderror"
                    name="hpPower" wire:model.defer="hpPower" oninput="onlyNumber('hpPower')" id="hpPower"
                    maxlength="3" maxlength="3" />
                @error('hpPower')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="fuelType" class="ads-label">Fuel type*</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('fuelType') is-invalid @enderror" name="fuelType"
                    wire:model.defer="fuelType">
                    <option value="">Please select</option>
                    @if (count($mFuelTypes) > 0)
                    @foreach ($mFuelTypes as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('fuelType')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="kmDriven" class="ads-label">KM driven*</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('kmDriven') is-invalid @enderror"
                    name="kmDriven" wire:model.defer="kmDriven" />
                @error('kmDriven')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="owner" class="ads-label">No. of Owners*</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('owner') is-invalid @enderror" name="owner"
                    wire:model.defer="owner">
                    <option value="">Please select</option>
                    @if (count($mOwners) > 0)
                    @foreach ($mOwners as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('owner')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')" id="price"
                        maxlength="15" oninput="onlyNumber('price')" id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @elseif (in_array($catRow['id'], [41, 42]))
    {{--  
    Vehicles > Buses => 41
    Vehicles > Trucks => 42
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="regYear" class="ads-label">Reg. Year*</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('regYear') is-invalid @enderror"
                    name="regYear" wire:model.defer="regYear" />
                @error('regYear')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="fuelType" class="ads-label">Fuel type*</label>
            </div>
            <div class="input-fields-container  drop_hide">
                <select class="ads-inputp-field @error('fuelType') is-invalid @enderror" name="fuelType"
                    wire:model.defer="fuelType">
                    <option value="">Please select</option>
                    @if (count($mFuelTypes) > 0)
                    @foreach ($mFuelTypes as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('fuelType')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="transmission" class="ads-label">Transmission*</label>
            </div>
            <div class="input-fields-container">
                @if (count($mTransmissions) > 0)
                @foreach ($mTransmissions as $item)
                <input id="transmission-{{ $item['id'] }}" type="radio" class="radio-field"
                    value="{{ $item['id'] }}" name="transmission[]"
                    wire:model.defer="transmission" />
                &nbsp;<span for="transmission-{{ $item['id'] }}"
                    class="new">{{ $item['name'] }}</span>
                @endforeach
                @endif
                @error('transmission')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="kmDriven" class="ads-label">KM driven*</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('kmDriven') is-invalid @enderror"
                    name="kmDriven" wire:model.defer="kmDriven" />
                @error('kmDriven')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="owner" class="ads-label">No. of Owners*</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('owner') is-invalid @enderror" name="owner"
                    wire:model.defer="owner">
                    <option value="">Please select</option>
                    @if (count($mOwners) > 0)
                    @foreach ($mOwners as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('owner')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="bodyType" class="ads-label">Body Type</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('bodyType') is-invalid @enderror" name="bodyType"
                    wire:model.defer="bodyType">
                    <option value="">Please select</option>
                    @if (count($mbodyTypes) > 0)
                    @foreach ($mbodyTypes as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('bodyType')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')"
                        id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @elseif (in_array($catRow['id'], [43]))
    {{--  
    Vehicles > Parts & Accessories => 43
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="vehiclePartsAccessoryType" class="ads-label">Types*</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('vehiclePartsAccessoryType') is-invalid @enderror"
                    name="vehiclePartsAccessoryType" wire:model.defer="vehiclePartsAccessoryType">
                    <option value="">Please select</option>
                    @if (count($mvehiclePartsAccessoryTypes) > 0)
                    @foreach ($mvehiclePartsAccessoryTypes as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('vehiclePartsAccessoryType')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')"
                        id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @elseif (in_array(2, [$catIds]) && isFormCat(collect($catNav)->pluck('id')) == true)
    {{--  
    Jobs => 2
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="salaryPeriod" class="ads-label">Salary period*</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('salaryPeriod') is-invalid @enderror"
                    name="salaryPeriod" wire:model.defer="salaryPeriod">
                    <option value="">Please select</option>
                    @if (count($mSalaryPeriods) > 0)
                    @foreach ($mSalaryPeriods as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('salaryPeriod')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="educationLevel" class="ads-label">Education level</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('educationLevel') is-invalid @enderror"
                    name="educationLevel" wire:model.defer="educationLevel">
                    <option value="">Please select</option>
                    @if (count($mEducationLevels) > 0)
                    @foreach ($mEducationLevels as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('educationLevel')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="salaryFrom" class="ads-label">Salary from</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text" class="ads-inputp-field @error('salaryFrom') is-invalid @enderror"
                        name="salaryFrom" wire:model.defer="salaryFrom" oninput="onlyNumber('salaryFrom')"
                        id="salaryFrom" maxlength="7" />
                    @error('salaryFrom')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="salaryTo" class="ads-label">Salary to</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text" class="ads-inputp-field @error('salaryTo') is-invalid @enderror"
                        name="salaryTo" wire:model.defer="salaryTo" oninput="onlyNumber('salaryTo')"
                        id="salaryTo" maxlength="7" />
                    @error('salaryTo')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="positionType" class="ads-label">Position type*</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('positionType') is-invalid @enderror"
                    name="positionType" wire:model.defer="positionType">
                    <option value="">Please select</option>
                    @if (count($mPositionTypes) > 0)
                    @foreach ($mPositionTypes as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('positionType')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="experienceYear" class="ads-label">Years of experience</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('experienceYear') is-invalid @enderror"
                    name="experienceYear" wire:model.defer="experienceYear">
                    <option value="">Please select</option>
                    @if (count($mExperienceYears) > 0)
                    @foreach ($mExperienceYears as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('experienceYear')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    @elseif (in_array($catRow['id'], [30]))
    {{--  
    Pets > Pets for Sale => 30
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="petAge" class="ads-label">Age</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('petAge') is-invalid @enderror" name="petAge"
                    wire:model.defer="petAge">
                    <option value="">Please select</option>
                    @if (count($mPetAges) > 0)
                    @foreach ($mPetAges as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('petAge')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="petBreed" class="ads-label">Breed*</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('petBreed') is-invalid @enderror"
                    name="petBreed" wire:model.defer="petBreed" />
                @error('petBreed')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="petGender" class="ads-label">Gender</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('petGender') is-invalid @enderror" name="petGender"
                    wire:model.defer="petGender">
                    <option value="">Please select</option>
                    @if (count($mPetGenders) > 0)
                    @foreach ($mPetGenders as $item)
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                    @endforeach
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('petGender')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="petColour" class="ads-label">Colour</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('petColour') is-invalid @enderror"
                    name="petColour" wire:model.defer="petColour" />
                @error('petColour')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')"
                        id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @elseif (in_array($catRow['id'], [31]))
    {{--  
    Pets > Pets Accessories => 31
    --}}
    <div class="row">
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')"
                        id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @elseif (in_array($catRow['id'], [9, 11]))
    {{--  
    Community > Friendship and Dating => 9
    Community > Friendship and Dating => 11
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="communityAge" class="ads-label">Age*</label>
            </div>
            <div class="input-fields-container">
                <input type="text" class="ads-inputp-field @error('communityAge') is-invalid @enderror"
                    name="communityAge" wire:model.defer="communityAge" oninput="onlyNumber('communityAge')"
                    id="communityAge" maxlength="2" />
                @error('communityAge')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    @elseif (in_array($catRow['id'], [10]))
    {{--  
    Community > Classes and Tuition => 10
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="communityDateFrom" class="ads-label">Date *</label>
            </div>
            <div class="input-fields-container">
                <input type="text"
                    class="ads-inputp-field @error('communityDateFrom') is-invalid @enderror datepicker"
                    name="communityDateFrom" wire:model.defer="communityDateFrom" id="from" readonly />
                @error('communityDateFrom')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-6"
            style="display:{{ !empty($communityDateFrom) ? 'block' : 'none' }};">
            <div class="label-container">
                <label for="communityDateTo" class="ads-label">To</label>
            </div>
            <div class="input-fields-container">
                <input type="text"
                    class="ads-inputp-field @error('communityDateTo') is-invalid @enderror datepicker"
                    name="communityDateTo" wire:model.defer="communityDateTo" id="to" />
                @error('communityDateTo')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    @elseif (in_array($catRow['id'], [32, 33, 34, 35]))
    {{--  
    For Sale > Fashion for Sale => 32
    For Sale > Mobiles & Tablets => 33
    For Sale > Furniture => 34
    For Sale > Electronics & Appliances => 35
    --}}
    <div class="row">
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="condition" class="ads-label">Condition*</label>
            </div>
            <div class="input-fields-container">
                @if (count($mCondition) > 0)
                @foreach ($mCondition as $item)
                <input id="condition-{{ $item['id'] }}" type="radio" class="radio-field"
                    value="{{ $item['id'] }}" name="condition" wire:model.defer="condition" />
                &nbsp;<span for="condition-{{ $item['id'] }}"
                    class="new">{{ $item['name'] }}</span>
                @endforeach
                @endif
                @error('condition')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')"
                        id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @elseif (in_array(5, [$catIds]) && isFormCat(collect($catNav)->pluck('id')) == true)
    {{--  
    Rent => 5
    --}}
    <div class="row">
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="price" class="ads-label">Price*</label>
            </div>
            <div class="input-fields-container">
                <div class="price">
                    <span class="price-icon"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                    <input type="text"
                        class="ads-inputp-field @error('price') is-invalid @enderror price-input-field"
                        name="price" wire:model.defer="price" oninput="onlyNumber('price')"
                        id="price" maxlength="15" />
                    @error('price')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="form-flex-container col-md-12">
            <div class="label-container">
                <label for="name" class="ads-label">Title*</label>
            </div>
            <div class="input-fields-container">
                <div class="category-title">
                    <input type="text" class="ads-inputp-field @error('name') is-invalid @enderror"
                        name="name" wire:model.defer="name" id="name-input" maxlength="70" />
                    <!-- <div class="d-flex justify-content-between mydiv"> -->
                    <div class="mydiv">
                        @error('name')
                        <div class="error">{{ $message }}</div>
                        @enderror
                        <div class="text-len">
                            <span
                                class="title-number"><span id="name-counter">{{ strlen($name) }}</span> /
                            70</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="discription-container">
            <div class="form-flex-container col-md-12">
                <div class="label-container">
                    <label for="description" class="ads-label">Description*</label>
                </div>
                <div class="input-fields-container">
                    <textarea cols="15" rows="5" class="@error('description') is-invalid @enderror" name="description"
                        wire:model.defer="description" id="description-input"></textarea>
                    <!-- <div class="d-flex justify-content-between mydiv"> -->
                    <div class="mydiv desc-error-div">
                        @error('description')
                        <div class="error">{{ $message }}</div>
                        @enderror
                        <div class="text-len">
                            <span class="title-number"><span
                                id="description-counter">{{ strlen($description) }}</span> /
                            5000 </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- 
        <div class="form-flex-container col-md-6">
            <div class="label-container">
                <label for="phone" class="ads-label">Phone number*</label>
            </div>
            <div class="input-fields-container drop_hide">
                <select class="ads-inputp-field @error('phone') is-invalid @enderror" name="phone"
                    wire:model.defer="phone" id="phone">
                    <option value="">Please select</option>
                    <option value="2">None</option>
                    @if (!empty(Auth::user()->phone))
                    <option value="1">
                        {{ Auth::user()->phone }}{{ empty(Auth::user()->phone_verified_at) ? ' (not verified, please verify your number)' : '' }}
                    </option>
                    @endif
                </select>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                </svg>
                @error('phone')
                <div class="error">{{ $message }}</div>
                @enderror
            </div>
        </div>
        --}}
        <div class="form-flex-container">
            <div class="col-md-12">
                <div class="label-container">
                    <label for="phone" class="ads-label phone-after-txt">Phone*</label>
                </div>
                <div class="row d-flex flex-nowrap justify-content-start">
                    <div class="col-md-6 d-flex justify-content-start myspace">
                        <div class="input-fields-container">
                            <div class="tel-flex-box">
                                <div class="tel-container tel-container2 drop_hide">
                                    <select class="ads-inputp-field @error('phone') is-invalid @enderror"
                                        name="phone" wire:model.defer="phone" id="phone">
                                        <option value="">Please select</option>
                                        <option value="2">None</option>
                                        @if (!empty(Auth::user()->phone))
                                        @if (empty(Auth::user()->phone_verified_at))
                                        <option value="3"> {{ Auth::user()->phone }}(not verified,
                                            please verify your number)
                                        </option>
                                        @else
                                        <option value="1"> {{ Auth::user()->phone }}</option>
                                        @endif
                                        @endif
                                    </select>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" width="14px" height="14px">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                                    </svg>
                                </div>
                                {{-- @if (!empty(Auth::user()->phone_verified_at))
                                <div class="whatsapp-check-box" id="isWhatsApp"
                                    style="display: {{ isset($phone) && $phone == 1 ? 'block' : 'none' }}">
                                    <input type="checkbox" wire:model.defer="isWhatsApp">
                                    <img src="{{ config('global_variables.asset_url') }}/img/whatsapp.png"
                                        alt="whats app">
                                </div>
                                @endif --}}
                            </div>
                        </div>
                        @if (!empty(Auth::user()->phone_verified_at))
                        {{-- 
                        <span class="xm-screen-view wapp-sty whatsapp-icon">
                            <svg width="30px" height="30px"
                                viewBox="0 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0" />
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <g id="SVGRepo_iconCarrier">
                                    <title>Whatsapp-color</title>
                                    <desc>Created with Sketch.</desc>
                                    <defs> </defs>
                                    <g id="Icons" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd">
                                        <g id="Color-" transform="translate(-700.000000, -360.000000)"
                                            fill="#67C15E">
                                            <path
                                                d="M723.993033,360 C710.762252,360 700,370.765287 700,383.999801 C700,389.248451 701.692661,394.116025 704.570026,398.066947 L701.579605,406.983798 L710.804449,404.035539 C714.598605,406.546975 719.126434,408 724.006967,408 C737.237748,408 748,397.234315 748,384.000199 C748,370.765685 737.237748,360.000398 724.006967,360.000398 L723.993033,360.000398 L723.993033,360 Z M717.29285,372.190836 C716.827488,371.07628 716.474784,371.034071 715.769774,371.005401 C715.529728,370.991464 715.262214,370.977527 714.96564,370.977527 C714.04845,370.977527 713.089462,371.245514 712.511043,371.838033 C711.806033,372.557577 710.056843,374.23638 710.056843,377.679202 C710.056843,381.122023 712.567571,384.451756 712.905944,384.917648 C713.258648,385.382743 717.800808,392.55031 724.853297,395.471492 C730.368379,397.757149 732.00491,397.545307 733.260074,397.27732 C735.093658,396.882308 737.393002,395.527239 737.971421,393.891043 C738.54984,392.25405 738.54984,390.857171 738.380255,390.560912 C738.211068,390.264652 737.745308,390.095816 737.040298,389.742615 C736.335288,389.389811 732.90737,387.696673 732.25849,387.470894 C731.623543,387.231179 731.017259,387.315995 730.537963,387.99333 C729.860819,388.938653 729.198006,389.89831 728.661785,390.476494 C728.238619,390.928051 727.547144,390.984595 726.969123,390.744481 C726.193254,390.420348 724.021298,389.657798 721.340985,387.273388 C719.267356,385.42535 717.856938,383.125756 717.448104,382.434484 C717.038871,381.729275 717.405907,381.319529 717.729948,380.938852 C718.082653,380.501232 718.421026,380.191036 718.77373,379.781688 C719.126434,379.372738 719.323884,379.160897 719.549599,378.681068 C719.789645,378.215575 719.62006,377.735746 719.450874,377.382942 C719.281687,377.030139 717.871269,373.587317 717.29285,372.190836 Z"
                                                id="Whatsapp"> </path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <div class="xm-screen-view form-check mt-1 whatsapp-div" style="padding-top:5px">
                            <input type="checkbox" class="form-check-input" id="exampleCheck134">
                            <label class="form-check-label" for="exampleCheck134"></label>
                            Whats App
                        </div>
                        --}}
                        @endif
                    </div>
                    @if (!empty(Auth::user()->phone_verified_at))
                    <div class="col-md-6 xl-screen-view whatsapp-div myspace"
                        style="display: {{ isset($phone) && $phone == 1 ? 'block' : 'none' }}">
                        <div class=" d-flex justify-content-start mt-1">
                            <span style="margin-right:20px">
                                <svg width="30px" height="30px"
                                    viewBox="0 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0" />
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <g id="SVGRepo_iconCarrier">
                                        <title>Whatsapp-color</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs> </defs>
                                        <g id="Icons" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd">
                                            <g id="Color-" transform="translate(-700.000000, -360.000000)"
                                                fill="#67C15E">
                                                <path
                                                    d="M723.993033,360 C710.762252,360 700,370.765287 700,383.999801 C700,389.248451 701.692661,394.116025 704.570026,398.066947 L701.579605,406.983798 L710.804449,404.035539 C714.598605,406.546975 719.126434,408 724.006967,408 C737.237748,408 748,397.234315 748,384.000199 C748,370.765685 737.237748,360.000398 724.006967,360.000398 L723.993033,360.000398 L723.993033,360 Z M717.29285,372.190836 C716.827488,371.07628 716.474784,371.034071 715.769774,371.005401 C715.529728,370.991464 715.262214,370.977527 714.96564,370.977527 C714.04845,370.977527 713.089462,371.245514 712.511043,371.838033 C711.806033,372.557577 710.056843,374.23638 710.056843,377.679202 C710.056843,381.122023 712.567571,384.451756 712.905944,384.917648 C713.258648,385.382743 717.800808,392.55031 724.853297,395.471492 C730.368379,397.757149 732.00491,397.545307 733.260074,397.27732 C735.093658,396.882308 737.393002,395.527239 737.971421,393.891043 C738.54984,392.25405 738.54984,390.857171 738.380255,390.560912 C738.211068,390.264652 737.745308,390.095816 737.040298,389.742615 C736.335288,389.389811 732.90737,387.696673 732.25849,387.470894 C731.623543,387.231179 731.017259,387.315995 730.537963,387.99333 C729.860819,388.938653 729.198006,389.89831 728.661785,390.476494 C728.238619,390.928051 727.547144,390.984595 726.969123,390.744481 C726.193254,390.420348 724.021298,389.657798 721.340985,387.273388 C719.267356,385.42535 717.856938,383.125756 717.448104,382.434484 C717.038871,381.729275 717.405907,381.319529 717.729948,380.938852 C718.082653,380.501232 718.421026,380.191036 718.77373,379.781688 C719.126434,379.372738 719.323884,379.160897 719.549599,378.681068 C719.789645,378.215575 719.62006,377.735746 719.450874,377.382942 C719.281687,377.030139 717.871269,373.587317 717.29285,372.190836 Z"
                                                    id="Whatsapp"> </path>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </span>
                            <div class="form-check mt-1">
                                <input type="checkbox" class="form-check-input" id="isWhatsApp"
                                    type="checkbox" wire:model.defer="isWhatsApp">
                                <label class="form-check-label" for="isWhatsApp">Available on
                                WhatsApp</label>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @error('phone')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
    </div>
    {{--
    //Jobs => 2
    --}}
    @if (!in_array($this->catRow['id'], [2]))
    <div class="form-flex-container col-md-12">
        <div class="label-container">
            <label for="images" class="ads-label add-after-text">Add image</label>
        </div>
        <div class="input-fields-container">
            {{-- 
            <div class="upload__box">
                <div class="upload__btn-box">
                    <label class="upload__btn">
                    <img src="{{ config('global_variables.asset_url') }}/img/upload-image.png"
                        alt="">
                    <input type="file" multiple="" data-max_length="4" name="images[]"
                        wire:model.defer="images">
                    </label> 
                </div>
                <div class="upload__img-wrap"></div>
                <div class="txt-lmt">Max. 5 images to be uplaod</div>
            </div>
            --}}
            <div class="upload__box_view d-flex justify-content-start">
                <div class="upload__img-wrap">
                    @php
                    $imgCount = 0;
                    if (!empty($post) && count($post) > 0) {
                    $listSrc = '/storage/cms/post/list/';
                    } else {
                    $listSrc = '/storage/cms/temp/list/';
                    }
                    @endphp
                    @if (count($showImages) > 0)
                    @foreach ($showImages as $key => $im)
                    @php  $imgCount++; @endphp
                    <div class='upload__img-box'
                        wire:click="removeImage('{{ $im }}', '{{ $key }}')">
                        <div style='background-image: url("{{ config('global_variables.asset_url') . $listSrc . $im }}")'
                        class='img-bg'>
                        <div class='upload__img-close'></div>
                    </div>
                </div>
                @endforeach
                @endif
                @if ($imgCount < 5)
                <div class="my_upload__btn-box">
                    <label class="my_upload__btn">
                        <div class="img-box-upload-v">
                            <img src="{{ config('global_variables.asset_url') }}/img/icons8-add-image-30.png"
                                alt="" />
                        </div>
                        <input type="file" multiple="" data-max_length="4" name="images[]"
                            wire:model="images" class="upload__inputfile" accept=".jpg, .png">
                    </label>
                </div>
                @endif
            </div>
        </div>
        <div class="txt-lmt">Maximum file size 5mb</div>
        @error('images')
        <div class="error">{{ $message }}</div>
        @enderror
        @error('images.*')
        <div class="error">{{ $message }}</div>
        @enderror
        @if (!empty($imageError))
        <div class="error">{{ $imageError }}</div>
        @endif
    </div>
    </div>
    @endif
    <div class="form-flex-container col-md-6">
        <div class="label-container">
            <label for="locaton" class="ads-label">Location*</label>
        </div>
        {{-- wire:ignore --}}
        <div class="input-fields-container">
            <input type="text" class="ads-inputp-field @error('locaton') is-invalid @enderror"
            id="search-box-post" name="locaton" wire:model.defer="locaton"
            @if (!empty($post)) readonly @endif />
            <div class="search-loc" id="suggesstion-box"></div>
            @error('locaton')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <button style="margin-top: 70px;" class="post-ad-" type="submit">Post your ad</button>
</form>
<div class="products-links">
    <div>
        <div class="property-links">
            <div class="dash-search-product">
                <input type="text" placeholder="Search ads..." class="dash-search" wire:model="searchTitle" />
                <div class="custom-select custom-select-ads all-ads-dropdown">
                    @if (count($postStatusArr) > 0)
                        <div class="select-title kkkkkkkk">
                            {{ isset($postStatusArr[$postStatus]) ? $postStatusArr[$postStatus] . ' Ad' : 'All Ads' }}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" width="16px" height="16px">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                        <ul>
                            <li><a href="#" wire:click.prevent="searchByStatus('all')">All Ads</li></a>
                            @foreach ($postStatusArr as $key => $val)
                                <li><a href="#"
                                        wire:click.prevent="searchByStatus('{{ $key }}')">{{ $val }}
                                        Ad</li></a>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        @if (count($myPosts) > 0)
            @foreach ($myPosts as $p)
                @php
                    $locationListName = '';
                    if (!empty($p->locality_id)) {
                        $locationListName = !empty($p->locality) ? $p->locality->name : '';
                    } elseif (!empty($p->city_id)) {
                        $locationListName = !empty($p->city) ? $p->city->name : '';
                    } elseif (!empty($p->state_id)) {
                        $locationListName = !empty($p->state) ? $p->state->name : '';
                    }
                    $planActiveDays = 0;
                    if (!empty($p->active_date)) {
                        $currentDate = \Carbon\Carbon::now();
                        $plan_end_date = \Carbon\Carbon::parse($p->active_date);
                        $planActiveDays = $plan_end_date->diffInDays($currentDate);
                    }
                @endphp
                <div class="prdct-link-select-box {{ $p->status == 'nsfw' ? 'post-nsfw' : '' }} d-flex">
                  <div>
                    <div class="custom-select custom-select-ads">
                        @if (count($postStatusArr) > 0)
                            <div class="select-title yyyyyyyyyy">
                                {{ isset($postStatusArr[$p->status]) ? $postStatusArr[$p->status] : '' }}
                                <svg xmlns="http://w/ww.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" width="16px" height="16px">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                            @if ($p->status == 'pending' || $p->status == 'nsfw')
                            @else
                                <ul>
                                    @foreach ($postStatusArr as $key => $val)
                                        @if ($key != 'pending')
                                            <li><a href="javascript:;"
                                                    wire:click.prevent='$emit("openModal", "modals.my-post-change-status", {{ json_encode(['postId' => $p->id, 'status' => $key]) }})'
                                                    {{ $p->status == $key ? 'selected' : '' }}> {{ $val }} </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        @endif
                        
                    </div>
                     <div class="m-2">
                 	    <div>
                 	        <span class="text-secondary">Published on : {{ !empty($p->created_at) ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $p->created_at)->format('d/m/Y') : '' }}</span>
                 	    </div>
                 	    <div>
                 	        <span class="text-secondary">Expire on : {{ Carbon\Carbon::now()->addDays($planActiveDays)->format('d/m/Y') }}</span>
                 	    </div>
                     </div>
                  </div>

                @if ($p->status == 'active')
                <div style="border-left: 3px solid #0d6efd;">

                 <div style="margin-left:10px" class="mt-1">
                    <div style="color:#0d6efd;"> <Strong>Promotion to pay </Strong></div>
                    <div class="mt-2">Top ad 15 <span style="color:#0d6efd;">days </span>+</div> 
                    <div>Urgent ad 7 <span style="color:#0d6efd;">days</span> + Highlight ad 30 <span style="color:#0d6efd;">days</span></div>
                 </div>

                </div>
                    @else
                    <div style="border-left: 3px solid #dc3545;">
                        <div style="margin-left:10px" class="mt-1">
                            <div class="text-danger">Top ad expired on: 03/10/23</div>
                            <div class="text-danger mt-2">Urgent ad expired on: 26/09/23</div> 
                            <div class="text-danger">Highlight ad expired on: 04/11/23</div>
                        </div>
                    </div>
                @endif
                

                </div>
                @if ($p->status == 'nsfw')
                    <div class="div-post-nsfw">
                        Here goes text message for nsfw
                    </div>
                @endif

                @php
                    $jobClassName = '';    
                    if($p->category_id == 2 ){
                        $jobClassName = 'link-container-job';
                    }
                @endphp

                <div class="link-container dash-link {{$jobClassName}}" style="margin-bottom: 0;">
                <a  href="{{ route('post-detail', ['slug' => Str::slug($p->name, '-'), 'id' => $p->id]) }}">
                        <h3> {{ $p->name }}</h3>
                        <div class="luton-town">
                           
                            @if ($p->category_id != 2)
                            <div class="product-img">
                                @if (
                                    !empty($p->image_path_1) ||
                                        !empty($p->image_path_2) ||
                                        !empty($p->image_path_3) ||
                                        !empty($p->image_path_4) ||
                                        !empty($p->image_path_5))
                                    @php
                                        $imgSrc = '';
                                        $imgCount = 0;
                                        if (!empty($p->image_path_5)) {
                                            $imgSrc = $p->image_path_5;
                                            $imgCount++;
                                        }
                                        if (!empty($p->image_path_4)) {
                                            $imgSrc = $p->image_path_4;
                                            $imgCount++;
                                        }
                                        if (!empty($p->image_path_3)) {
                                            $imgSrc = $p->image_path_3;
                                            $imgCount++;
                                        }
                                        if (!empty($p->image_path_2)) {
                                            $imgSrc = $p->image_path_2;
                                            $imgCount++;
                                        }
                                        if (!empty($p->image_path_1)) {
                                            $imgSrc = $p->image_path_1;
                                            $imgCount++;
                                        }
                                    @endphp
                                    <img src="{{ config('global_variables.asset_url') }}/storage/cms/post/list/{{ $imgSrc }}"
                                        alt="{{ $p->name }}"
                                        onerror="this.src='{{ config('global_variables.asset_url') }}/img/no-post-list.jpg'" />
                                    @if ($imgCount > 1)
                                        <span class="room-pictures">
                                            <i class="fa-solid fa-camera"></i> {{ $imgCount - 1 }}
                                        </span>
                                    @endif
                                @else
                                    <img src="{{ config('global_variables.asset_url') }}/img/no-post-list.jpg"
                                        alt="{{ $p->name }}" />
                                @endif




                            </div>
                            @endif
                            <div class="product-text">
                                <div class="itemp-prices">
                                    @if ($p->price > 0)
                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                        {{ getMoneyFormat($p->price, 0) }}
                                    @endif
                                </div>
                                <!-- <div class="itemp-prices d-flex nowrap">
                                    
                                </div> -->
                                
                                <div class="location-gurgaon"><i class="fa-solid fa-location-dot"></i>
                                    {{ $locationListName }} |
                                    {{ !empty($p->created_at) ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $p->created_at)->format('d/m/Y') : '' }}
                                </div>
                                 <!-- <p>{{ Str::limit(str_replace('<br />', ' ', $p->description), 150, '...') }} -->
                          <div class="d-flex">

                           <div class="sub-link-container">
                            <a 
                                href="{{ route('edit-post', ['catSlug' => isset($p->category) && !empty($p->category) ? $p->category->slug : '', 'postId' => $p->id]) }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <span>  Edit </span>
                            </a>
                        </div>
                        
                        <div class="sub-link-container">
                            <a style="margin-left: 10px;"
                                wire:click.prevent='$emit("openModal", "modals.my-post-delete-confirmation", {{ json_encode(['postId' => 
                                $p->id]) }})'>
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                <span>  Delete <span>
                            </a>
                        </div>
                        </div>
                                </p>
                              <!--  <div class="room-sizesn ddddd">
                                    <ul>
                                        <li>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" width="17px" height="17px">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        {{ $planActiveDays }} {{ $planActiveDays > 1 ? 'days' : 'day' }} left</li>

                                    </ul>
                                </div> -->
                                
                            </div>
                        </div>
                    </a>
                </div>
                <div class="view-prdt-link">
                  <!--  <div class="link-left">
                       <div class="sub-link-container">
                            <a class="dash-sub-link"
                                href="{{ route('post-detail', ['slug' => Str::slug($p->name, '-'), 'id' => $p->id]) }}">
                                <i class="fa-solid fa-list"></i>
                               <span> View </span>
                            </a>
                        </div>
                        
                       
                    </div>-->
                    <div class="link-left">
                        <div class="sub-link-container">
                            <a class="dash-sub-link">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                 {{ !empty($p->page_view) ? $p->page_view : 0 }} 
                            </a>
                        </div>
                        <div class="sub-link-container">
                            <a class="dash-sub-link">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                 {{ !empty($p->phone_view) ? $p->phone_view : 0 }}  
                            </a>
                        </div>
                        <div class="sub-link-container">
                            <a class="dash-sub-link">
                                <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                 {{ !empty($p->whatsApp_view) ? $p->whatsApp_view : 0 }} 
                            </a>
                        </div>
                        <div class="sub-link-container">
                            <a class="dash-sub-link">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>  {{ !empty($p->send_email) ? $p->send_email : 0 }} </span>
                            </a>
                        </div>
                    </div>
                    <div class="link-right">
                    	<button class="btn-pr" style="border: none;color: white;background: black;padding: 3px 9px 3px 9px;"> PROMOTE </button>
                        <!-- <button style="border: none;color: white;background: black;padding: 3px 9px 3px 9px;"> PAY NOW </button>
                        <button style="border: none;color: white;background: black;padding: 3px 9px 3px 9px;"> RENEW PROMOTION </button> -->
                    </div>
                </div>
            @endforeach
            @if ($myPosts->hasPages())
                {{ $myPosts->links() }}
            @endif
        @else
            <div class="prdct-link-select-box no-record">No result found.</div>
        @endif

    </div>
</div>

<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\HasMany;

use Laravel\Nova\Fields\BelongsTo;
use Alexwenzel\DependencyContainer\HasDependencies;
use Alexwenzel\DependencyContainer\DependencyContainer;
use Alexwenzel\DependencyContainer\ActionHasDependencies;
use Laravel\Nova\Http\Requests\NovaRequest;
use Alexwenzel\AjaxSelect\AjaxSelect;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


use App\Rules\NotUrl;
use App\Rules\WordRestrict;
use App\Rules\Price;
use App\Rules\CommunityDate;
use App\Rules\RegYear;
use App\Rules\Check5DigitFromAddName;



class Post extends Resource
{
    use HasDependencies;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Post>
     */
    public static $model = \App\Models\Post::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'description'
    ];

    /**
     * The pagination per-page options configured for this resource.
     *
     * @return array
     */
    public static $perPageOptions = [25, 50, 100, 150, 200, 500, 1000];

    /**
     * Default ordering for index query.
     *
     * @var array
     */
    public static $indexDefaultOrder = [
        'id' => 'desc'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            //------  Start Index --------------
            Text::make('ID', 'id')->onlyOnIndex()->sortable(),
            Text::make('Title', 'name')->onlyOnIndex()->sortable(),
            Select::make('Category', 'category_id')->options(function () {
                $cat = [];
                $categories =  DB::table('categories')->select('id', 'name', 'parent_id')->get();
                $parentCat =  collect($categories)->where('parent_id', 0)->sortBy('name');
                if (count($parentCat)) {
                    foreach ($parentCat as $c) {
                        $id = $c->id;
                        $name = $c->name;
                        $cat[$id] = $name;
                        $cat = $this->getChild($categories, $id, $cat, $name);
                    }
                }
                return $cat;
            })->displayUsingLabels()
                ->searchable()
                ->sortable()
                ->onlyOnIndex(),
            Date::make('Created Date', 'created_at')->onlyOnIndex()->sortable(),
            Select::make('Packages/Plan', 'plan')->options([
                'free' => 'Free',
            ])->displayUsingLabels()
                ->sortable()
                ->searchable()
                ->onlyOnIndex(),
            Select::make('Status', 'status')->options([
                'active' => 'Active',
                'inactive' => 'Inactive',
                'pending' => 'Pending',
            ])
                ->displayUsingLabels()
                ->sortable()
                ->onlyOnIndex(),
            //------  End Index --------------
            //------  Start Form --------------
            Select::make('Category', 'category_id')->options(function () {
                $cat = [];
                $categories =  DB::table('categories')->select('id', 'name', 'parent_id')->get();
                $parentCat =  collect($categories)->where('parent_id', 0)->sortBy('name');
                if (count($parentCat)) {
                    foreach ($parentCat as $c) {
                        $id = $c->id;
                        $name = $c->name;
                        $cat[$id] = $name;
                        $level = 0;
                        $cat = $this->getChild($categories, $id, $cat, $name, $level);
                    }
                }
                return $cat;
            })->displayUsingLabels()
                ->searchable()
                ->sortable()
                ->hideFromIndex()
                ->rules('required'),


            // Property > Property For Rent > Houses for Rent => 20
            DependencyContainer::make(
                $this->rentShareHouseFlatFields()
            )->dependsOn('category_id', 20),
            // For Property > Property For Rent > Flats for Rent => 21 
            DependencyContainer::make(
                $this->rentShareHouseFlatFields()
            )->dependsOn('category_id', 21),
            // Property > Property To Share > Houses for Share => 26
            DependencyContainer::make(
                $this->rentShareHouseFlatFields()
            )->dependsOn('category_id', 26),
            // Property > Property To Share > Flats for Share => 27
            DependencyContainer::make(
                $this->rentShareHouseFlatFields()
            )->dependsOn('category_id', 27),



            // Property > Property For Rent > Roommates & Rooms for Rent => 22
            DependencyContainer::make(
                $this->rentRoomatesFields()
            )->dependsOn('category_id', 22),


            // Property > Property For Sale > Land for Sale => 17
            DependencyContainer::make(
                $this->rentSaleLandParkingFields()
            )->dependsOn('category_id', 17),
            // Property > Property For Sale > Parking for Sale => 18
            DependencyContainer::make(
                $this->rentSaleLandParkingFields()
            )->dependsOn('category_id', 18),
            // Property > Property For Rent > Parking for Rent => 23
            DependencyContainer::make(
                $this->rentSaleLandParkingFields()
            )->dependsOn('category_id', 23),
            // Property > Property For Rent > Land for Rent => 24
            DependencyContainer::make(
                $this->rentSaleLandParkingFields()
            )->dependsOn('category_id', 24),



            // Property > Property For Rent > Commercial Space for Rent => 25
            DependencyContainer::make(
                $this->rentSharedCommercialSpaceFields()
            )->dependsOn('category_id', 25),
            // Property > Property To Share > Commercial Space for Shared => 28
            DependencyContainer::make(
                $this->rentSharedCommercialSpaceFields()
            )->dependsOn('category_id', 28),


            // Property > Property For Sale > Houses for Sale => 15
            DependencyContainer::make(
                $this->saleHouseFlatFields()
            )->dependsOn('category_id', 15),
            // Property > Property For Sale > Flats for Sale => 16 
            DependencyContainer::make(
                $this->saleHouseFlatFields()
            )->dependsOn('category_id', 16),


            // Property > Property For Sale > Commercial Space for Sale => 19
            DependencyContainer::make(
                $this->saleCommercialSpaceFields()
            )->dependsOn('category_id', 19),


            // Property > Guest Houses & PG => 29
            DependencyContainer::make(
                $this->guestHousesPGFields()
            )->dependsOn('category_id', 29),


            // Vehicles > Cars => 36
            DependencyContainer::make(
                $this->carFields()
            )->dependsOn('category_id', 36),


            // Vehicles > Motorcycles => 37
            DependencyContainer::make(
                $this->motorcycleScooterFields()
            )->dependsOn('category_id', 37),
            // Vehicles > Scooters => 38
            DependencyContainer::make(
                $this->motorcycleScooterFields()
            )->dependsOn('category_id', 38),


            // Vehicles > Bicycles => 39
            DependencyContainer::make(
                $this->bicycleFields()
            )->dependsOn('category_id', 39),

            // Vehicles > Tractors => 40
            DependencyContainer::make(
                $this->tractorFields()
            )->dependsOn('category_id', 40),


            // Vehicles > Buses => 41
            DependencyContainer::make(
                $this->busTruckFields()
            )->dependsOn('category_id', 41),
            // Vehicles > Trucks => 42
            DependencyContainer::make(
                $this->busTruckFields()
            )->dependsOn('category_id', 42),


            // Vehicles > Parts & Accessories => 43
            DependencyContainer::make(
                $this->vehiclesPartsAccessoriesFields()
            )->dependsOn('category_id', 43),

            // Jobs => 2
            DependencyContainer::make(
                $this->jobFields()
            )->dependsOn('category_id', 2),

            // Pets > Pets for Sale => 30
            DependencyContainer::make(
                $this->petsforSaleFields()
            )->dependsOn('category_id', 30),

            // Pets > Pets Accessories => 31
            DependencyContainer::make(
                $this->petsAccessoriesFields()
            )->dependsOn('category_id', 31),

            // Community > Friendship and Dating => 9
            DependencyContainer::make(
                $this->friendshipDatingMatrimonialsFields()
            )->dependsOn('category_id', 9),
            // Community > Matrimonials => 11
            DependencyContainer::make(
                $this->friendshipDatingMatrimonialsFields()
            )->dependsOn('category_id', 11),


            // Community > Classes and Tuition => 10
            DependencyContainer::make(
                $this->classesTuitionFields()
            )->dependsOn('category_id', 10),



            // For Sale > Fashion for Sale => 32
            DependencyContainer::make(
                $this->forSaleFields()
            )->dependsOn('category_id', 32),
            // For Sale > Mobiles & Tablets => 33
            DependencyContainer::make(
                $this->forSaleFields()
            )->dependsOn('category_id', 33),
            // For Sale > Furniture => 34
            DependencyContainer::make(
                $this->forSaleFields()
            )->dependsOn('category_id', 34),
            // For Sale > Electronics & Appliances => 35
            DependencyContainer::make(
                $this->forSaleFields()
            )->dependsOn('category_id', 35),



            // Rent => 5
            DependencyContainer::make(
                $this->rentFields()
            )->dependsOn('category_id', 5),

            //------  End Form --------------

            Text::make('Title', 'name')->hideFromIndex()->rules(['required', 'min:10', 'max:70',  new NotUrl,  new WordRestrict, new Check5DigitFromAddName('Title'), 'regex:/^[a-zA-Z-_0-9 ]{10,70}$/'])->withMeta(['extraAttributes' => ['minlength' => 10, 'maxlength' => 70]]),

            Textarea::make('Description', 'description')->hideFromIndex()->rules(['required', 'min:10', 'max:5000', new NotUrl, new WordRestrict, new Check5DigitFromAddName('Description ')])->withMeta(['extraAttributes' => ['minlength' => 10, 'maxlength' => 5000]]),

            Select::make('User', 'user_id')->options(\App\Models\User::where('status', 1)->where('user_type', 2)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),

            AjaxSelect::make('Phone', 'phone')
                ->get('/api/user-phone/{user_id}')
                ->parent('user_id')
                ->sortable()
                ->rules('required')
                ->hideFromIndex(),

            DependencyContainer::make(
                [
                    Boolean::make('WhatsApp', 'isWhatsApp'),
                ]
            )->dependsOn('phone', 1),

            Select::make('State', 'state_id')->options(\App\Models\State::where('status', 'active')->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),


            AjaxSelect::make('City', 'city_id')
                ->get('/api/cities/{state_id}')
                ->parent('state_id')
                ->sortable()
                ->hideFromIndex(),


            AjaxSelect::make('Locality', 'locality_id')
                ->get('/api/localities/{city_id}')
                ->parent('city_id')
                ->sortable()
                ->hideFromIndex(),

            Avatar::make('Image 1', 'image_path_1')
                ->store(function (Request $request, $model) {

                    //$url = ($request->image_path_1);
                    // $info = $url->getClientOriginalExtension();
                    // $name = pathinfo($url->getClientOriginalName(), PATHINFO_FILENAME);

                    // $contents = file_get_contents($url);
                    // $fileName = $name . time() . '-640-360' . '.' . $info;

                    // $year = date("Y");
                    // $month = date("m");
                    // $newsImagePath = 'cms/tips/' . $year . '/' . $month;


                    // $cropped = Cropper::make($contents);
                    // $cropped->resize(640, null, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // });
                    // $cropped->stream();
                    // // Store on S3
                    // Storage::disk('s3')->put($newsImagePath . '/' . $fileName, $cropped);
                    // // Save filename in DB
                    // return [
                    //     'imagePath_640x360' => $newsImagePath . '/' . $fileName,
                    // ];
                    return $this->imageResize($request->image_path_1, 1);
                    //return config('global_variables.app_front_url') . '/public/cms/post/list/' . $img1;
                })
                // ->path(config('global_variables.app_front_url') . '/storage/cms/post/list/')
                // ->displayUsing(function () {
                //     return config('global_variables.app_front_url') . '/storage/cms/post/list/' . $this->image_path_1;
                // })
                ->rules('image', 'mimes:jpeg,png,jpg', 'max:5120')
                ->creationRules('nullable')
                ->updateRules('nullable')
                ->hideFromIndex(),


            Avatar::make('Image 2', 'image_path_2')
                ->store(function (Request $request, $model) {
                    return $this->imageResize($request->image_path_2, 2);
                })
                // ->displayUsing(function ($img2) {
                //     return config('global_variables.app_front_url') . '/storage/cms/post/list/' . $img2;
                // })
                ->rules('image', 'mimes:jpeg,png,jpg', 'max:5120')
                ->creationRules('nullable')
                ->updateRules('nullable')
                ->hideFromIndex(),


            Avatar::make('Image 3', 'image_path_3')
                ->store(function (Request $request, $model) {
                    return $this->imageResize($request->image_path_3, 3);
                })
                ->rules('image', 'mimes:jpeg,png,jpg', 'max:5120')
                ->creationRules('nullable')
                ->updateRules('nullable')
                ->hideFromIndex(),


            Avatar::make('Image 4', 'image_path_4')
                ->store(function (Request $request, $model) {
                    return $this->imageResize($request->image_path_4, 4);
                })
                ->rules('image', 'mimes:jpeg,png,jpg', 'max:5120')
                ->creationRules('nullable')
                ->updateRules('nullable')
                ->hideFromIndex(),

            Avatar::make('Image 5', 'image_path_5')
                ->store(function (Request $request, $model) {
                    return $this->imageResize($request->image_path_5, 5);
                })
                ->rules('image', 'mimes:jpeg,png,jpg', 'max:5120')
                ->creationRules('nullable')
                ->updateRules('nullable')
                ->hideFromIndex(),



            HasMany::make('ReportPost'),


            //Add image 
            //https://novapackages.com/packages/ebess/advanced-nova-media-library


        ];
    }


    private function imageResize($file, $type, $postId = null)
    {
        try {
            $listSrc = config('global_variables.image_upload_path') . '/public/cms/post/list/';
            $detailSrc = config('global_variables.image_upload_path') . '/public/cms/post/detail/';


            $imgName = $file->getClientOriginalName();
            $extension = 'webp'; //$file->getClientOriginalExtension()
            $fileName =  time() . '-' . $type . '.' . $extension;
            $imgData = getimagesize($file->getRealPath());
            $width = $imgData[0];
            $height = $imgData[1];

            //List Image
            $listImg = Image::make($file->getRealPath())->insert(public_path('img/60x15.png'), 'center')->encode($extension);
            //storage/app/public/
            $listImg->getEncoded();
            $listImg->save($listSrc . $fileName);
            //Storage::put($listSrc . $fileName, $listImg->getEncoded());

            //Detail Image 600 340
            if ($width > 600 && $height > 340) {
                $detailImg = Image::make($file->getRealPath())->resize(600, 340,  function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->insert(public_path('img/160x30.png'), 'center')->encode($extension);
            } elseif ($width > 600) {
                $detailImg = Image::make($file->getRealPath())->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->insert(public_path('img/160x30.png'), 'center')->encode($extension);
            } elseif ($height > 340) {
                $detailImg = Image::make($file->getRealPath())->resize(null, 340,  function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->insert(public_path('img/160x30.png'), 'center')->encode($extension);
            } else {
                $detailImg = Image::make($file->getRealPath())->insert(public_path('img/160x30.png'), 'center')->encode($extension);
            }
            // Storage::put($detailSrc . $fileName, $detailImg->getEncoded());
            $detailImg->getEncoded();
            $detailImg->save($detailSrc . $fileName);

            return $fileName;
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            return null;
            //throw $th;
        }
    } //end ImageResize

    /**
     * Get the Rent & Share for Flats & House fields for the resource.
     *
     * @return array
     */
    // Property > Property For Rent > Houses for Rent => 20
    // For Property > Property For Rent > Flats for Rent => 21 
    // Property > Property To Share > Houses for Share => 26
    // Property > Property To Share > Flats for Share => 27
    protected function rentShareHouseFlatFields()
    {
        return [
            Select::make('Bedroom', 'bedroom')->options(\App\Models\MasterBathroom::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            Select::make('Bathroom', 'bathroom')->options(\App\Models\MasterBathroom::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            Select::make('Furnishing', 'furnishing')->options(\App\Models\MasterFurnishing::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            Select::make('Listed by', 'listed_by')->options(\App\Models\MasterListedBy::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            Number::make('Super Builtup area', 'super_builtup_area')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
            Number::make('Carpet Area', 'carpet_area')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
            Select::make('Bachelors Allowed', 'is_bachelors_allowed')->options([
                1 => 'Yes',
                0 => 'No',
            ])->displayUsingLabels()
                ->hideFromIndex(),

            Number::make('Total Floors', 'total_floor')->hideFromIndex(),
            Number::make('Floor No', 'floor_number')->hideFromIndex(),
            Select::make('Car Parking', 'car_parking')->options(\App\Models\MasterCarParking::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Select::make('Facing', 'facing')->options(\App\Models\MasterFacing::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }


    /**
     * Get the Roommates & Rooms for Rent fields for the resource.
     *
     * @return array
     */
    // Property > Property For Rent > Roommates & Rooms for Rent => 22
    protected function rentRoomatesFields()
    {
        return [
            Select::make('Bedroom', 'bedroom')->options(\App\Models\MasterBathroom::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            Select::make('Bathroom', 'bathroom')->options(\App\Models\MasterBathroom::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            Select::make('Furnishing', 'furnishing')->options(\App\Models\MasterFurnishing::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            Select::make('Listed by', 'listed_by')->options(\App\Models\MasterListedBy::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            Number::make('Super Builtup area', 'super_builtup_area')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
            Number::make('Carpet Area', 'carpet_area')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }

    /**
     * Get the Rent & sale for Land & Parking fields for the resource.
     *
     * @return array
     */
    // Property > Property For Sale > Land for Sale => 17
    // Property > Property For Sale > Parking for Sale => 18
    // Property > Property For Rent > Parking for Rent => 23
    // Property > Property For Rent > Land for Rent => 24
    protected function rentSaleLandParkingFields()
    {
        return [
            Select::make('Listed by', 'listed_by')->options(\App\Models\MasterListedBy::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            Number::make('Plot Area', 'plot_area')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
            Number::make('Length', 'length')->hideFromIndex()->rules(['nullable', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
            Number::make('Breadth', 'breadth')->hideFromIndex()->rules(['nullable', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
            Select::make('Facing', 'facing')->options(\App\Models\MasterFacing::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }

    /**
     * Get the Rent & Shared for Commercial Space fields for the resource.
     *
     * @return array
     */
    // Property > Property For Rent > Commercial Space for Rent => 25
    // Property > Property To Share > Commercial Space for Shared => 28
    protected function rentSharedCommercialSpaceFields()
    {
        return [
            Select::make('Furnishing', 'furnishing')->options(\App\Models\MasterFurnishing::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Select::make('Listed by', 'listed_by')->options(\App\Models\MasterListedBy::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable(),
            Number::make('Super Builtup area', 'super_builtup_area')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
            Number::make('Carpet Area', 'carpet_area')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
            Select::make('Car Parking', 'car_parking')->options(\App\Models\MasterCarParking::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Number::make('Washrooms', 'washroom')->hideFromIndex(),
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }

    /**
     * Get the Sale for Flats & House fields for the resource.
     *
     * @return array
     */
    // Property > Property For Sale > Houses for Sale => 15
    // Property > Property For Sale > Flats for Sale => 16 
    protected function saleHouseFlatFields()
    {
        return [
            Select::make('Bedroom', 'bedroom')->options(\App\Models\MasterBathroom::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            Select::make('Bathroom', 'bathroom')->options(\App\Models\MasterBathroom::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            Select::make('Furnishing', 'furnishing')->options(\App\Models\MasterFurnishing::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Select::make('Construction status', 'construction_status')->options(\App\Models\MasterConstructionStatus::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Select::make('Listed by', 'listed_by')->options(\App\Models\MasterListedBy::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            Number::make('Super Builtup area', 'super_builtup_area')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
            Number::make('Carpet Area', 'carpet_area')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
            Number::make('Total Floors', 'total_floor')->hideFromIndex()->rules(['nullable', 'numeric', 'regex:/^\d{1,3}$/', new Price]),
            Number::make('Floor No', 'floor_number')->hideFromIndex()->rules(['nullable', 'numeric', 'regex:/^\d{1,3}$/', new Price]),
            Select::make('Car Parking', 'car_parking')->options(\App\Models\MasterCarParking::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Select::make('Facing', 'facing')->options(\App\Models\MasterFacing::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }

    /**
     * Get the Sale for Commercial Space fields for the resource.
     *
     * @return array
     */
    // Property > Property For Sale > Commercial Space for Sale => 19
    protected function saleCommercialSpaceFields()
    {
        return [
            Select::make('Furnishing', 'furnishing')->options(\App\Models\MasterFurnishing::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Select::make('Construction status', 'construction_status')->options(\App\Models\MasterConstructionStatus::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Select::make('Listed by', 'listed_by')->options(\App\Models\MasterListedBy::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            Number::make('Super Builtup area', 'super_builtup_area')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
            Number::make('Carpet Area', 'carpet_area')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
            Select::make('Car Parking', 'car_parking')->options(\App\Models\MasterCarParking::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Select::make('Facing', 'facing')->options(\App\Models\MasterFacing::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Number::make('Washrooms', 'washroom')->hideFromIndex(),
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }

    /**
     * Get the Sale for Commercial Space fields for the resource.
     *
     * @return array
     */
    // Property > Guest Houses & PG => 29
    protected function guestHousesPGFields()
    {
        return [
            Select::make('Furnishing', 'furnishing')->options(\App\Models\MasterFurnishing::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Select::make('Listed by', 'listed_by')->options(\App\Models\MasterListedBy::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            Select::make('Car Parking', 'car_parking')->options(\App\Models\MasterCarParking::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Select::make('Meals Included', 'is_meal_included')->options([
                1 => 'Yes',
                0 => 'No',
            ])->displayUsingLabels()
                ->hideFromIndex(),
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }

    /**
     * Get the car fields for the resource.
     *
     * @return array
     */
    // Vehicles > Cars => 36
    protected function carFields()
    {
        return [
            Text::make('Reg. Year', 'registration_year')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{4,4}$/', new RegYear]),
            Select::make('Fuel type', 'fuel_type')->options(\App\Models\MasterFuelType::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->rules('required')
                ->hideFromIndex(),
            Select::make('Transmission', 'transmission')->options(\App\Models\MasterTransmission::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            Number::make('KM driven', 'km_driven')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,6}$/', new Price]),
            Select::make('No. of Owners', 'owner')->options(\App\Models\MasterOwner::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }

    /**
     * Get the motorcycle & scooter fields for the resource.
     *
     * @return array
     */
    // Vehicles > Motorcycles => 37
    // Vehicles > Scooters => 38
    protected function motorcycleScooterFields()
    {
        return [
            Text::make('Reg. Year', 'registration_year')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{4,4}$/', new RegYear]),
            Select::make('Fuel type', 'fuel_type')->options(\App\Models\MasterFuelType::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->rules('required')
                ->hideFromIndex(),
            Number::make('KM driven', 'km_driven')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,6}$/', new Price]),
            Select::make('No. of Owners', 'owner')->options(\App\Models\MasterOwner::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }


    /**
     * Get the motorcycle & scooter fields for the resource.
     *
     * @return array
     */
    // Vehicles > Bicycles => 39
    protected function bicycleFields()
    {
        return [
            Select::make('Fuel type', 'fuel_type')->options(\App\Models\MasterFuelType::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->rules('required')
                ->hideFromIndex(),
            Number::make('KM driven', 'km_driven')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,6}$/', new Price]),
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }

    /**
     * Get the Tractors fields for the resource.
     *
     * @return array
     */
    // Vehicles > Tractors => 40
    protected function tractorFields()
    {
        return [
            Text::make('Reg. Year', 'registration_year')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{4,4}$/', new RegYear]),
            Text::make('HP Power', 'hp_power')
                ->hideFromIndex()
                ->rules(['nullable', 'numeric', 'regex:/^\d{1,3}$/']),
            Select::make('Fuel type', 'fuel_type')->options(\App\Models\MasterFuelType::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->rules('required')
                ->hideFromIndex(),
            Number::make('KM driven', 'km_driven')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,6}$/', new Price]),
            Select::make('No. of Owners', 'owner')->options(\App\Models\MasterOwner::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->rules('required')
                ->hideFromIndex(),
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }

    /**
     * Get the Tractors fields for the resource.
     *
     * @return array
     */
    // Vehicles > Buses => 41
    // Vehicles > Trucks => 42
    protected function busTruckFields()
    {
        return [
            Text::make('Reg. Year', 'registration_year')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{4,4}$/', new RegYear]),
            Select::make('Fuel type', 'fuel_type')->options(\App\Models\MasterFuelType::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->rules('required')
                ->hideFromIndex(),
            Select::make('Transmission', 'transmission')->options(\App\Models\MasterTransmission::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules('required'),
            Number::make('KM driven', 'km_driven')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,6}$/', new Price]),
            Select::make('No. of Owners', 'owner')->options(\App\Models\MasterOwner::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->rules('required')
                ->hideFromIndex(),
            Select::make('Body Type', 'body_type')->options(\App\Models\MasterBusBodyType::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->rules('required')
                ->hideFromIndex(),
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }

    /**
     * Get the Tractors fields for the resource.
     *
     * @return array
     */
    // Vehicles > Parts & Accessories => 43
    protected function vehiclesPartsAccessoriesFields()
    {
        return [
            Select::make('Types', 'vehicle_parts_accessory_type')->options(\App\Models\MasterVehiclePartsAccessoryType::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->rules('required')
                ->hideFromIndex(),
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }

    /**
     * Get the Tractors fields for the resource.
     *
     * @return array
     */
    // Jobs => 2
    protected function jobFields()
    {
        return [
            Select::make('Salary period', 'salary_period')->options(\App\Models\MasterSalaryPeriod::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->rules('required')
                ->hideFromIndex()
                ->rules(['required']),
            Select::make('Education level', 'education_level')->options(\App\Models\MasterEducationLevel::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Number::make('Salary from', 'salary_from')->hideFromIndex()->rules(['nullable', 'numeric', 'regex:/^\d{1,7}$/', new Price]),
            Number::make('Salary to', 'salary_to')->hideFromIndex()->rules(['nullable', 'numeric', 'regex:/^\d{1,7}$/', new Price, 'gte:salaryFrom']),
            Select::make('Position type', 'position_type')->options(\App\Models\MasterPositionType::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex()
                ->rules(['required']),
            Select::make('Years of experience', 'experience_year')->options(\App\Models\MasterExperienceYear::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
        ];
    }

    /**
     * Get the Tractors fields for the resource.
     *
     * @return array
     */
    // Pets > Pets for Sale => 30
    protected function petsforSaleFields()
    {
        return [
            Select::make('Age', 'pet_age')->options(\App\Models\MasterPetsAge::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Text::make('Breed', 'pet_breed')->hideFromIndex()->rules(['required', 'max:30']),
            Select::make('Gender', 'pet_gender')->options(\App\Models\MasterPetsGender::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->hideFromIndex(),
            Number::make('Colour', 'pet_colour')->hideFromIndex(),
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }

    /**
     * Get the Tractors fields for the resource.
     *
     * @return array
     */
    // Pets > Pets Accessories => 31
    protected function petsAccessoriesFields()
    {
        return [
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }

    /**
     * Get the Tractors fields for the resource.
     *
     * @return array
     */
    // Community > Friendship and Dating => 9
    // Community > Matrimonials => 11
    protected function friendshipDatingMatrimonialsFields()
    {
        return [
            Text::make('Age', 'community_age')->hideFromIndex()->rules(['required', 'regex:/^\d{1,2}$/', new Price]),
        ];
    }

    /**
     * Get the Tractors fields for the resource.
     *
     * @return array
     */
    // Community > Classes and Tuition => 10
    protected function classesTuitionFields()
    {
        //'date_format:d-m-Y',
        return [
            Date::make('Date', 'community_date_from')->hideFromIndex()->rules(['required',  new CommunityDate(1)]),
            DependencyContainer::make(
                $this->communityDateToField()
            )->dependsOnNotEmpty('community_date_from'),
        ];
    }

    protected function communityDateToField()
    {
        return [
            Date::make('Date', 'community_date_to')->hideFromIndex()->rules(['nullable',  new CommunityDate(2, $this->community_date_from)]),//need to check
        ];
    }

    /**
     * Get the sale fields for the resource.
     *
     * @return array
     */
    // For Sale > Fashion for Sale => 32
    // For Sale > Mobiles & Tablets => 33
    // For Sale > Furniture => 34
    // For Sale > Electronics & Appliances => 35
    protected function forSaleFields()
    {
        return [
            Select::make('Condition', 'condition')->options(\App\Models\MasterCondition::where('status', 1)->pluck('name', 'id'))->displayUsingLabels()
                ->searchable()
                ->rules('required')
                ->hideFromIndex(),
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }

    /**
     * Get the rent fields for the resource.
     *
     * @return array
     */
    // Rent => 5
    protected function rentFields()
    {
        return [
            Number::make('Price', 'price')->hideFromIndex()->rules(['required', 'numeric', 'regex:/^\d{1,15}$/', new Price]),
        ];
    }

    public function getChild($categories, $parentId, $cat, $parentName, $level = 0)
    {
        $parentCat =  collect($categories)->where('parent_id', $parentId)->sortBy('name');
        if (count($parentCat)) {
            $level = $level + 1;
            foreach ($parentCat as  $c) {
                $id = $c->id;
                //$name = (!empty($parentName) ? $parentName . ' > ' : '') . $c->name;
                $prefix = '';
                for ($j = 0; $j < $level; $j++) {
                    $prefix .= ''; //>;
                }
                $name =  $prefix . $c->name;
                $cat[$id] = $name;
                $cat = $this->getChild($categories, $id, $cat, $name, $level);
            }
        }
        return $cat;
    }


    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new Filters\PostStatus,
            new Filters\PostCategory,
            new Filters\PostUser,
            new Filters\PostPackage,
            new Filters\PostDateFrom,
            new Filters\PostDateTo,
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            (new Actions\StateStatusChange)
                ->confirmText('Are you sure you want to update the status of selected id(s)?')
                ->confirmButtonText('Yes')
                ->cancelButtonText("No"),
        ];
    }

    public function authorizedToReplicate(Request $request)
    {
        return false;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];
            return $query->orderBy(key(static::$indexDefaultOrder), reset(static::$indexDefaultOrder));
        }
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Film;
use App\Slug;
use App\Genre;
use DB;
use Session;
use Auth;
use Countries;
use Image;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $films = Film::all();
        $data = [
            'films' => $films
        ];

        return view('films.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $genres =  Genre::all();
        $countries = Countries::all()->pluck('name.common');

        
        $data = [
            'page_title'    => 'Create Film',
            'genres' => $genres,
            'countries' => $countries
        ];

        return view('films.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();

        $photo_url = '';
        if( $request->hasFile('photo_url') ) {
            $file = $request->file('photo_url');
            $photo_url = $this->saveImage($file);
        }        
       
        //generate slug
        $slug = Slug::createSlug($form_data['name']);

        Film::create([
            'name'          => $form_data['name'],
            'description'   => $form_data['description'],
            'realease_date' => $form_data['realease_date'],
            'ticket_price'  => $form_data['ticket_price'],
            'country'       => $form_data['country'],
            'genre_id'      => $form_data['genre_id'],
            'photo_url'     => $photo_url,
            'slug'          => $slug
        ]);
     
        Session::flash('success', "Film successfully created.");

        return redirect()->back();
    }

    public function saveImage($file) {
 
        $public_storage = storage_path('app/public/');
        $imagesFolder = "film-images/";
        $imagesPath = $public_storage.$imagesFolder;
       
        $filename = $file->getClientOriginalName();
        $caption_ext = $filename;
        $captionInfo = pathinfo($caption_ext);
        $caption = $captionInfo['filename'];

        //Generate random string to gen a unique file name for each image
        $randstring = str_random(20);
        $filename = $randstring.$filename;

        $upload_success = Input::file('photo_url')->move($imagesPath, $filename);

        if ($upload_success) {
        
            return $filename;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $film = DB::table('films')
            ->join('genres', 'films.genre_id', '=', 'genres.id')
            ->select('films.*', 'genres.name AS genre')
            ->where('films.slug', $slug)
            ->first();

        $comments = Film::where('slug', $slug)->firstOrFail()->comments()->get();

        $user = Auth::user();

        $data = [
            'film' => $film,
            'comments' => $comments,
            'user' => Auth::user()
        ];
        
        return view('films.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

      public function display_image(Request $request, $image_name){
        // dd($image_name);
        $public_storage = storage_path('app/public/');

        $imgsFolder = "film-images/";
        $imgsPath = $public_storage.$imgsFolder;

        $path = $imgsPath.$image_name;

        if (file_exists($path)) { 
           
            $img = Image::make($path)->fit(330, 200);
            return $img->response();
        }
    }
}

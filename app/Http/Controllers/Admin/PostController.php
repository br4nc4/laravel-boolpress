<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Mail\NewPostMail;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
//libreria di laravel - raccolta di utilities sulle stringhe
use Illuminate\Support\Str;

class PostController extends Controller
{
    private function findBySlug($slug)
    {
        $post = Post::where("slug", $slug)->first();

        if(!$post){
            abort(404);
        }

        return $post;
    }

    private function generateSlug($text)
    {
        //funzione per generare slug con titoli uguali con l'aggiunta di un contatore
        $counter = 0;
        $toReturn = null;

        do {
            //genera uno slug partendo dal titolo
            $slug = Str::slug($text);

            //se il counter è maggiore di 0, concateno il suo valore allo slug
            if($counter > 0){
                $slug .= "-" . $counter;
            }

            //controlo a db se esiste già uno slug uguale
            $slug_isthere = Post::where("slug", $slug)->first();

            //se esiste, incremento il contatore per il ciclo succcessivo
            if($slug_isthere){
                $counter++;
                //altrimenti salvo lo slug nei dati del nuovo post
            } else {
                $toReturn = $slug;
            }
        } while($slug_isthere);

        return $toReturn;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $posts = Post::orderBy("created_at", "desc")->get(); */
        $user = Auth::user();
        $posts = $user->posts;

        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        
        return view("admin.posts.create", compact("categories", "tags"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validare dati ricevuti
        $validatedData = $request->validate([
            "title"=>"required|min:10",
            "content"=>"required|min:10",
            "category_id"=>"nullable|exists:categories,id",
            "tags"=>"nullable|exists:tags,id",
            "cover_img"=>"required|image"

        ]);

        //salvar a db i dati
        $post = new Post();
        $post->fill($validatedData);
        $post->user_id = Auth::user()->id;

        $post->slug = $this->generateSlug($post->title);

        $coverImg = Storage::put("/", $validatedData["cover_img"]);
        $post->cover_img = $coverImg;

        $post->save();

        //l'associazione post - tags deve essere fatta dopo il salvataggio del post creato
        //in modo da permettere un id per il post
        //il post id è essenziale per l'associazione con la tabella ponte
        if(key_exists("tags", $validatedData)){
            $post->tags()->attach($validatedData["tags"]);
        }

        Mail::to($post->user)->send(new NewPostMail($post));

        //redirect su una pagina desideta
        return redirect()->route("admin.posts.show", $post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = $this->findBySlug($slug);
        return view("admin.posts.show", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = $this->findBySlug($slug);
        $categories = Category::all();
        $tags = Tag::all();

        return view("admin.posts.edit", compact("post", "categories", "tags"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //dd($request->all());

        $validatedData = $request->validate([
            "title"=>"required|min:10",
            "content"=>"required|min:10",
            "category_id"=>"nullable|exists:categories,id",
            "tags"=>"nullable|exists:tags,id",
            "cover_img"=>"nullable|image"
        ]);

        $post = $this->findBySlug($slug);

        if(key_exists("cover_img", $validatedData)){
            //il primo argomento di questa funzione è: dove salvare il file
            //se specificato viene creata una sottocartella nel percorso app/public
            //Storage put ritorna il link interno a dove si trova il file
            $coverImg = Storage::put("/", $validatedData["cover_img"]);

            //se il post ha già una immagine
            //prima di caricare quella nuova, cancella quella vecchia
            if($post->cover_img){
                Storage::delete($post->cover_img);
            }

            //dd($coverImg);
            // salviamo dentro i dati del post corrente il link del file appena caricato
            $post->cover_img = $coverImg;
        }

        if ($validatedData["title"] !== $post->title){
            $post->slug = $this->generateSlug($validatedData["title"]);
        }

        /* PER SALVARE I DATI NELLA TABELLA PONTE */

        //detach con parentesi vuote toglie dalla tabella ponte tutte le relazioni con $post
        //$post->tags()->detach();


        //se l'utente invia dei tag, bisogna associarli al post corrente
        //se non invia i tag, bisogna rimuovere tutte le associazioni esistenti per il post corrente
        if(key_exists("tags", $validatedData)){
            //attach crea una relazione tra il post e i tags che vengono passati
            //aggiunge nella tabella ponte una riga per ogni tag da associare
            //$post->tags()->attach($validatedData["tags"]);
            $post->tags()->sync($validatedData["tags"]);
        } else {
            $post->tags()->sync([]);
        }

        $post->update($validatedData);

        return redirect()->route("admin.posts.show", $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = $this->findBySlug($slug);

        $post->delete();
        
        return redirect()->route("admin.posts.index");
    }
}

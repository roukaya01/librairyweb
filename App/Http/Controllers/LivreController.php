<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\livre;
use App\media;
use App\client;
class LivreController extends Controller
{
    //


    function showAdminDashboard()
    {
        return view('admin.admin');
    }
    function showAdminLivres($id = null){
        $oldlivre = null;

        if ($id) {

            $oldlivre = Livre::find($id);

        }
        //dd(Livre::all()) ;
            return view('admin.livres', [ 'livres' => Livre::with('media')->get(),  'oldlivre'=> $oldlivre]);
        }
        function handleAddLivre(Request $request)
        {

        $livre = livre::create([
            'numero'=> $request['numero'],
            'titre'=> $request['titre'],
            'categorie'=> $request['categorie'],
            'resume'=> $request['resume'],
            'auteur'=> $request['auteur'],
            'date emission'=> $request['date emission'],
            ]);

            $images  =$request->file('photos');
            foreach ($images as$image) {
               $filename = time().'-'.$image->getClientOriginalName();
               $image->move(public_path('storage/uploads/'),$filename);
                    media::create([
                        'link' =>'storage/uploads/'.$filename,
                        'livre_id' =>$livre->id,
                       ]);

            return redirect(route('showAdminLivres'));
         }
        }
        function handleAddMedia(Request $request)
     {
         $images  =$request->file('images');
             foreach ($images as$image) {
                $filename = time().'-'.$image->getClientOriginalName();
                $image->move(public_path('storage/uploads/'),$filename);
                     media::create([
                            'link' =>'storage/uploads/'.$filename,
                            'livre_id' =>$request['livre_id'],
                        ]);

              }

              return redirect(route('showAdminMedia'));
         }
         function destroy($id){

            $livre = Livre::find($id);
           //dd($livre);
            $livre->delete();
            return redirect(route('showAdminLivres'));

      }
      public function logout(){
        auth()->logout();
        return redirect('/')->with ('message', 'vous etes déconnectés');
        }
        function edit(Request $request,$id)
{

    Livre::find($id)->update([
        'numero'=> $request['numero'],
        'titre'=> $request['titre'],
        'categorie'=> $request['categorie'],
        'auteur'=> $request['auteur'],
        'resume'=> $request['resume'],
        'image'=> $request['image'],

    ]);

    if ($request->file('photos')) {
    $images  =$request->file('photos');
    foreach ($images as$image) {
       $filename = time().'-'.$image->getClientOriginalName();
       $image->move(public_path('storage/uploads/'),$filename);
            Media::create([
                   'link' =>'storage/uploads/'.$filename,
                   'livre_id' =>$id,
               ]);
  }
}
           return redirect(route('showAdminLivres'));

}
function showAdminClients($id = null){
    $oldclient = null;
    if ($id) {

        $oldclient = Client::find($id);
    }
    return view('admin.clients', [ 'clients' => Client::all(),  'oldclient'=> $oldclient]);
    }
    function handleAddClient(Request $request)
    {

    $client = client::create([
        'numchambre'=> $request['numchambre'],
        'numlivre'=> $request['numlivre'],
        'nom'=> $request['nom'],
        'numtel'=> $request['numtel'],
        ]);

        return redirect(route('showAdminClients'));
     }
     function destroyclt($id){

        $client = Client::find($id);
        $client->delete();
        return response()->json([
            'message'=>'suppression effectuée!'
        ]);

  }
  function editclt(Request $request,$id)
  {

      Client::find($id)->update([
          'numchambre'=> $request['numchambre'],
          'numlivre'=> $request['numlivre'],
          'nom'=> $request['nom'],
          'numtel'=> $request['numtel'],
      ]);
             return redirect(route('showAdminClients'));

  }
  function DeleteLivreMedia($id){
    $media=media::where('id','=',$id)->delete();
    return response()->json([
        'message' => 'success'
      ]);

}

  ///// api

  public function showLivres()
  {
      return response()->json([
        'books' => livre::with('media')->get(),
        'status' => '200',
    ]);
  }
}

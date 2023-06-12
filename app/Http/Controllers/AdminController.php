<?php

namespace App\Http\Controllers;
use App\Models\Coment;
use App\Models\Post;
use Dompdf\Dompdf;
use App\Models\emprunt;
use App\Models\Livre;
use App\Models\Msage;
use App\Models\Utilisateure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashbord(){
        $emp_enattend = emprunt::where('status','attend')->get();
        $emp_accepter = emprunt::where('status','accepter')->get();
        $emp_refuse = emprunt::where('status','refuse')->get();
        $total_etd = Utilisateure::where('role','etudiant')->count();
        $posts = Post::where('status','attend')->get();
        return view('admin.dashbord',compact('emp_enattend','posts','emp_accepter','emp_refuse',
        'total_etd'));
    }

    public function profileModer(Request $request)
    {
        $user = Auth::user();
        if ($request->has('update')){
            $user->update([
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone,
                'CIN' => $request->CIN,
                'adress' => $request->adress,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name
            ]);

        }
        return view('admin.moder_profile',compact('user'));

    }
    /* Moder  Etudiant */
    public function listEtudiants()
    {
        $etd = Utilisateure::paginate(7);
        return view('admin.etudiant',compact('etd'));
    }
    public function CreateEtudiant(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'email' => 'required|unique:utilisateures,email',
            'phone' => 'required|numeric|min:10',
            'adress' => 'required',
            'CIN' => 'required',
            'gender' => 'required',
            'password' => 'required|confirmed',
        ]);
        if($data){
            Utilisateure::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'adress' => $data['adress'],
                'CIN' => $data['CIN'],
                'role' => 'etudiant',
                'gender' => $data['gender'],
                'password' => Hash::make($data['password']),
            ]);
            return redirect()->route('moder.etudiant',['success'=>'Etudiant was created successfuly']);
        }
    }
    public function delletEtudiant($id)
    {
        $user = Utilisateure::find($id);
        $user->delete();
        return back()->with(['done'=>'etudiant was delleted succcessfuly']);

    }

    /* Moder  Livres */
    public function listLivres()
    {
        $livre = Livre::paginate(6);
        return view('admin.livres',compact('livre'));
    }
    public function createLivre(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required',
            'autheur' => 'required',
            'launge' => 'required',
            'categorie' => 'required',
            'description' => 'required',
            'annee' => 'required',
            'dispo' => 'in:true,false',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $dispo = $request->has('dispo') ? true : false;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images_Livres'),$imagePath);
        }
        if($data){
            $livre = Livre::create([
                'titre' => $data['titre'],
                'autheur' => $data['autheur'],
                'launge' => $data['launge'],
                'categorie' => $data['categorie'],
                'description' => $data['description'],
                'dispo' => $dispo,
                'annee' => $data['annee'],
                'image' => $imagePath ,
            ]);
            $livreId = $livre->id;
            $pdf = $this->generatePDF($data,$livreId);


            return redirect()->route('moder.livre')->with('success', 'Livre created successfully');
        }
    }

    public function editLivre($id)
    {
        $livre = Livre::find($id);
        return view('admin.update_livre',compact('livre'));
    }
    public function updateLivre(Request $request ,$id)
    {
        $livre = Livre::findOrFail($id);
        $data = $request->post();
        $dispo = $request->has('dispo') ? true : false;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images_Livres'), $imagePath);
            $data['image'] = $imagePath;
            $livre->update(['image'=>$data['image']]);
        }

        $livre->update([
            'titre' => $data['titre'],
            'autheur' => $data['autheur'],
            'launge' => $data['launge'],
            'categorie' => $data['categorie'],
            'description' => $data['description'],
            'dispo' => $dispo,
            'annee' => $data['annee'],
        ]);
        $Id = $livre->id;
        $livreId = $Id.'_updated';
        $pdf = $this->generatePDF($data,$livreId);
        return redirect()->route('moder.livre')->with(['done'=>'livre est modified']);
    }
    public function deleteLivre($id)
    {
        $livre = Livre::findOrFail($id);
        $livre->delete($id);
        return redirect()->route('moder.livre');
    }
    public function detailLivre($id)
    {
        $livre = Livre::findOrFail($id);

        return view('admin.livre_detail',compact('livre'));
    }

    public function emprunts ()
    {
        $emprunts = emprunt::whereIn('status', ['accepter', 'attend'])->get();
//        $emprunts = emprunt::all();
//        if ($emprunts->status == 'attend' || $emprunts->status == 'accepter'){
//            $empp = $emprunts;
//        }
        return view('admin.emprunts ',compact('emprunts',));
    }
    public function acceptEmprunt($id)
    {
        $emprunt = emprunt::find($id);
        $livre = Livre::find($emprunt->livre_id);
        $emprunt->update(['status'=>'accepter']);
        $livre->update(['dispo'=>0]);
        $msage = Msage::create([
        'emprunt_id' => $emprunt->id,
        'utilisateure_id' => $emprunt->utilisateure_id,
        'status' => 'accepter',
        'msage' => 'Votre de demande de livre '.$livre->titre.' est accepter',
    ]);

        return back();

    }
    public function refuseEmprunt($id)
    {
        $emprunt = emprunt::find($id);
        $livre = Livre::find($emprunt->livre_id);
        $livre->update(['dispo'=>1]);
        $emprunt->update(['status'=>'refuse']);
        $msage = Msage::create([
            'emprunt_id' => $emprunt->id,
            'utilisateure_id' => $emprunt->utilisateure_id,
            'status' => 'refuse ',
            'msage' => 'Votre de demande de livre '.$livre->titre.' est refuse',
        ]);
        return back();
    }
    public function deleteEmprunt($id)
    {
        $emprunt = emprunt::find($id);
        $emprunt->delete();
        return back();
    }
    public function renduEmprunt($id)
    {
        $emprunt = emprunt::find($id);
        $livre = Livre::where('id',$emprunt->livre_id)->first();
        $livre->update(['dispo' => 1]);
        $emprunt->update(['status' => 'rendu']);
        Msage::create([
            'emprunt_id' => $emprunt->id,
            'utilisateure_id' => $emprunt->utilisateure_id,
            'status' => 'accepter',
            'msage' => 'Merci pour retourner livre '.$livre->titre,
        ]);
        return back();
    }

    public function generatePDF($data,$livreId)
    {
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('admin.livre_pdf', compact('data')));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $output = $dompdf->output();
        $filename = 'livre_' . $livreId . '.pdf';
        $path = public_path('pdfs') . '/' . $filename;
        file_put_contents($path, $output);
        return $filename;
    }

    public function acceptPost($id)
    {
        $post = Post::findOrFail($id);
        $post->update(['status'=>'accepter']);
        return back()->with(['done'=>'post est accepter']);
    }
    public function refusePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return back()->with(['done'=>'post est suprimer']);
    }
    public function postsacc()
    {
        $posts = Post::where('status','accepter')->paginate(6);
        return view('admin.posts_acc',compact('posts'));
    }
    public function postsatt()
    {
        $posts = Post::where('status','attend')->paginate(6);
        return view('admin.posts_att',compact('posts'));
    }
    public function postshow($id)
    {
        $post = Post::findOrFail($id);
        $cmt = Coment::where('post_id',$id)->where('parent_id',null)->get();
        return view('admin.post_show',compact('post','cmt'));
    }

}

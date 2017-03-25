<?php

namespace App\Http\Controllers;

use App\FamilleProduit;
use App\Http\HelperFunctions;
use App\PolicyChecker;
use App\Produit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class StockController extends Controller
{
    use UserProfile, AuthorizationChecker;

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function showNewFormProduit()
    {
        return view('rgs.nouveauproduit',[
            'familles' => FamilleProduit::all()
        ]);
    }

    public function showNewFormFamille()
    {
        return view('rgs.nouvellefamille');
    }

    public function sensResponseNewFamille(Request $request)
    {
        $this->validate($request,[
            'libelle' => 'required',
           ]);
        try
        {
            $famille = new FamilleProduit($request->except('_token'));
            $famille->saveOrFail();
            $this->withSuccess(['Nouvelle Famille de Produit enregistrée avec succes']);
            return back();
        }catch (ModelNotFoundException $e){
            return back()->withErrors([$e->getMessage()]);
        }catch (\Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }

    }

    public function sensResponseNewProduit(Request $request)
    {
        $this->validate($request,[
            'reference' => 'required|unique:produit,reference',
            'libelle' => 'required',
            'quantite' => 'required|numeric',
        ]);
        try
        {
            $produit = new Produit($request->except('_token'));
            $produit->saveOrFail();
            $this->withSuccess(['Nouveau produit enregistré avec succes']);
            return back();
        }catch (ModelNotFoundException $e){
            return back()->withErrors([$e->getMessage()]);
        }catch (\Exception $e){
            return back()->withErrors([$e->getMessage()]);
        }

    }

    public function showFormUpdateProduit($reference)
    {
        try{
            $produit = Produit::where('reference',$reference)->firstOrFail();
            return view('rgs.modifierproduit',['produit' => $produit, 'familles' => FamilleProduit::all()]);
        }catch (ModelNotFoundException $e){
            return back()->withErrors($e->getMessage());
        }catch (\Exception $e){

        }
    }

    public function showFormUpdateFamille($id)
    {
        try{
            $famille = FamilleProduit::where('id',$id)->firstOrFail();
            return view('rgs.modifierfamille',['famille' => $famille]);
        }catch (ModelNotFoundException $e){
            return back()->withErrors($e->getMessage());
        }catch (\Exception $e){

        }
    }

    public function showListProduit()
    {
        $produits = Produit::with('famille')->get();
        return view('rgs.listeproduit',[
            'produits' => $produits,

        ]);
    }

    public function showListFamille()
    {
        $familles = FamilleProduit::all();
        return view('rgs.listefamille',[
            'familles' => $familles,

        ]);
    }

    public function sensResponseUpdateProduit(Request $request, $reference){
        $this->validate($request,[
            'reference' => 'required',
            'libelle' => 'required',
            'quantite' => 'required|numeric',
        ]);
        try {
            $produit = Produit::where('reference',$reference)->firstOrFail();
            $produit->update($request->except('_token'));
            $this->withSuccess(['Modification réussie']);
            return redirect()->route('liste_produit');
        }catch (ModelNotFoundException $e){
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function sensResponseUpdateFamille(Request $request, $id){
        $this->validate($request,[
            'libelle' => 'required',

        ]);
        try {
            $famille = FamilleProduit::where('id',$id)->firstOrFail();
            $famille->update($request->except('_token'));
            $this->withSuccess(['Modification réussie']);
            return redirect()->route('liste_famille');
        }catch (ModelNotFoundException $e){
            return back()->withInput()->withErrors($e->getMessage());
        }
    }

    public function sendResponseDeleteProduit($reference)
    {
        try{
            $produits = Produit::where('reference',$reference)->firstorFail();
            $produits->delete();
            $this->withSuccess(['Suppression réussie']);
            return back();
        }catch (ModelNotFoundException $e){
            return back()->withErrors(['exception' => $e->getMessage()]);
        }catch (\Exception $e){
            return back()->withErrors(['exception' => $e->getMessage()]);
        }
    }

    public function sendResponseDeleteFamille($id)
    {
        try{
            $familles = FamilleProduit::where('id',$id)->firstorFail();
            $familles->delete();
            $this->withSuccess(['Suppression réussie']);
            return back();
        }catch (ModelNotFoundException $e){
            return back()->withErrors(['exception' => $e->getMessage()]);
        }catch (\Exception $e){
            return back()->withErrors(['exception' => $e->getMessage()]);
        }
    }

}
